<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMGuruRequest;
use App\Http\Requests\UpdateMGuruRequest;
use App\Http\Resources\Admin\MGuruResource;
use App\Models\MGuru;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MGuruApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('m_guru_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MGuruResource(MGuru::with(['kelamin', 'status'])->get());
    }

    public function store(StoreMGuruRequest $request)
    {
        $mGuru = MGuru::create($request->all());

        if ($request->input('photo', false)) {
            $mGuru->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new MGuruResource($mGuru))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MGuru $mGuru)
    {
        abort_if(Gate::denies('m_guru_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MGuruResource($mGuru->load(['kelamin', 'status']));
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

        return (new MGuruResource($mGuru))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MGuru $mGuru)
    {
        abort_if(Gate::denies('m_guru_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mGuru->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
