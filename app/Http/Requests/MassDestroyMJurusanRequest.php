<?php

namespace App\Http\Requests;

use App\Models\MJurusan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMJurusanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('m_jurusan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:m_jurusans,id',
        ];
    }
}
