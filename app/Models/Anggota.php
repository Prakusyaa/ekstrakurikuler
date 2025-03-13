<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota_ekstrakurikuler';

    protected $fillable = ['user_id', 'ekskul_id'];
    
    public function anggota()
    {
        return $this->hasMany(AnggotaEkstrakurikuler::class, 'ekstrakurikuler_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ekstrakurikuler()
    {
        return $this->belongsTo(Ekstrakurikuler::class, 'ekskul_id');
    }
}
