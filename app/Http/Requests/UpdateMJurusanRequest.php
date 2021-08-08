<?php

namespace App\Http\Requests;

use App\Models\MJurusan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMJurusanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('m_jurusan_edit');
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
