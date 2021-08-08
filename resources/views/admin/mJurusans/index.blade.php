@extends('layouts.admin')
@section('content')
@can('m_jurusan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.m-jurusans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mJurusan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.mJurusan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-MJurusan">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.mJurusan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.mJurusan.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.mJurusan.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mJurusans as $key => $mJurusan)
                        <tr data-entry-id="{{ $mJurusan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $mJurusan->id ?? '' }}
                            </td>
                            <td>
                                {{ $mJurusan->nama ?? '' }}
                            </td>
                            <td>
                                {{ $mJurusan->status->nama ?? '' }}
                            </td>
                            <td>
                                @can('m_jurusan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.m-jurusans.show', $mJurusan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('m_jurusan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.m-jurusans.edit', $mJurusan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('m_jurusan_delete')
                                    <form action="{{ route('admin.m-jurusans.destroy', $mJurusan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('m_jurusan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.m-jurusans.massDestroy') }}",
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
  let table = $('.datatable-MJurusan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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