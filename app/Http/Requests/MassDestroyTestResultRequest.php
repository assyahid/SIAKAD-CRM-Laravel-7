<?php

namespace App\Http\Requests;

use App\Models\TestResult;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTestResultRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('test_result_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:test_results,id',
        ];
    }
}
