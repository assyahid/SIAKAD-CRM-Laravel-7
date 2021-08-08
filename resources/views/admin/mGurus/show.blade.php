@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mGuru.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.m-gurus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mGuru.fields.id') }}
                        </th>
                        <td>
                            {{ $mGuru->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mGuru.fields.nama') }}
                        </th>
                        <td>
                            {{ $mGuru->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mGuru.fields.alamat') }}
                        </th>
                        <td>
                            {{ $mGuru->alamat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mGuru.fields.kelamin') }}
                        </th>
                        <td>
                            {{ $mGuru->kelamin->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mGuru.fields.nik') }}
                        </th>
                        <td>
                            {{ $mGuru->nik }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mGuru.fields.tgl_lahir') }}
                        </th>
                        <td>
                            {{ $mGuru->tgl_lahir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mGuru.fields.tempat_lahir') }}
                        </th>
                        <td>
                            {{ $mGuru->tempat_lahir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mGuru.fields.mulai_bekerja') }}
                        </th>
                        <td>
                            {{ $mGuru->mulai_bekerja }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mGuru.fields.status') }}
                        </th>
                        <td>
                            {{ $mGuru->status->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mGuru.fields.photo') }}
                        </th>
                        <td>
                            @if($mGuru->photo)
                                <a href="{{ $mGuru->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $mGuru->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.m-gurus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection