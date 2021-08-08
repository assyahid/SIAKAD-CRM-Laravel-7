<?php

namespace App\Http\Requests;

use App\Models\MGuru;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMGuruRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('m_guru_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:m_gurus,id',
        ];
    }
}
