@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.listJadwalPelajaran.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.list-jadwal-pelajarans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="tahun_ajaran_id">{{ trans('cruds.listJadwalPelajaran.fields.tahun_ajaran') }}</label>
                <select class="form-control select2 {{ $errors->has('tahun_ajaran') ? 'is-invalid' : '' }}" name="tahun_ajaran_id" id="tahun_ajaran_id" required>
                    @foreach($tahun_ajarans as $id => $entry)
                        <option value="{{ $id }}" {{ old('tahun_ajaran_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tahun_ajaran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tahun_ajaran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listJadwalPelajaran.fields.tahun_ajaran_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jurusan_id">{{ trans('cruds.listJadwalPelajaran.fields.jurusan') }}</label>
                <select class="form-control select2 {{ $errors->has('jurusan') ? 'is-invalid' : '' }}" name="jurusan_id" id="jurusan_id" required>
                    @foreach($jurusans as $id => $entry)
                        <option value="{{ $id }}" {{ old('jurusan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('jurusan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jurusan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listJadwalPelajaran.fields.jurusan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pelajaran_id">{{ trans('cruds.listJadwalPelajaran.fields.pelajaran') }}</label>
                <select class="form-control select2 {{ $errors->has('pelajaran') ? 'is-invalid' : '' }}" name="pelajaran_id" id="pelajaran_id" required>
                    @foreach($pelajarans as $id => $entry)
                        <option value="{{ $id }}" {{ old('pelajaran_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('pelajaran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pelajaran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listJadwalPelajaran.fields.pelajaran_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="dari_jam">{{ trans('cruds.listJadwalPelajaran.fields.dari_jam') }}</label>
                <input class="form-control timepicker {{ $errors->has('dari_jam') ? 'is-invalid' : '' }}" type="text" name="dari_jam" id="dari_jam" value="{{ old('dari_jam') }}" required>
                @if($errors->has('dari_jam'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dari_jam') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listJadwalPelajaran.fields.dari_jam_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sampai_jam">{{ trans('cruds.listJadwalPelajaran.fields.sampai_jam') }}</label>
                <input class="form-control timepicker {{ $errors->has('sampai_jam') ? 'is-invalid' : '' }}" type="text" name="sampai_jam" id="sampai_jam" value="{{ old('sampai_jam') }}" required>
                @if($errors->has('sampai_jam'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sampai_jam') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listJadwalPelajaran.fields.sampai_jam_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="guru_id">{{ trans('cruds.listJadwalPelajaran.fields.guru') }}</label>
                <select class="form-control select2 {{ $errors->has('guru') ? 'is-invalid' : '' }}" name="guru_id" id="guru_id" required>
                    @foreach($gurus as $id => $entry)
                        <option value="{{ $id }}" {{ old('guru_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('guru'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guru') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listJadwalPelajaran.fields.guru_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kelas_id">{{ trans('cruds.listJadwalPelajaran.fields.kelas') }}</label>
                <select class="form-control select2 {{ $errors->has('kelas') ? 'is-invalid' : '' }}" name="kelas_id" id="kelas_id" required>
                    @foreach($kelas as $id => $entry)
                        <option value="{{ $id }}" {{ old('kelas_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kelas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kelas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listJadwalPelajaran.fields.kelas_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.listJadwalPelajaran.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.listJadwalPelajaran.fields.status_helper') }}</span>
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