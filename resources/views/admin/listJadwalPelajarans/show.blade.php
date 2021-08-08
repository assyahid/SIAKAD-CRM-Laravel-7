@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.listJadwalPelajaran.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-jadwal-pelajarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.id') }}
                        </th>
                        <td>
                            {{ $listJadwalPelajaran->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.tahun_ajaran') }}
                        </th>
                        <td>
                            {{ $listJadwalPelajaran->tahun_ajaran->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.jurusan') }}
                        </th>
                        <td>
                            {{ $listJadwalPelajaran->jurusan->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.pelajaran') }}
                        </th>
                        <td>
                            {{ $listJadwalPelajaran->pelajaran->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.dari_jam') }}
                        </th>
                        <td>
                            {{ $listJadwalPelajaran->dari_jam }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.sampai_jam') }}
                        </th>
                        <td>
                            {{ $listJadwalPelajaran->sampai_jam }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.guru') }}
                        </th>
                        <td>
                            {{ $listJadwalPelajaran->guru->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.kelas') }}
                        </th>
                        <td>
                            {{ $listJadwalPelajaran->kelas->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.status') }}
                        </th>
                        <td>
                            {{ $listJadwalPelajaran->status->nama ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-jadwal-pelajarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection