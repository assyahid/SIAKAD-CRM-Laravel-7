@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mTahunAjaran.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.m-tahun-ajarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mTahunAjaran.fields.id') }}
                        </th>
                        <td>
                            {{ $mTahunAjaran->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mTahunAjaran.fields.nama') }}
                        </th>
                        <td>
                            {{ $mTahunAjaran->nama }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.m-tahun-ajarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#angkatan_m_master_siswas" role="tab" data-toggle="tab">
                {{ trans('cruds.mMasterSiswa.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="angkatan_m_master_siswas">
            @includeIf('admin.mTahunAjarans.relationships.angkatanMMasterSiswas', ['mMasterSiswas' => $mTahunAjaran->angkatanMMasterSiswas])
        </div>
    </div>
</div>

@endsection