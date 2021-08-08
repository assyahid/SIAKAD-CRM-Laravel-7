<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreListJadwalPelajaranRequest;
use App\Http\Requests\UpdateListJadwalPelajaranRequest;
use App\Http\Resources\Admin\ListJadwalPelajaranResource;
use App\Models\ListJadwalPelajaran;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ListJadwalPelajaranApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('list_jadwal_pelajaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ListJadwalPelajaranResource(ListJadwalPelajaran::with(['tahun_ajaran', 'jurusan', 'pelajaran', 'guru', 'kelas', 'status'])->get());
    }

    public function store(StoreListJadwalPelajaranRequest $request)
    {
        $listJadwalPelajaran = ListJadwalPelajaran::create($request->all());

        return (new ListJadwalPelajaranResource($listJadwalPelajaran))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ListJadwalPelajaran $listJadwalPelajaran)
    {
        abort_if(Gate::denies('list_jadwal_pelajaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ListJadwalPelajaranResource($listJadwalPelajaran->load(['tahun_ajaran', 'jurusan', 'pelajaran', 'guru', 'kelas', 'status']));
    }

    public function update(UpdateListJadwalPelajaranRequest $request, ListJadwalPelajaran $listJadwalPelajaran)
    {
        $listJadwalPelajaran->update($request->all());

        return (new ListJadwalPelajaranResource($listJadwalPelajaran))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ListJadwalPelajaran $listJadwalPelajaran)
    {
        abort_if(Gate::denies('list_jadwal_pelajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listJadwalPelajaran->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
