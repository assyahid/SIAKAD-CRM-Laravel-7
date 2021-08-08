<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMkelaRequest;
use App\Http\Requests\UpdateMkelaRequest;
use App\Http\Resources\Admin\MkelaResource;
use App\Models\Mkela;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MkelasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mkela_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MkelaResource(Mkela::all());
    }

    public function store(StoreMkelaRequest $request)
    {
        $mkela = Mkela::create($request->all());

        return (new MkelaResource($mkela))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Mkela $mkela)
    {
        abort_if(Gate::denies('mkela_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MkelaResource($mkela);
    }

    public function update(UpdateMkelaRequest $request, Mkela $mkela)
    {
        $mkela->update($request->all());

        return (new MkelaResource($mkela))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Mkela $mkela)
    {
        abort_if(Gate::denies('mkela_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mkela->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
