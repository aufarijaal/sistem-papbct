<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index ()
    {
        return Auth::user()->isAdmin ?
            view('admin.dashboard')->with('datatables', $this->getDataTables()) :
            view('dashboard')->with('machineid', $this->getMachineId());
    }

    public function getDataTables()
    {
        $datatables = DB::table('machines')->select('machineid', 'userid')->get();
        return $datatables;
    }

    public function getMachineId()
    {
        $machineid = DB::table('machines')->where('userid', auth()->user()->id)->value('machineid');
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
                            ->whereBetween('created_at', [date(now()->startOfDay()), date(now())])
                            ->orderBy('created_at')
                            ->get()
                            ->sum('weight');
            return response()->json(['isactive' => $states->isactive, 'temperature' => $states->temperature, 'todayprod' => $todayProd]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th]);
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
            return response('error');
        }
    }

    public function setMachinePower(Request $request)
    {
        try {
            DB::table('machines')
            ->where('machineid', $request->machineid)
            ->update(['isactive' => $request->power]);

            return response('OK. Status mesin sekarang ' . $request->power ? 'On' : 'Off');
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
