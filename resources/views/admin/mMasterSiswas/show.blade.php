@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mMasterSiswa.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.m-master-siswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.id') }}
                        </th>
                        <td>
                            {{ $mMasterSiswa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.nama') }}
                        </th>
                        <td>
                            {{ $mMasterSiswa->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.tgl_lahir') }}
                        </th>
                        <td>
                            {{ $mMasterSiswa->tgl_lahir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.nisn') }}
                        </th>
                        <td>
                            {{ $mMasterSiswa->nisn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.angkatan') }}
                        </th>
                        <td>
                            {{ $mMasterSiswa->angkatan->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.jurusan') }}
                        </th>
                        <td>
                            {{ $mMasterSiswa->jurusan->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.kelas') }}
                        </th>
                        <td>
                            {{ $mMasterSiswa->kelas->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.kelamin') }}
                        </th>
                        <td>
                            {{ $mMasterSiswa->kelamin->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.photo') }}
                        </th>
                        <td>
                            @if($mMasterSiswa->photo)
                                <a href="{{ $mMasterSiswa->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $mMasterSiswa->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.status') }}
                        </th>
                        <td>
                            {{ $mMasterSiswa->status->nama ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.m-master-siswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection