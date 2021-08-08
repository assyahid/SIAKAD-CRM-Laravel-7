<?php

namespace App\Http\Requests;

use App\Models\Mkela;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMkelaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mkela_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mkelas,id',
        ];
    }
}
