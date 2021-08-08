<?php

namespace App\Http\Requests;

use App\Models\MTahunAjaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMTahunAjaranRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('m_tahun_ajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:m_tahun_ajarans,id',
        ];
    }
}
