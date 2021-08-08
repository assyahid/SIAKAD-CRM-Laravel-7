<?php

namespace App\Http\Requests;

use App\Models\MTahunAjaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMTahunAjaranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('m_tahun_ajaran_create');
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
