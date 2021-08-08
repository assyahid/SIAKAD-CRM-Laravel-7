<?php

namespace App\Http\Requests;

use App\Models\ListMasterPelajaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateListMasterPelajaranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('list_master_pelajaran_edit');
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
