<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index ()
    {
        try {
            $role = Auth::user()->role;
            if($role == 'admin') {
                return view('admin.dashboard')->with('datatables', $this->getDataTables());
            }elseif ($role == 'owner' || $role == 'pekerja') {
                // dd($this->getMachineId());
                return view('dashboard')->with('machineid', $this->getMachineId());
            }else {
                return '404';
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function dataPekerjaDanOwner()
    {
        if(auth()->user()->role != 'admin') {
            return '404';
        }
        $users = DB::table('users')
        ->whereIn('role', ['pekerja', 'owner'])
        ->get(['id', 'username', 'owner_username', 'role'])
        ->sortBy('role');
        // dd($users);
        return view('admin.dashboard')->with('users', $users);
    }

    public function ubahUsername(Request $request)
    {
        // dd($request);
        if(User::where('username', $request->new_username)->first() != null) {
            return back()->with('failed', 'Sudah ada username dengan nama tersebut');
        }else {
            if($request->role == 'owner'){
                    User::where('owner_username', $request->old_username)
                    ->where('role', 'pekerja')
                    ->update(['owner_username' => $request->new_username]);

                    DB::table('machines')->where('owner_username', $request->old_username)->update(['owner_username' => $request->new_username]);
            }
            User::where('username', $request->old_username)
            ->update(['username' => $request->new_username]);

            return back()->with('success', 'username berhasil diubah');
        }
    }

    public function resetPassword(Request $request)
    {
        // dd($request);
        $user = User::where('id', $request->userid)->update([
            'password' => Hash::make($request->password)
        ]);
        if($user > 0) {
            return back()->with('success', 'Berhasil reset kata sandi');
        }else {
            return back()->with('failed', 'Gagal reset kata sandi');
        }
    }
    public function tambahOwnerFromAdmin(Request $request)
    {
        try {
            User::create([
                'username' => $request->username_owner,
                'role' => 'owner',
                'password' => $request->password_owner,
            ]);
            return back()->with('success', 'Berhasil tambah akun owner');
        } catch (\Throwable $th) {
            if(str_contains(strtolower($th->getMessage()), 'duplicate entry')) {
                return back()->with('failed', 'Error duplikat');
            }
        }
    }
    public function tambahPekerjaFromAdmin(Request $request)
    {
        try {
            User::create([
                'username' => $request->username_pekerja,
                'owner_username' => $request->username_owner_for_pekerja,
                'password' => $request->password_pekerja,
            ]);
            return back()->with('success', 'Berhasil tambah akun pekerja');
        } catch (\Throwable $th) {
            if(str_contains(strtolower($th->getMessage()), 'duplicate entry')) {
                return back()->with('failed', 'Error duplikat');
            }
        }
    }
    public function deletePekerjaDanOwner(Request $request)
    {
        User::where('id', $request->id)
        ->delete();
        return back()->with('success', 'Berhasil hapus data');
    }

    public function getDataTables()
    {
        $datatables = DB::table('machines')->select('machineid', 'owner_username')->get();
        return $datatables;
    }

    public function getMachineId()
    {
        $role = Auth::user()->role;
        $machineid = null;
        if ($role == 'owner') {
            $machineid = DB::table('machines')->where('owner_username', Auth::user()->username)->value('machineid');
        } elseif($role == 'pekerja') {
            $machineid = DB::table('machines')->where('owner_username', Auth::user()->owner_username)->value('machineid');
        }
        return $machineid;
    }

    public function getMachineState(Request $request)
    {
        try {
            $machineid = $request->machineid;
            $states = DB::table('machines')
                        ->select('isactive', 'temperature')
                        ->where('machineid', $machineid)
                        ->first();
            $todayProd = DB::table('stats')
                            ->select('weight')
                            ->where('machineid', $machineid)
                            ->where('weight', '>', 0)
                            ->whereBetween('created_at', [date(now('Asia/Jakarta')->startOfDay()), date(now('Asia/Jakarta'))])
                            ->orderBy('created_at')
                            ->get()
                            ->sum('weight');
            return response()->json(['isactive' => (boolean)$states->isactive, 'temperature' => $states->temperature, 'todayprod' => $todayProd]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }

    public function getAyakanState(Request $request)
    {
        try {
            $machineid = $request->machineid;
            $ayakan = DB::table('machines')
                        ->select('isayakanactive')
                        ->where('machineid', $machineid)
                        ->first();
            return response($ayakan->isayakanactive);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    public function setAyakanPower(Request $request)
    {
        try {
            DB::table('machines')
            ->where('machineid', $request->machineid)
            ->update(['isayakanactive' => $request->power]);

            return response()->noContent();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    public function espGetMachineTodayProd(Request $request) {
        try {
            $machineid = $request->machineid;
            $todayProd = DB::table('stats')
            ->select('weight')
            ->where('machineid', $machineid)
            ->where('weight', '>', 0)
            ->whereBetween('created_at', [date(now('Asia/Jakarta')->startOfDay()), date(now('Asia/Jakarta'))])
            ->orderBy('created_at')
            ->get()
            ->sum('weight');
            return response($todayProd / 1000);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }

    public function espGetMachineState(Request $request)
    {
        try {
            $machineid = $request->machineid;
            $state = DB::table('machines')
                        ->select('isactive')
                        ->where('machineid', $machineid)
                        ->first();
            return response($state->isactive);
        } catch (\Throwable $th) {
            return response($th);
        }
    }

    public function espGetMachineStateSuhu(Request $request)
    {
        try {
            $machineid = $request->machineid;
            $state = DB::table('machines')
                        ->select('temperature')
                        ->where('machineid', $machineid)
                        ->first();
            return response($state->temperature);
        } catch (\Throwable $th) {
            return response($th);
        }
    }

    public function setMachinePower(Request $request)
    {
        try {
            DB::table('machines')
            ->where('machineid', $request->machineid)
            ->update(['isactive' => $request->power]);

            return response()->noContent();
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }

    public function setMachineTemperature(Request $request)
    {
        try {
            DB::table('machines')
            ->where('machineid', $request->machineid)
            ->update(['temperature' => $request->temperature]);

            return response('OK. suhu mesin sekarang ' . $request->temperature . ' derajat');
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
        }
    }
}
