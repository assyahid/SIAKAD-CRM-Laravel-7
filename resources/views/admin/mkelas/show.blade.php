@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mkela.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mkelas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mkela.fields.id') }}
                        </th>
                        <td>
                            {{ $mkela->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mkela.fields.nama') }}
                        </th>
                        <td>
                            {{ $mkela->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mkela.fields.kuota') }}
                        </th>
                        <td>
                            {{ $mkela->kuota }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mkelas.index') }}">
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
            <a class="nav-link" href="#kelas_m_master_siswas" role="tab" data-toggle="tab">
                {{ trans('cruds.mMasterSiswa.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#kelas_list_jadwal_pelajarans" role="tab" data-toggle="tab">
                {{ trans('cruds.listJadwalPelajaran.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="kelas_m_master_siswas">
            @includeIf('admin.mkelas.relationships.kelasMMasterSiswas', ['mMasterSiswas' => $mkela->kelasMMasterSiswas])
        </div>
        <div class="tab-pane" role="tabpanel" id="kelas_list_jadwal_pelajarans">
            @includeIf('admin.mkelas.relationships.kelasListJadwalPelajarans', ['listJadwalPelajarans' => $mkela->kelasListJadwalPelajarans])
        </div>
    </div>
</div>

@endsection