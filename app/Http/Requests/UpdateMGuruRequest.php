<?php

namespace App\Http\Requests;

use App\Models\MGuru;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMGuruRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('m_guru_edit');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'required',
            ],
            'alamat' => [
                'string',
                'nullable',
            ],
            'kelamin_id' => [
                'required',
                'integer',
            ],
            'nik' => [
                'string',
                'required',
            ],
            'tgl_lahir' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'tempat_lahir' => [
                'string',
                'required',
            ],
            'mulai_bekerja' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
