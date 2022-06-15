<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'admin') {
            return redirect('admin.dashboard');
        }elseif(auth()->user()->role == 'owner') {
            $machineid = DB::table('machines')->where('owner_username', auth()->user()->username)->value('machineid');
            $data_pekerja = DB::table('users')->select('id', 'username')->where('owner_username', auth()->user()->username)->get();
            return view('settings')->with([
                'machineid' => $machineid,
                'employees' => $data_pekerja
            ]);
        }elseif(auth()->user()->role == 'pekerja'){
            $machineid = DB::table('machines')->where('owner_username', auth()->user()->owner_username)->value('machineid');
            return view('settings')->with('machineid', $machineid);
        }else {
            return '404';
        }
    }
    public function registerPekerjaFromOwner(Request $request)
    {
        $validated = $request->validate([
            'pekerja_username' => 'required|min:3|unique:users,username',
            'pekerja_password' => 'required|min:3',
        ]);
        $user = User::create([
            'username' => $validated['pekerja_username'],
            'password' => $validated['pekerja_password'],
            'owner_username' => auth()->user()->username
        ]);
        return back();
    }
    public function resetPasswordPekerja(Request $request)
    {
        $user = User::where('id', $request->pekerja_id)->update([
            'password' => Hash::make($request->pekerja_password)
        ]);
        if($user > 0) {
            return back()->with('owner-settings-pekerja-success', 'Berhasil reset kata sandi pekerja');
        }else {
            return back()->with('owner-settings-pekerja-failed', 'Gagal reset kata sandi pekerja');
        }
    }
    public function deletePekerja(Request $request)
    {
        $user = User::where('id', $request->pekerja_id)->delete();
        if($user > 0) {
            return back()->with('owner-settings-pekerja-success', 'Berhasil hapus data pekerja');
        }else {
            return back()->with('owner-settings-pekerja-failed', 'Gagal hapus data pekerja');
        }
    }
    public function updateBond(Request $request)
    {
        $option = $request->option;
        $owner_username = $request->owner_username ?? auth()->user()->owner_username;

        if($option == 'bind') {
            $machine = DB::table('machines')
                            ->where('owner_username', null, null)
                            ->where('machineid', $request->machineid)
                            ->update(['owner_username' => $owner_username]);

            if($machine == 1) {
                return back()->with('success', 'Berhasil menghubungkan id mesin');
                // dd('Berhasil menghubungkan id mesin');
            }else if($machine == 0) {
                return back()->with('failed', 'Gagal menghubungkan id mesin');
                // dd('Gagal menghubungkan id mesin');
            }
        } else if($option == 'unbind') {
            $machine = DB::table('machines')
            ->where('owner_username', $owner_username)
            ->where('machineid', $request->machineid)
            ->update(['owner_username' => null]);

            if($machine == 1) {
                return back()->with('success', 'Berhasil mencopot id mesin');
                // dd('Berhasil mencopot id mesin');
            }else if($machine == 0) {
                return back()->with('failed', 'Gagal mencopot id mesin');
                // dd('Gagal mencopot id mesin');
            }
        }
        // return response()->json($request);
        // dd($request);
    }

    public function addMachineId (Request $request)
    {
        $request->validate([
            'machineid' => 'required|unique:machines,machineid'
        ]);

        $result = DB::table('machines')->insert([
            'owner_username' => $request->owner_username,
            'machineid' => $request->machineid
        ]);

        return $result ? back()->with('success', 'Berhasil menambahkan id mesin') : back()->with('failed', 'Gagal menambahkan id mesin');
    }

    public function deleteMachineId (Request $request)
    {
        $result = DB::table('machines')
        ->where('machineid', $request->machineid)
        ->delete();

        return $result == 1 ? back()->with('success', 'Berhasil menghapus id mesin') : back()->with('failed', 'Gagal menghapus id mesin');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => new MatchOldPassword,
            'new_password' => ['required'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> $request->new_password]);

        return back()->with('change-success', 'Kata sandi berhasil diubah');
    }

    public function createPekerjaFromOwner(Request $request)
    {
        User::create([
            'username' => $request->pekerja_username,
            'owner_username' => auth()->user()->username,
            'password' => $request->pekerja_password
        ]);
    }
}
