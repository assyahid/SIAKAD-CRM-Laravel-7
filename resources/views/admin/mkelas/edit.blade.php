@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.mkela.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mkelas.update", [$mkela->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama">{{ trans('cruds.mkela.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $mkela->nama) }}" required>
                @if($errors->has('nama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mkela.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kuota">{{ trans('cruds.mkela.fields.kuota') }}</label>
                <input class="form-control {{ $errors->has('kuota') ? 'is-invalid' : '' }}" type="number" name="kuota" id="kuota" value="{{ old('kuota', $mkela->kuota) }}" step="1" required>
                @if($errors->has('kuota'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kuota') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mkela.fields.kuota_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection