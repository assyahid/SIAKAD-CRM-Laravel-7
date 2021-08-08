<?php

namespace App\Http\Requests;

use App\Models\TestAnswer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTestAnswerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('test_answer_create');
    }

    public function rules()
    {
        return [
            'test_result_id' => [
                'required',
                'integer',
            ],
            'question_id' => [
                'required',
                'integer',
            ],
            'option_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
