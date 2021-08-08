<?php

namespace App\Http\Requests;

use App\Models\ListJadwalPelajaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyListJadwalPelajaranRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('list_jadwal_pelajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:list_jadwal_pelajarans,id',
        ];
    }
}
