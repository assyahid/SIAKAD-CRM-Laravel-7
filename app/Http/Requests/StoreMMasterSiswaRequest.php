<?php

namespace App\Http\Requests;

use App\Models\MMasterSiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMMasterSiswaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('m_master_siswa_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'required',
            ],
            'tgl_lahir' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'nisn' => [
                'string',
                'required',
                'unique:m_master_siswas',
            ],
            'angkatan_id' => [
                'required',
                'integer',
            ],
            'jurusan_id' => [
                'required',
                'integer',
            ],
            'kelas_id' => [
                'required',
                'integer',
            ],
            'kelamin_id' => [
                'required',
                'integer',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
