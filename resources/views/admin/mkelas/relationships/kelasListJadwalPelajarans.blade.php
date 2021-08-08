@can('list_jadwal_pelajaran_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.list-jadwal-pelajarans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.listJadwalPelajaran.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.listJadwalPelajaran.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-kelasListJadwalPelajarans">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.tahun_ajaran') }}
                        </th>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.jurusan') }}
                        </th>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.pelajaran') }}
                        </th>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.dari_jam') }}
                        </th>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.sampai_jam') }}
                        </th>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.guru') }}
                        </th>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.kelas') }}
                        </th>
                        <th>
                            {{ trans('cruds.listJadwalPelajaran.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listJadwalPelajarans as $key => $listJadwalPelajaran)
                        <tr data-entry-id="{{ $listJadwalPelajaran->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $listJadwalPelajaran->id ?? '' }}
                            </td>
                            <td>
                                {{ $listJadwalPelajaran->tahun_ajaran->nama ?? '' }}
                            </td>
                            <td>
                                {{ $listJadwalPelajaran->jurusan->nama ?? '' }}
                            </td>
                            <td>
                                {{ $listJadwalPelajaran->pelajaran->nama ?? '' }}
                            </td>
                            <td>
                                {{ $listJadwalPelajaran->dari_jam ?? '' }}
                            </td>
                            <td>
                                {{ $listJadwalPelajaran->sampai_jam ?? '' }}
                            </td>
                            <td>
                                {{ $listJadwalPelajaran->guru->nama ?? '' }}
                            </td>
                            <td>
                                {{ $listJadwalPelajaran->kelas->nama ?? '' }}
                            </td>
                            <td>
                                {{ $listJadwalPelajaran->status->nama ?? '' }}
                            </td>
                            <td>
                                @can('list_jadwal_pelajaran_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.list-jadwal-pelajarans.show', $listJadwalPelajaran->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('list_jadwal_pelajaran_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.list-jadwal-pelajarans.edit', $listJadwalPelajaran->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('list_jadwal_pelajaran_delete')
                                    <form action="{{ route('admin.list-jadwal-pelajarans.destroy', $listJadwalPelajaran->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('list_jadwal_pelajaran_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.list-jadwal-pelajarans.massDestroy') }}",
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
  let table = $('.datatable-kelasListJadwalPelajarans:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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