@extends('layouts.admin')
@section('content')
@can('question_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.questions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.question.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.question.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Question">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.question.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.question.fields.test') }}
                        </th>
                        <th>
                            {{ trans('cruds.question.fields.question_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.question.fields.question_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.question.fields.points') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $key => $question)
                        <tr data-entry-id="{{ $question->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $question->id ?? '' }}
                            </td>
                            <td>
                                {{ $question->test->title ?? '' }}
                            </td>
                            <td>
                                {{ $question->question_text ?? '' }}
                            </td>
                            <td>
                                @if($question->question_image)
                                    <a href="{{ $question->question_image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $question->question_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $question->points ?? '' }}
                            </td>
                            <td>
                                @can('question_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.questions.show', $question->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('question_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.questions.edit', $question->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('question_delete')
                                    <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('question_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.questions.massDestroy') }}",
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
  let table = $('.datatable-Question:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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