<?php

namespace App\Http\Requests;

use App\Models\Mkela;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMkelaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mkela_edit');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'required',
                'unique:mkelas,nama,' . request()->route('mkela')->id,
            ],
            'kuota' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
