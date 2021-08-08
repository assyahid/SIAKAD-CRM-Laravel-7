<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMkelaminRequest;
use App\Http\Requests\StoreMkelaminRequest;
use App\Http\Requests\UpdateMkelaminRequest;
use App\Models\Mkelamin;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MkelaminController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mkelamin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mkelamins = Mkelamin::all();

        return view('admin.mkelamins.index', compact('mkelamins'));
    }

    public function create()
    {
        abort_if(Gate::denies('mkelamin_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mkelamins.create');
    }

    public function store(StoreMkelaminRequest $request)
    {
        $mkelamin = Mkelamin::create($request->all());

        return redirect()->route('admin.mkelamins.index');
    }

    public function edit(Mkelamin $mkelamin)
    {
        abort_if(Gate::denies('mkelamin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mkelamins.edit', compact('mkelamin'));
    }

    public function update(UpdateMkelaminRequest $request, Mkelamin $mkelamin)
    {
        $mkelamin->update($request->all());

        return redirect()->route('admin.mkelamins.index');
    }

    public function show(Mkelamin $mkelamin)
    {
        abort_if(Gate::denies('mkelamin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mkelamin->load('kelaminMMasterSiswas', 'kelaminMGurus');

        return view('admin.mkelamins.show', compact('mkelamin'));
    }

    public function destroy(Mkelamin $mkelamin)
    {
        abort_if(Gate::denies('mkelamin_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mkelamin->delete();

        return back();
    }

    public function massDestroy(MassDestroyMkelaminRequest $request)
    {
        Mkelamin::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
