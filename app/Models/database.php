<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Database extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    // Mencegah error "format() on string" saat mengolah tanggal
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pull($laundry, $kondisi)
    {
        return DB::table($laundry)->where($kondisi)->first();
    }

    public function tampil($tabel)
    {
        return DB::table($tabel)->get();
    }
}