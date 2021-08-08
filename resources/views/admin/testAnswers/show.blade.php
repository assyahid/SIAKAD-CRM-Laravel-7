@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.testAnswer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.test-answers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.testAnswer.fields.id') }}
                        </th>
                        <td>
                            {{ $testAnswer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testAnswer.fields.test_result') }}
                        </th>
                        <td>
                            {{ $testAnswer->test_result->score ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testAnswer.fields.question') }}
                        </th>
                        <td>
                            {{ $testAnswer->question->question_text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testAnswer.fields.option') }}
                        </th>
                        <td>
                            {{ $testAnswer->option->option_text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testAnswer.fields.is_correct') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $testAnswer->is_correct ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.test-answers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection