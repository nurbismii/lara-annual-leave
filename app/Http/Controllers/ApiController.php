<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function searchEmployee(Request $request)
    {
        $search = $request->q;
        $data = DB::connection('hris')->table('employees')->select('nik', 'nama_karyawan')->where('nik', 'like', '%' . $search . '%')->where('status_resign', '!=', NULL)->limit(25)->get();
        return response()->json($data);
    }

    public function getEmployeeById($id)
    {
        $data = DB::connection('hris')->table('employees')
            ->leftjoin('divisis', 'divisis.id', '=', 'employees.divisi_id')
            ->leftjoin('departemens', 'departemens.id', '=', 'divisis.departemen_id')->select('*')->where('nik', $id)->first();
        return response()->json($data);
    }
}
