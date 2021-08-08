@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.listMasterPelajaran.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-master-pelajarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.listMasterPelajaran.fields.id') }}
                        </th>
                        <td>
                            {{ $listMasterPelajaran->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listMasterPelajaran.fields.nama') }}
                        </th>
                        <td>
                            {{ $listMasterPelajaran->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listMasterPelajaran.fields.status') }}
                        </th>
                        <td>
                            {{ $listMasterPelajaran->status->nama ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-master-pelajarans.index') }}">
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
            <a class="nav-link" href="#pelajaran_list_jadwal_pelajarans" role="tab" data-toggle="tab">
                {{ trans('cruds.listJadwalPelajaran.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="pelajaran_list_jadwal_pelajarans">
            @includeIf('admin.listMasterPelajarans.relationships.pelajaranListJadwalPelajarans', ['listJadwalPelajarans' => $listMasterPelajaran->pelajaranListJadwalPelajarans])
        </div>
    </div>
</div>

@endsection