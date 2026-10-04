<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class database extends Model
{
    public function pull($laundry, $kondisi)
    {
        return DB::table($laundry)->where($kondisi)->first();
    }

    public function tampil($tabel)
    {
        return DB::table($tabel)->get();
    }
    protected $table ='users';
    protected $fillable=[
        'name',
        'email',
        'password'
    ];
}
