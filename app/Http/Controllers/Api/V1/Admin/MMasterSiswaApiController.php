<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMMasterSiswaRequest;
use App\Http\Requests\UpdateMMasterSiswaRequest;
use App\Http\Resources\Admin\MMasterSiswaResource;
use App\Models\MMasterSiswa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MMasterSiswaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('m_master_siswa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MMasterSiswaResource(MMasterSiswa::with(['angkatan', 'jurusan', 'kelas', 'kelamin', 'status'])->get());
    }

    public function store(StoreMMasterSiswaRequest $request)
    {
        $mMasterSiswa = MMasterSiswa::create($request->all());

        if ($request->input('photo', false)) {
            $mMasterSiswa->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new MMasterSiswaResource($mMasterSiswa))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MMasterSiswa $mMasterSiswa)
    {
        abort_if(Gate::denies('m_master_siswa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MMasterSiswaResource($mMasterSiswa->load(['angkatan', 'jurusan', 'kelas', 'kelamin', 'status']));
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

        return (new MMasterSiswaResource($mMasterSiswa))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MMasterSiswa $mMasterSiswa)
    {
        abort_if(Gate::denies('m_master_siswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mMasterSiswa->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
