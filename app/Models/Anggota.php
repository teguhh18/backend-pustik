<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'anggota';
    protected $guarded = ['id'];
     public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
