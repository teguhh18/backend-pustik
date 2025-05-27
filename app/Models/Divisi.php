<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'divisi';
    protected $guarded = ['id'];

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }
}
