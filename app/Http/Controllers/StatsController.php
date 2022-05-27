<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index()
    {
        if(auth()->user()->isAdmin) {
            return redirect('dashboard');
        }

        $machineid = DB::table('machines')->where('userid', auth()->user()->id)->value('machineid');
        return view('stats')->with('machineid', $machineid);
    }

    public function getProd(Request $request)
    {
        $filter = $request->filter;
        $machineid = $request->machineid;
        $hari = date(now()->startOfDay());
        $pekan = date(now()->subDays(7));
        $bulan = date(now()->subDays(30));

        $stats = DB::table('stats')
                    ->select('weight', 'created_at')
                    ->where('machineid', $machineid)
                    ->where('weight', '>', 0)
                    ->whereBetween('created_at', [($filter == 'hari') ? $hari : (($filter == 'pekan') ? $pekan : $bulan), date(now())])
                    ->orderBy('created_at')
                    ->get();
        return response()->json($stats);
    }

    public function setProd(Request $request)
    {
        $date = date(now('Asia/Jakarta'));
        $stat = DB::table('stats')->insert([
            'machineid' => $request->machineid,
            'weight' => $request->weight,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        return response($stat . ' OK. berhasil membuat produksi baru [' . $date . '] => ' . $request->weight . ' Kg');
    }
}
