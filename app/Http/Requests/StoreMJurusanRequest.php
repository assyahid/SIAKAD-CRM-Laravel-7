<?php

namespace App\Http\Requests;

use App\Models\MJurusan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMJurusanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('m_jurusan_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'required',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
