<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rules\MatchOldPassword;

class SettingsController extends Controller
{
    public function index()
    {
        if(auth()->user()->isAdmin) {
            return redirect('dashboard');
        }
        
        $machineid = DB::table('machines')->where('userid', auth()->user()->id)->value('machineid');
        return view('settings')->with('machineid', $machineid);
    }

    public function updateBond(Request $request)
    {
        $option = $request->option;
        $userid = $request->userid ?? auth()->user()->id;

        if($option == 'bind') {
            $machine = DB::table('machines')
                            ->where('userid', null, null)
                            ->where('machineid', $request->machineid)
                            ->update(['userid' => $userid]);

            if($machine == 1) {
                return back()->with('success', 'Berhasil menghubungkan id mesin');
                // dd('Berhasil menghubungkan id mesin');
            }else if($machine == 0) {
                return back()->with('failed', 'Gagal menghubungkan id mesin');
                // dd('Gagal menghubungkan id mesin');
            }
        } else if($option == 'unbind') {
            $machine = DB::table('machines')
            ->where('userid', $userid)
            ->where('machineid', $request->machineid)
            ->update(['userid' => null]);

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
            'userid' => $request->userid,
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
}
