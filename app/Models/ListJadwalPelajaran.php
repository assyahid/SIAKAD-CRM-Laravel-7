<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListJadwalPelajaran extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'list_jadwal_pelajarans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tahun_ajaran_id',
        'jurusan_id',
        'pelajaran_id',
        'dari_jam',
        'sampai_jam',
        'guru_id',
        'kelas_id',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tahun_ajaran()
    {
        return $this->belongsTo(MTahunAjaran::class, 'tahun_ajaran_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(MJurusan::class, 'jurusan_id');
    }

    public function pelajaran()
    {
        return $this->belongsTo(ListMasterPelajaran::class, 'pelajaran_id');
    }

    public function guru()
    {
        return $this->belongsTo(MGuru::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Mkela::class, 'kelas_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
