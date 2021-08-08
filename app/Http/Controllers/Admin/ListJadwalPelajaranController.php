<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyListJadwalPelajaranRequest;
use App\Http\Requests\StoreListJadwalPelajaranRequest;
use App\Http\Requests\UpdateListJadwalPelajaranRequest;
use App\Models\ListJadwalPelajaran;
use App\Models\ListMasterPelajaran;
use App\Models\MGuru;
use App\Models\MJurusan;
use App\Models\Mkela;
use App\Models\MTahunAjaran;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ListJadwalPelajaranController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('list_jadwal_pelajaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ListJadwalPelajaran::with(['tahun_ajaran', 'jurusan', 'pelajaran', 'guru', 'kelas', 'status'])->select(sprintf('%s.*', (new ListJadwalPelajaran())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'list_jadwal_pelajaran_show';
                $editGate = 'list_jadwal_pelajaran_edit';
                $deleteGate = 'list_jadwal_pelajaran_delete';
                $crudRoutePart = 'list-jadwal-pelajarans';

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
            $table->addColumn('tahun_ajaran_nama', function ($row) {
                return $row->tahun_ajaran ? $row->tahun_ajaran->nama : '';
            });

            $table->addColumn('jurusan_nama', function ($row) {
                return $row->jurusan ? $row->jurusan->nama : '';
            });

            $table->addColumn('pelajaran_nama', function ($row) {
                return $row->pelajaran ? $row->pelajaran->nama : '';
            });

            $table->editColumn('dari_jam', function ($row) {
                return $row->dari_jam ? $row->dari_jam : '';
            });
            $table->editColumn('sampai_jam', function ($row) {
                return $row->sampai_jam ? $row->sampai_jam : '';
            });
            $table->addColumn('guru_nama', function ($row) {
                return $row->guru ? $row->guru->nama : '';
            });

            $table->addColumn('kelas_nama', function ($row) {
                return $row->kelas ? $row->kelas->nama : '';
            });

            $table->addColumn('status_nama', function ($row) {
                return $row->status ? $row->status->nama : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'tahun_ajaran', 'jurusan', 'pelajaran', 'guru', 'kelas', 'status']);

            return $table->make(true);
        }

        return view('admin.listJadwalPelajarans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('list_jadwal_pelajaran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahun_ajarans = MTahunAjaran::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jurusans = MJurusan::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pelajarans = ListMasterPelajaran::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $gurus = MGuru::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kelas = Mkela::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.listJadwalPelajarans.create', compact('tahun_ajarans', 'jurusans', 'pelajarans', 'gurus', 'kelas', 'statuses'));
    }

    public function store(StoreListJadwalPelajaranRequest $request)
    {
        $listJadwalPelajaran = ListJadwalPelajaran::create($request->all());

        return redirect()->route('admin.list-jadwal-pelajarans.index');
    }

    public function edit(ListJadwalPelajaran $listJadwalPelajaran)
    {
        abort_if(Gate::denies('list_jadwal_pelajaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahun_ajarans = MTahunAjaran::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jurusans = MJurusan::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pelajarans = ListMasterPelajaran::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $gurus = MGuru::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kelas = Mkela::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $listJadwalPelajaran->load('tahun_ajaran', 'jurusan', 'pelajaran', 'guru', 'kelas', 'status');

        return view('admin.listJadwalPelajarans.edit', compact('tahun_ajarans', 'jurusans', 'pelajarans', 'gurus', 'kelas', 'statuses', 'listJadwalPelajaran'));
    }

    public function update(UpdateListJadwalPelajaranRequest $request, ListJadwalPelajaran $listJadwalPelajaran)
    {
        $listJadwalPelajaran->update($request->all());

        return redirect()->route('admin.list-jadwal-pelajarans.index');
    }

    public function show(ListJadwalPelajaran $listJadwalPelajaran)
    {
        abort_if(Gate::denies('list_jadwal_pelajaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listJadwalPelajaran->load('tahun_ajaran', 'jurusan', 'pelajaran', 'guru', 'kelas', 'status');

        return view('admin.listJadwalPelajarans.show', compact('listJadwalPelajaran'));
    }

    public function destroy(ListJadwalPelajaran $listJadwalPelajaran)
    {
        abort_if(Gate::denies('list_jadwal_pelajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listJadwalPelajaran->delete();

        return back();
    }

    public function massDestroy(MassDestroyListJadwalPelajaranRequest $request)
    {
        ListJadwalPelajaran::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
