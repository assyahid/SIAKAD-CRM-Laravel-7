<?php

namespace App\Http\Requests;

use App\Models\MMasterSiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMMasterSiswaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('m_master_siswa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:m_master_siswas,id',
        ];
    }
}
