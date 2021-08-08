@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.mGuru.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.m-gurus.update", [$mGuru->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama">{{ trans('cruds.mGuru.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $mGuru->nama) }}" required>
                @if($errors->has('nama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mGuru.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alamat">{{ trans('cruds.mGuru.fields.alamat') }}</label>
                <input class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" type="text" name="alamat" id="alamat" value="{{ old('alamat', $mGuru->alamat) }}">
                @if($errors->has('alamat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alamat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mGuru.fields.alamat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kelamin_id">{{ trans('cruds.mGuru.fields.kelamin') }}</label>
                <select class="form-control select2 {{ $errors->has('kelamin') ? 'is-invalid' : '' }}" name="kelamin_id" id="kelamin_id" required>
                    @foreach($kelamins as $id => $entry)
                        <option value="{{ $id }}" {{ (old('kelamin_id') ? old('kelamin_id') : $mGuru->kelamin->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kelamin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kelamin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mGuru.fields.kelamin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nik">{{ trans('cruds.mGuru.fields.nik') }}</label>
                <input class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}" type="text" name="nik" id="nik" value="{{ old('nik', $mGuru->nik) }}" required>
                @if($errors->has('nik'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nik') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mGuru.fields.nik_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tgl_lahir">{{ trans('cruds.mGuru.fields.tgl_lahir') }}</label>
                <input class="form-control date {{ $errors->has('tgl_lahir') ? 'is-invalid' : '' }}" type="text" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir', $mGuru->tgl_lahir) }}" required>
                @if($errors->has('tgl_lahir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_lahir') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mGuru.fields.tgl_lahir_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tempat_lahir">{{ trans('cruds.mGuru.fields.tempat_lahir') }}</label>
                <input class="form-control {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}" type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $mGuru->tempat_lahir) }}" required>
                @if($errors->has('tempat_lahir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tempat_lahir') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mGuru.fields.tempat_lahir_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="mulai_bekerja">{{ trans('cruds.mGuru.fields.mulai_bekerja') }}</label>
                <input class="form-control date {{ $errors->has('mulai_bekerja') ? 'is-invalid' : '' }}" type="text" name="mulai_bekerja" id="mulai_bekerja" value="{{ old('mulai_bekerja', $mGuru->mulai_bekerja) }}" required>
                @if($errors->has('mulai_bekerja'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mulai_bekerja') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mGuru.fields.mulai_bekerja_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id">{{ trans('cruds.mGuru.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                    @foreach($statuses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $mGuru->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mGuru.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.mGuru.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.mGuru.fields.photo_helper') }}</span>
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
    url: '{{ route('admin.m-gurus.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
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
@if(isset($mGuru) && $mGuru->photo)
      var file = {!! json_encode($mGuru->photo) !!}
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