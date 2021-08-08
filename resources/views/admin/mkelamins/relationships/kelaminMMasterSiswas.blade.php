@can('m_master_siswa_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.m-master-siswas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mMasterSiswa.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.mMasterSiswa.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-kelaminMMasterSiswas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.tgl_lahir') }}
                        </th>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.nisn') }}
                        </th>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.angkatan') }}
                        </th>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.jurusan') }}
                        </th>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.kelas') }}
                        </th>
                        <th>
                            {{ trans('cruds.mkela.fields.kuota') }}
                        </th>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.kelamin') }}
                        </th>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.mMasterSiswa.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mMasterSiswas as $key => $mMasterSiswa)
                        <tr data-entry-id="{{ $mMasterSiswa->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $mMasterSiswa->id ?? '' }}
                            </td>
                            <td>
                                {{ $mMasterSiswa->nama ?? '' }}
                            </td>
                            <td>
                                {{ $mMasterSiswa->tgl_lahir ?? '' }}
                            </td>
                            <td>
                                {{ $mMasterSiswa->nisn ?? '' }}
                            </td>
                            <td>
                                {{ $mMasterSiswa->angkatan->nama ?? '' }}
                            </td>
                            <td>
                                {{ $mMasterSiswa->jurusan->nama ?? '' }}
                            </td>
                            <td>
                                {{ $mMasterSiswa->kelas->nama ?? '' }}
                            </td>
                            <td>
                                {{ $mMasterSiswa->kelas->kuota ?? '' }}
                            </td>
                            <td>
                                {{ $mMasterSiswa->kelamin->nama ?? '' }}
                            </td>
                            <td>
                                @if($mMasterSiswa->photo)
                                    <a href="{{ $mMasterSiswa->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $mMasterSiswa->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $mMasterSiswa->status->nama ?? '' }}
                            </td>
                            <td>
                                @can('m_master_siswa_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.m-master-siswas.show', $mMasterSiswa->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('m_master_siswa_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.m-master-siswas.edit', $mMasterSiswa->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('m_master_siswa_delete')
                                    <form action="{{ route('admin.m-master-siswas.destroy', $mMasterSiswa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('m_master_siswa_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.m-master-siswas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-kelaminMMasterSiswas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('div#sidebar').on('transitionend', function(e) {
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  })
  
})

</script>
@endsection