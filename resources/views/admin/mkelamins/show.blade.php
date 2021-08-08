@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mkelamin.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mkelamins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mkelamin.fields.id') }}
                        </th>
                        <td>
                            {{ $mkelamin->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mkelamin.fields.nama') }}
                        </th>
                        <td>
                            {{ $mkelamin->nama }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mkelamins.index') }}">
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
            <a class="nav-link" href="#kelamin_m_master_siswas" role="tab" data-toggle="tab">
                {{ trans('cruds.mMasterSiswa.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#kelamin_m_gurus" role="tab" data-toggle="tab">
                {{ trans('cruds.mGuru.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="kelamin_m_master_siswas">
            @includeIf('admin.mkelamins.relationships.kelaminMMasterSiswas', ['mMasterSiswas' => $mkelamin->kelaminMMasterSiswas])
        </div>
        <div class="tab-pane" role="tabpanel" id="kelamin_m_gurus">
            @includeIf('admin.mkelamins.relationships.kelaminMGurus', ['mGurus' => $mkelamin->kelaminMGurus])
        </div>
    </div>
</div>

@endsection