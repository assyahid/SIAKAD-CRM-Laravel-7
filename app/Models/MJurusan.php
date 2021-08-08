<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MJurusan extends Model
{
    use SoftDeletes;

    public $table = 'm_jurusans';

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

    public function jurusanMMasterSiswas()
    {
        return $this->hasMany(MMasterSiswa::class, 'jurusan_id', 'id');
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
