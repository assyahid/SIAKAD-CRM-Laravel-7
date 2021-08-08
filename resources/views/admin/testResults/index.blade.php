@extends('layouts.admin')
@section('content')
@can('test_result_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.test-results.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.testResult.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.testResult.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TestResult">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.testResult.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.testResult.fields.test') }}
                        </th>
                        <th>
                            {{ trans('cruds.testResult.fields.student') }}
                        </th>
                        <th>
                            {{ trans('cruds.testResult.fields.score') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testResults as $key => $testResult)
                        <tr data-entry-id="{{ $testResult->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $testResult->id ?? '' }}
                            </td>
                            <td>
                                {{ $testResult->test->title ?? '' }}
                            </td>
                            <td>
                                {{ $testResult->student->name ?? '' }}
                            </td>
                            <td>
                                {{ $testResult->score ?? '' }}
                            </td>
                            <td>
                                @can('test_result_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.test-results.show', $testResult->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('test_result_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.test-results.edit', $testResult->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('test_result_delete')
                                    <form action="{{ route('admin.test-results.destroy', $testResult->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('test_result_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.test-results.massDestroy') }}",
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
  let table = $('.datatable-TestResult:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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