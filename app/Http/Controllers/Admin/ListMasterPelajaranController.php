<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyListMasterPelajaranRequest;
use App\Http\Requests\StoreListMasterPelajaranRequest;
use App\Http\Requests\UpdateListMasterPelajaranRequest;
use App\Models\ListMasterPelajaran;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ListMasterPelajaranController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('list_master_pelajaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listMasterPelajarans = ListMasterPelajaran::with(['status'])->get();

        return view('admin.listMasterPelajarans.index', compact('listMasterPelajarans'));
    }

    public function create()
    {
        abort_if(Gate::denies('list_master_pelajaran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.listMasterPelajarans.create', compact('statuses'));
    }

    public function store(StoreListMasterPelajaranRequest $request)
    {
        $listMasterPelajaran = ListMasterPelajaran::create($request->all());

        return redirect()->route('admin.list-master-pelajarans.index');
    }

    public function edit(ListMasterPelajaran $listMasterPelajaran)
    {
        abort_if(Gate::denies('list_master_pelajaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $listMasterPelajaran->load('status');

        return view('admin.listMasterPelajarans.edit', compact('statuses', 'listMasterPelajaran'));
    }

    public function update(UpdateListMasterPelajaranRequest $request, ListMasterPelajaran $listMasterPelajaran)
    {
        $listMasterPelajaran->update($request->all());

        return redirect()->route('admin.list-master-pelajarans.index');
    }

    public function show(ListMasterPelajaran $listMasterPelajaran)
    {
        abort_if(Gate::denies('list_master_pelajaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listMasterPelajaran->load('status', 'pelajaranListJadwalPelajarans');

        return view('admin.listMasterPelajarans.show', compact('listMasterPelajaran'));
    }

    public function destroy(ListMasterPelajaran $listMasterPelajaran)
    {
        abort_if(Gate::denies('list_master_pelajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listMasterPelajaran->delete();

        return back();
    }

    public function massDestroy(MassDestroyListMasterPelajaranRequest $request)
    {
        ListMasterPelajaran::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
