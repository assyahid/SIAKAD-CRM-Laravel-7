@extends('layouts.admin')
@section('content')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ListJadwalPelajaran">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('list_jadwal_pelajaran_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.list-jadwal-pelajarans.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.list-jadwal-pelajarans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'tahun_ajaran_nama', name: 'tahun_ajaran.nama' },
{ data: 'jurusan_nama', name: 'jurusan.nama' },
{ data: 'pelajaran_nama', name: 'pelajaran.nama' },
{ data: 'dari_jam', name: 'dari_jam' },
{ data: 'sampai_jam', name: 'sampai_jam' },
{ data: 'guru_nama', name: 'guru.nama' },
{ data: 'kelas_nama', name: 'kelas.nama' },
{ data: 'status_nama', name: 'status.nama' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ListJadwalPelajaran').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection