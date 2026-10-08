<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\database;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport; // Import class Export Excel
use Maatwebsite\Excel\Facades\Excel; // Import Facade Excel

class login extends Controller
{
    public function index()
    {
        return view("login");
    }

    public function aksilogin(Request $request)
    {
        $username = $request->input("username");
        $password = $request->input("password");

        $where = array(
            'name' => $username,
            'password' => $password
        );

        $girasya = new database();
        $zelly = $girasya->pull('users', $where);

        if ($zelly) {
            session(['u' => $zelly->name]);
            return redirect('/home');
        } else {
            return redirect('/')->with('error', 'Username atau Password salah!');
        }
    }

    public function home(Request $request)
    { 
        if (session('u')) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            // Filter rentang tanggal
            if ($start_date && $end_date) {
                $helo['users'] = DB::table('users')
                    ->whereBetween('created_at', [
                        $start_date . ' 00:00:00', 
                        $end_date . ' 23:59:59'
                    ])
                    ->get();
            } else {
                $girasya = new database();
                $helo['users'] = $girasya->tampil('users');
            }

            return view('home', $helo);
        } else {
            return redirect('/');
        }
    }

    // --- FUNGSI EXPORT EXCEL ---
    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'Data_User.xlsx');
    }

    // --- FUNGSI EXPORT/PRINT PDF TERHUBUNG TCPDF ---
   public function printPdf(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = DB::table('users');

        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [
                $start_date . ' 00:00:00', 
                $end_date . ' 23:59:59'
            ]);
        }

        $users = $query->get();

        $html = view('pdf_users', compact('users', 'start_date', 'end_date'))->render();

        if (ob_get_length()) {
            ob_end_clean();
        }

        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetTitle('Laporan Data User');
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        // Menggunakan 'D' agar langsung mengunduh file PDF
        $pdf->Output('Laporan_Data_User.pdf', 'D');
        exit;
    }

    public function signup(Request $request)
    {
        $girasya = $request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        database::create($girasya);
        session(['u' => $girasya['name']]);

        return redirect('/home')->with('success', 'Data berhasil ditambahkan');
    }

    public function register()
    {
        return view("inputdata");
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view("edit", ['user' => $user]);
    }

    public function editdata(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        return redirect('/home')->with('success', 'Data berhasil diperbarui');
    }

    public function hapusdata($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect('/home')->with('success', 'Data berhasil dihapus');
    }
}