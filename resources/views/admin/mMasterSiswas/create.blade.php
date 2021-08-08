@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.mMasterSiswa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.m-master-siswas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama">{{ trans('cruds.mMasterSiswa.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" required>
                @if($errors->has('nama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mMasterSiswa.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tgl_lahir">{{ trans('cruds.mMasterSiswa.fields.tgl_lahir') }}</label>
                <input class="form-control date {{ $errors->has('tgl_lahir') ? 'is-invalid' : '' }}" type="text" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                @if($errors->has('tgl_lahir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_lahir') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mMasterSiswa.fields.tgl_lahir_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nisn">{{ trans('cruds.mMasterSiswa.fields.nisn') }}</label>
                <input class="form-control {{ $errors->has('nisn') ? 'is-invalid' : '' }}" type="text" name="nisn" id="nisn" value="{{ old('nisn', '') }}" required>
                @if($errors->has('nisn'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nisn') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mMasterSiswa.fields.nisn_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="angkatan_id">{{ trans('cruds.mMasterSiswa.fields.angkatan') }}</label>
                <select class="form-control select2 {{ $errors->has('angkatan') ? 'is-invalid' : '' }}" name="angkatan_id" id="angkatan_id" required>
                    @foreach($angkatans as $id => $entry)
                        <option value="{{ $id }}" {{ old('angkatan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('angkatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('angkatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mMasterSiswa.fields.angkatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jurusan_id">{{ trans('cruds.mMasterSiswa.fields.jurusan') }}</label>
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
                <span class="help-block">{{ trans('cruds.mMasterSiswa.fields.jurusan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kelas_id">{{ trans('cruds.mMasterSiswa.fields.kelas') }}</label>
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
                <span class="help-block">{{ trans('cruds.mMasterSiswa.fields.kelas_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kelamin_id">{{ trans('cruds.mMasterSiswa.fields.kelamin') }}</label>
                <select class="form-control select2 {{ $errors->has('kelamin') ? 'is-invalid' : '' }}" name="kelamin_id" id="kelamin_id" required>
                    @foreach($kelamins as $id => $entry)
                        <option value="{{ $id }}" {{ old('kelamin_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kelamin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kelamin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mMasterSiswa.fields.kelamin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.mMasterSiswa.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mMasterSiswa.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.mMasterSiswa.fields.status') }}</label>
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
                <span class="help-block">{{ trans('cruds.mMasterSiswa.fields.status_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.m-master-siswas.storeMedia') }}',
    maxFilesize: 8, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 8,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($mMasterSiswa) && $mMasterSiswa->photo)
      var file = {!! json_encode($mMasterSiswa->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection