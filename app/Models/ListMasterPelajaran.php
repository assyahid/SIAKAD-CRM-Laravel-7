<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListMasterPelajaran extends Model
{
    use SoftDeletes;

    public $table = 'list_master_pelajarans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function pelajaranListJadwalPelajarans()
    {
        return $this->hasMany(ListJadwalPelajaran::class, 'pelajaran_id', 'id');
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
