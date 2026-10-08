<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class UsersExport implements FromCollection
{
    protected $start_date;
    protected $end_date;

    // Menerima parameter tanggal dari Controller
    public function __construct($start_date = null, $end_date = null)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        $query = DB::table('users');

        // Menggunakan whereDate agar data yang diambil presisi sesuai filter
        if ($this->start_date && $this->end_date) {
            $query->whereDate('created_at', '>=', $this->start_date)
                  ->whereDate('created_at', '<=', $this->end_date);
        }

        return $query->get();
    }
}