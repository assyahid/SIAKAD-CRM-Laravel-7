@can('m_guru_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.m-gurus.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mGuru.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.mGuru.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-kelaminMGurus">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.mGuru.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.mGuru.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.mGuru.fields.alamat') }}
                        </th>
                        <th>
                            {{ trans('cruds.mGuru.fields.kelamin') }}
                        </th>
                        <th>
                            {{ trans('cruds.mGuru.fields.nik') }}
                        </th>
                        <th>
                            {{ trans('cruds.mGuru.fields.tgl_lahir') }}
                        </th>
                        <th>
                            {{ trans('cruds.mGuru.fields.tempat_lahir') }}
                        </th>
                        <th>
                            {{ trans('cruds.mGuru.fields.mulai_bekerja') }}
                        </th>
                        <th>
                            {{ trans('cruds.mGuru.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.mGuru.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mGurus as $key => $mGuru)
                        <tr data-entry-id="{{ $mGuru->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $mGuru->id ?? '' }}
                            </td>
                            <td>
                                {{ $mGuru->nama ?? '' }}
                            </td>
                            <td>
                                {{ $mGuru->alamat ?? '' }}
                            </td>
                            <td>
                                {{ $mGuru->kelamin->nama ?? '' }}
                            </td>
                            <td>
                                {{ $mGuru->nik ?? '' }}
                            </td>
                            <td>
                                {{ $mGuru->tgl_lahir ?? '' }}
                            </td>
                            <td>
                                {{ $mGuru->tempat_lahir ?? '' }}
                            </td>
                            <td>
                                {{ $mGuru->mulai_bekerja ?? '' }}
                            </td>
                            <td>
                                {{ $mGuru->status->nama ?? '' }}
                            </td>
                            <td>
                                @if($mGuru->photo)
                                    <a href="{{ $mGuru->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $mGuru->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('m_guru_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.m-gurus.show', $mGuru->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('m_guru_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.m-gurus.edit', $mGuru->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('m_guru_delete')
                                    <form action="{{ route('admin.m-gurus.destroy', $mGuru->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('m_guru_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.m-gurus.massDestroy') }}",
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
  let table = $('.datatable-kelaminMGurus:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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