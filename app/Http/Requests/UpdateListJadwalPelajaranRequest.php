<?php

namespace App\Http\Requests;

use App\Models\ListJadwalPelajaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateListJadwalPelajaranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('list_jadwal_pelajaran_edit');
    }

    public function rules()
    {
        return [
            'tahun_ajaran_id' => [
                'required',
                'integer',
            ],
            'jurusan_id' => [
                'required',
                'integer',
            ],
            'pelajaran_id' => [
                'required',
                'integer',
            ],
            'dari_jam' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'sampai_jam' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'guru_id' => [
                'required',
                'integer',
            ],
            'kelas_id' => [
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
