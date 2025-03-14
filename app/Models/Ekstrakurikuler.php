<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ekstrakurikuler';
    protected $fillable = ['nama', 'deskripsi', 'guru_pembimbing', 'created_by'];

    public function anggota()
        {
            return $this->hasMany(Anggota::class, 'ekskul_id');
        }
}
