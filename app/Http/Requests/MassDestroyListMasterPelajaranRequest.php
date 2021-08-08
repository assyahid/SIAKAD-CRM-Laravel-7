<?php

namespace App\Http\Requests;

use App\Models\ListMasterPelajaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyListMasterPelajaranRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('list_master_pelajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:list_master_pelajarans,id',
        ];
    }
}
