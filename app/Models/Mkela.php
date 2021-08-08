<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mkela extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'mkelas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'kuota',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function kelasMMasterSiswas()
    {
        return $this->hasMany(MMasterSiswa::class, 'kelas_id', 'id');
    }

    public function kelasListJadwalPelajarans()
    {
        return $this->hasMany(ListJadwalPelajaran::class, 'kelas_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
