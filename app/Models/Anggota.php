<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota_ekstrakurikuler';
    public $timestamps = true;

    protected $fillable = [
        'user_id', 
        'nama', 
        'ekskul_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->created_at = $model->created_at ?: now();
            $model->updated_at = $model->updated_at ?: now();
        });
    }
    
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'ekstrakurikuler_id');
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
