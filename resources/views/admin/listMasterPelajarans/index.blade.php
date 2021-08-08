@extends('layouts.admin')
@section('content')
@can('list_master_pelajaran_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.list-master-pelajarans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.listMasterPelajaran.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.listMasterPelajaran.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ListMasterPelajaran">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.listMasterPelajaran.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.listMasterPelajaran.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.listMasterPelajaran.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listMasterPelajarans as $key => $listMasterPelajaran)
                        <tr data-entry-id="{{ $listMasterPelajaran->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $listMasterPelajaran->id ?? '' }}
                            </td>
                            <td>
                                {{ $listMasterPelajaran->nama ?? '' }}
                            </td>
                            <td>
                                {{ $listMasterPelajaran->status->nama ?? '' }}
                            </td>
                            <td>
                                @can('list_master_pelajaran_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.list-master-pelajarans.show', $listMasterPelajaran->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('list_master_pelajaran_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.list-master-pelajarans.edit', $listMasterPelajaran->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('list_master_pelajaran_delete')
                                    <form action="{{ route('admin.list-master-pelajarans.destroy', $listMasterPelajaran->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('list_master_pelajaran_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.list-master-pelajarans.massDestroy') }}",
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
  let table = $('.datatable-ListMasterPelajaran:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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