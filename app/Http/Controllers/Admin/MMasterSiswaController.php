<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMMasterSiswaRequest;
use App\Http\Requests\StoreMMasterSiswaRequest;
use App\Http\Requests\UpdateMMasterSiswaRequest;
use App\Models\MJurusan;
use App\Models\Mkela;
use App\Models\Mkelamin;
use App\Models\MMasterSiswa;
use App\Models\MTahunAjaran;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MMasterSiswaController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('m_master_siswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MMasterSiswa::with(['angkatan', 'jurusan', 'kelas', 'kelamin', 'status'])->select(sprintf('%s.*', (new MMasterSiswa())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'm_master_siswa_show';
                $editGate = 'm_master_siswa_edit';
                $deleteGate = 'm_master_siswa_delete';
                $crudRoutePart = 'm-master-siswas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '';
            });

            $table->editColumn('nisn', function ($row) {
                return $row->nisn ? $row->nisn : '';
            });
            $table->addColumn('angkatan_nama', function ($row) {
                return $row->angkatan ? $row->angkatan->nama : '';
            });

            $table->addColumn('jurusan_nama', function ($row) {
                return $row->jurusan ? $row->jurusan->nama : '';
            });

            $table->addColumn('kelas_nama', function ($row) {
                return $row->kelas ? $row->kelas->nama : '';
            });

            $table->editColumn('kelas.kuota', function ($row) {
                return $row->kelas ? (is_string($row->kelas) ? $row->kelas : $row->kelas->kuota) : '';
            });
            $table->addColumn('kelamin_nama', function ($row) {
                return $row->kelamin ? $row->kelamin->nama : '';
            });

            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->addColumn('status_nama', function ($row) {
                return $row->status ? $row->status->nama : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'angkatan', 'jurusan', 'kelas', 'kelamin', 'photo', 'status']);

            return $table->make(true);
        }

        $m_tahun_ajarans = MTahunAjaran::get();
        $m_jurusans      = MJurusan::get();
        $mkelas          = Mkela::get();
        $mkelamins       = Mkelamin::get();
        $statuses        = Status::get();

        return view('admin.mMasterSiswas.index', compact('m_tahun_ajarans', 'm_jurusans', 'mkelas', 'mkelamins', 'statuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('m_master_siswa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $angkatans = MTahunAjaran::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jurusans = MJurusan::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kelas = Mkela::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kelamins = Mkelamin::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mMasterSiswas.create', compact('angkatans', 'jurusans', 'kelas', 'kelamins', 'statuses'));
    }

    public function store(StoreMMasterSiswaRequest $request)
    {
        $mMasterSiswa = MMasterSiswa::create($request->all());

        if ($request->input('photo', false)) {
            $mMasterSiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mMasterSiswa->id]);
        }

        return redirect()->route('admin.m-master-siswas.index');
    }

    public function edit(MMasterSiswa $mMasterSiswa)
    {
        abort_if(Gate::denies('m_master_siswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $angkatans = MTahunAjaran::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jurusans = MJurusan::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kelas = Mkela::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kelamins = Mkelamin::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mMasterSiswa->load('angkatan', 'jurusan', 'kelas', 'kelamin', 'status');

        return view('admin.mMasterSiswas.edit', compact('angkatans', 'jurusans', 'kelas', 'kelamins', 'statuses', 'mMasterSiswa'));
    }

    public function update(UpdateMMasterSiswaRequest $request, MMasterSiswa $mMasterSiswa)
    {
        $mMasterSiswa->update($request->all());

        if ($request->input('photo', false)) {
            if (!$mMasterSiswa->photo || $request->input('photo') !== $mMasterSiswa->photo->file_name) {
                if ($mMasterSiswa->photo) {
                    $mMasterSiswa->photo->delete();
                }
                $mMasterSiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($mMasterSiswa->photo) {
            $mMasterSiswa->photo->delete();
        }

        return redirect()->route('admin.m-master-siswas.index');
    }

    public function show(MMasterSiswa $mMasterSiswa)
    {
        abort_if(Gate::denies('m_master_siswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mMasterSiswa->load('angkatan', 'jurusan', 'kelas', 'kelamin', 'status');

        return view('admin.mMasterSiswas.show', compact('mMasterSiswa'));
    }

    public function destroy(MMasterSiswa $mMasterSiswa)
    {
        abort_if(Gate::denies('m_master_siswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mMasterSiswa->delete();

        return back();
    }

    public function massDestroy(MassDestroyMMasterSiswaRequest $request)
    {
        MMasterSiswa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('m_master_siswa_create') && Gate::denies('m_master_siswa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MMasterSiswa();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
