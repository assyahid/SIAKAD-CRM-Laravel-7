<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMTahunAjaranRequest;
use App\Http\Requests\StoreMTahunAjaranRequest;
use App\Http\Requests\UpdateMTahunAjaranRequest;
use App\Models\MTahunAjaran;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MTahunAjaranController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('m_tahun_ajaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MTahunAjaran::query()->select(sprintf('%s.*', (new MTahunAjaran())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'm_tahun_ajaran_show';
                $editGate = 'm_tahun_ajaran_edit';
                $deleteGate = 'm_tahun_ajaran_delete';
                $crudRoutePart = 'm-tahun-ajarans';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.mTahunAjarans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('m_tahun_ajaran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mTahunAjarans.create');
    }

    public function store(StoreMTahunAjaranRequest $request)
    {
        $mTahunAjaran = MTahunAjaran::create($request->all());

        return redirect()->route('admin.m-tahun-ajarans.index');
    }

    public function edit(MTahunAjaran $mTahunAjaran)
    {
        abort_if(Gate::denies('m_tahun_ajaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mTahunAjarans.edit', compact('mTahunAjaran'));
    }

    public function update(UpdateMTahunAjaranRequest $request, MTahunAjaran $mTahunAjaran)
    {
        $mTahunAjaran->update($request->all());

        return redirect()->route('admin.m-tahun-ajarans.index');
    }

    public function show(MTahunAjaran $mTahunAjaran)
    {
        abort_if(Gate::denies('m_tahun_ajaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mTahunAjaran->load('angkatanMMasterSiswas');

        return view('admin.mTahunAjarans.show', compact('mTahunAjaran'));
    }

    public function destroy(MTahunAjaran $mTahunAjaran)
    {
        abort_if(Gate::denies('m_tahun_ajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mTahunAjaran->delete();

        return back();
    }

    public function massDestroy(MassDestroyMTahunAjaranRequest $request)
    {
        MTahunAjaran::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
