<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMJurusanRequest;
use App\Http\Requests\StoreMJurusanRequest;
use App\Http\Requests\UpdateMJurusanRequest;
use App\Models\MJurusan;
use App\Models\Status;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MJurusanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('m_jurusan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mJurusans = MJurusan::with(['status'])->get();

        return view('admin.mJurusans.index', compact('mJurusans'));
    }

    public function create()
    {
        abort_if(Gate::denies('m_jurusan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mJurusans.create', compact('statuses'));
    }

    public function store(StoreMJurusanRequest $request)
    {
        $mJurusan = MJurusan::create($request->all());

        return redirect()->route('admin.m-jurusans.index');
    }

    public function edit(MJurusan $mJurusan)
    {
        abort_if(Gate::denies('m_jurusan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Status::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mJurusan->load('status');

        return view('admin.mJurusans.edit', compact('statuses', 'mJurusan'));
    }

    public function update(UpdateMJurusanRequest $request, MJurusan $mJurusan)
    {
        $mJurusan->update($request->all());

        return redirect()->route('admin.m-jurusans.index');
    }

    public function show(MJurusan $mJurusan)
    {
        abort_if(Gate::denies('m_jurusan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mJurusan->load('status', 'jurusanMMasterSiswas');

        return view('admin.mJurusans.show', compact('mJurusan'));
    }

    public function destroy(MJurusan $mJurusan)
    {
        abort_if(Gate::denies('m_jurusan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mJurusan->delete();

        return back();
    }

    public function massDestroy(MassDestroyMJurusanRequest $request)
    {
        MJurusan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
