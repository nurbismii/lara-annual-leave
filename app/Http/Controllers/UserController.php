<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function store(Request $request)
    {
        if ($request->password != $request->confirmed) {
            return back()->with('error', 'Opps, konfirmasi kata sandi tidak sesuai.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'access' => 2
        ]);

        return back()->with('Yeah!, Berhasil melakukan penambahan pengguna baru.');
    }

    public function update(Request $request, $id)
    {
        if ($request->filled('password')) {

            if ($request->password != $request->confirmed) {
                return back()->with('error', 'Opps, konfirmasi kata sandi tidak sesuai.');
            }

            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            return back()->with('success', 'Yeah!, Berhasil melakukan perubahan data pengguna.');
        }

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return back()->with('success', 'Yeah!, Berhasil melakukan perubahan data pengguna.');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return back()->with('success', 'Yeah!, Berhasil menghapus data pengguna.');
    }
}
