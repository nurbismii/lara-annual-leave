<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();

        $annual_leaves = DB::connection('hris')->table('cuti_izin')
            ->join('employees', 'employees.nik', '=', 'cuti_izin.nik_karyawan')
            ->select('cuti_izin.*', 'employees.nama_karyawan')->get();

        return view('home', compact('users', 'annual_leaves'));
    }

    public function store(Request $request)
    {
        $awal = new DateTime($request->tgl_mulai_cuti);
        $akhir = new DateTime($request->tgl_akhir_cuti);
        $jumlahHari = $akhir->diff($awal)->days == 0 ? 1 : $akhir->diff($awal)->days + 1;

        if ($request->kategori_cuti == 1) {
            return $this->handleCuti($request, $jumlahHari, 'sisa_cuti', 'Hak cuti kamu tidak mencukupi...');
        } else {
            return $this->handleCuti($request, $jumlahHari, 'sisa_cuti_covid', 'Hak cuti covid kamu tidak mencukupi...');
        }
    }

    private function handleCuti(Request $request, $jumlahHari, $cutiField, $errorMessage)
    {
        if ($jumlahHari > $request->$cutiField) {
            return back()->with('error', 'Oops, ' . $errorMessage);
        }

        DB::connection('hris')->table('cuti_izin')->insert([
            'nik_karyawan' => $request->nik,
            'tanggal' => $request->tanggal_pengajuan,
            'keterangan' => $request->keterangan,
            'jumlah' => $jumlahHari,
            'tanggal_mulai' => $request->tgl_mulai_cuti,
            'tanggal_berakhir' => $request->tgl_akhir_cuti,
            'status_pemohon' => 'ya',
            'status_hrd' => 'Menunggu',
            'status_hod' => 'Diterima',
            'status_penanggung_jawab' => 'Menunggu',
            'tipe' => 'cuti',
            'kategori_cuti' => $request->kategori_cuti
        ]);

        return back()->with('success', 'Berhasil melakukan pengajuan');
    }
}
