@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mJurusan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.m-jurusans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mJurusan.fields.id') }}
                        </th>
                        <td>
                            {{ $mJurusan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mJurusan.fields.nama') }}
                        </th>
                        <td>
                            {{ $mJurusan->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mJurusan.fields.status') }}
                        </th>
                        <td>
                            {{ $mJurusan->status->nama ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.m-jurusans.index') }}">
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
            <a class="nav-link" href="#jurusan_m_master_siswas" role="tab" data-toggle="tab">
                {{ trans('cruds.mMasterSiswa.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="jurusan_m_master_siswas">
            @includeIf('admin.mJurusans.relationships.jurusanMMasterSiswas', ['mMasterSiswas' => $mJurusan->jurusanMMasterSiswas])
        </div>
    </div>
</div>

@endsection