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

        $check_exist = DB::connection('hris')->table('cuti_izin')
            ->where('nik_karyawan', $request->nik)
            ->whereDate('tanggal', $request->tanggal_pengajuan)->first();

        if ($check_exist) {
            return back()->with('error', 'Opps, data pengajuan telah tersedia');
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

    public function storePaidLeave(Request $request)
    {
        $awal = new DateTime($request->tgl_mulai_izin);
        $akhir = new DateTime($request->tgl_akhir_izin);

        $check_exist = DB::connection('hris')->table('cuti_izin')
            ->where('nik_karyawan', $request->nik)
            ->whereDate('tanggal', $request->tanggal_pengajuan)->first();

        if ($check_exist) {
            return back()->with('error', 'Opps, data pengajuan telah tersedia');
        }

        if ($request->hasFile('foto')) {
            $upload = $request->file('foto');
            $file_name = $request->nik . '-' . $upload->getClientOriginalName();
            $path = public_path('/izin-dibayarkan/' . $request->nik . '/');
            $upload->move($path, $file_name);

            DB::connection('hris')->table('cuti_izin')->insert([
                'nik_karyawan' => $request->nik,
                'tanggal' => $request->tanggal_pengajuan,
                'keterangan' => $request->tipe_izin,
                'jumlah' => $akhir->diff($awal)->days == '0' ? '1' : $akhir->diff($awal)->days + 1,
                'tanggal_mulai' => $request->tgl_mulai_izin,
                'tanggal_berakhir' => $request->tgl_akhir_izin,
                'status_pemohon' => 'ya',
                'status_hrd' => 'Menunggu',
                'status_hod' => 'Diterima',
                'tipe' => 'izin dibayarkan',
                'foto' => $file_name
            ]);
            return back()->with('success', 'Berhasil melakukan pengajuan paid leave');
        }
    }

    public function storeUnpaidLeave(Request $request)
    {
        $awal = new DateTime($request->tgl_mulai_izin);
        $akhir = new DateTime($request->tgl_akhir_izin);

        $check_exist = DB::connection('hris')->table('cuti_izin')
            ->where('nik_karyawan', $request->nik)
            ->whereDate('tanggal', $request->tanggal_pengajuan)->first();

        if ($check_exist) {
            return back()->with('error', 'Opps, data pengajuan telah tersedia');
        }

        DB::connection('hris')->table('cuti_izin')->insert([
            'nik_karyawan' => $request->nik,
            'tanggal' => $request->tanggal_pengajuan,
            'keterangan' => $request->tipe_izin,
            'jumlah' => $akhir->diff($awal)->days == '0' ? '1' : $akhir->diff($awal)->days + 1,
            'tanggal_mulai' => $request->tgl_mulai_izin,
            'tanggal_berakhir' => $request->tgl_akhir_izin,
            'status_pemohon' => 'ya',
            'status_hrd' => 'Menunggu',
            'status_hod' => 'Diterima',
            'tipe' => 'izin tidak dibayarkan',
        ]);

        return back()->with('success', 'Berhasil melakukan pengajuan unpaid leave');
    }
}
