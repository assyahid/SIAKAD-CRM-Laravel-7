<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMGuruRequest;
use App\Http\Requests\StoreMGuruRequest;
use App\Http\Requests\UpdateMGuruRequest;
use App\Models\MGuru;
use App\Models\Mkelamin;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MGuruController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('m_guru_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MGuru::with(['kelamin', 'status'])->select(sprintf('%s.*', (new MGuru())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'm_guru_show';
                $editGate = 'm_guru_edit';
                $deleteGate = 'm_guru_delete';
                $crudRoutePart = 'm-gurus';

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
            $table->editColumn('alamat', function ($row) {
                return $row->alamat ? $row->alamat : '';
            });
            $table->addColumn('kelamin_nama', function ($row) {
                return $row->kelamin ? $row->kelamin->nama : '';
            });

            $table->editColumn('nik', function ($row) {
                return $row->nik ? $row->nik : '';
            });

            $table->editColumn('tempat_lahir', function ($row) {
                return $row->tempat_lahir ? $row->tempat_lahir : '';
            });

            $table->addColumn('status_nama', function ($row) {
                return $row->status ? $row->status->nama : '';
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

            $table->rawColumns(['actions', 'placeholder', 'kelamin', 'status', 'photo']);

            return $table->make(true);
        }

        $mkelamins = Mkelamin::get();
        $statuses  = Status::get();

        return view('admin.mGurus.index', compact('mkelamins', 'statuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('m_guru_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kelamins = Mkelamin::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mGurus.create', compact('kelamins', 'statuses'));
    }

    public function store(StoreMGuruRequest $request)
    {
        $mGuru = MGuru::create($request->all());

        if ($request->input('photo', false)) {
            $mGuru->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mGuru->id]);
        }

        return redirect()->route('admin.m-gurus.index');
    }

    public function edit(MGuru $mGuru)
    {
        abort_if(Gate::denies('m_guru_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kelamins = Mkelamin::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mGuru->load('kelamin', 'status');

        return view('admin.mGurus.edit', compact('kelamins', 'statuses', 'mGuru'));
    }

    public function update(UpdateMGuruRequest $request, MGuru $mGuru)
    {
        $mGuru->update($request->all());

        if ($request->input('photo', false)) {
            if (!$mGuru->photo || $request->input('photo') !== $mGuru->photo->file_name) {
                if ($mGuru->photo) {
                    $mGuru->photo->delete();
                }
                $mGuru->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($mGuru->photo) {
            $mGuru->photo->delete();
        }

        return redirect()->route('admin.m-gurus.index');
    }

    public function show(MGuru $mGuru)
    {
        abort_if(Gate::denies('m_guru_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mGuru->load('kelamin', 'status');

        return view('admin.mGurus.show', compact('mGuru'));
    }

    public function destroy(MGuru $mGuru)
    {
        abort_if(Gate::denies('m_guru_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mGuru->delete();

        return back();
    }

    public function massDestroy(MassDestroyMGuruRequest $request)
    {
        MGuru::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('m_guru_create') && Gate::denies('m_guru_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MGuru();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
