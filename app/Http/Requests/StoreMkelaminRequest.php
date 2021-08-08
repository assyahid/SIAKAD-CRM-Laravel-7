<?php

namespace App\Http\Requests;

use App\Models\Mkelamin;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMkelaminRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mkelamin_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'required',
            ],
        ];
    }
}
