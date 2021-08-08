<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mkelamin extends Model
{
    use SoftDeletes;

    public $table = 'mkelamins';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function kelaminMMasterSiswas()
    {
        return $this->hasMany(MMasterSiswa::class, 'kelamin_id', 'id');
    }

    public function kelaminMGurus()
    {
        return $this->hasMany(MGuru::class, 'kelamin_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
