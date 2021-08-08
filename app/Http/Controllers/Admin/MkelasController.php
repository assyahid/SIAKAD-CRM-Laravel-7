<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMkelaRequest;
use App\Http\Requests\StoreMkelaRequest;
use App\Http\Requests\UpdateMkelaRequest;
use App\Models\Mkela;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MkelasController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('mkela_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Mkela::query()->select(sprintf('%s.*', (new Mkela())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'mkela_show';
                $editGate = 'mkela_edit';
                $deleteGate = 'mkela_delete';
                $crudRoutePart = 'mkelas';

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
            $table->editColumn('kuota', function ($row) {
                return $row->kuota ? $row->kuota : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.mkelas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mkela_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mkelas.create');
    }

    public function store(StoreMkelaRequest $request)
    {
        $mkela = Mkela::create($request->all());

        return redirect()->route('admin.mkelas.index');
    }

    public function edit(Mkela $mkela)
    {
        abort_if(Gate::denies('mkela_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mkelas.edit', compact('mkela'));
    }

    public function update(UpdateMkelaRequest $request, Mkela $mkela)
    {
        $mkela->update($request->all());

        return redirect()->route('admin.mkelas.index');
    }

    public function show(Mkela $mkela)
    {
        abort_if(Gate::denies('mkela_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mkela->load('kelasMMasterSiswas', 'kelasListJadwalPelajarans');

        return view('admin.mkelas.show', compact('mkela'));
    }

    public function destroy(Mkela $mkela)
    {
        abort_if(Gate::denies('mkela_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mkela->delete();

        return back();
    }

    public function massDestroy(MassDestroyMkelaRequest $request)
    {
        Mkela::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
