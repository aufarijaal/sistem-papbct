<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index()
    {
        if(auth()->user()->role != 'owner') {
            return redirect('dashboard');
        }

        $machineid = DB::table('machines')->where('owner_username', auth()->user()->username)->value('machineid');
        return view('stats')->with('machineid', $machineid);
    }

    public function getAllStats() {
        $machineid = DB::table('machines')->where('userid', auth()->user()->id)->value('machineid');
        $stats = DB::table('stats')
                    ->select('weight', 'created_at')
                    ->where('machineid', $machineid)
                    ->where('weight', '>', 0)
                    ->orderBy('created_at')
                    ->get();
        return view('get-all-stats', compact('stats'));
    }

    public function exportPDF() {
        set_time_limit(300);
        $machineid = DB::table('machines')->where('userid', auth()->user()->id)->value('machineid');
        $stats = DB::table('stats')
                    ->select('weight', 'created_at')
                    ->where('machineid', $machineid)
                    ->where('weight', '>', 0)
                    ->orderBy('created_at')
                    ->get();

        $pdf = PDF::loadView('welcome', ['data' => $stats]);

        return $pdf->download('stats.pdf');
      }

    public function getProd(Request $request)
    {
        $filter = $request->filter;
        $machineid = $request->machineid;
        $hari = date(now('Asia/Jakarta')->startOfDay());
        $pekan = date(now('Asia/Jakarta')->subDays(7));
        $bulan = date(now('Asia/Jakarta')->subDays(30));

        $stats = DB::table('stats')
                    ->select('weight', 'created_at')
                    ->where('machineid', $machineid)
                    ->where('weight', '>', 0)
                    ->whereBetween('created_at', [($filter == 'hari') ? $hari : (($filter == 'pekan') ? $pekan : $bulan), date(now('Asia/Jakarta'))])
                    ->orderBy('created_at')
                    ->get();
        return response()->json($stats, 200, [], JSON_NUMERIC_CHECK);
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

    public function simpanProduksi(Request $request)
    {
        $date = date(now('Asia/Jakarta'));
        $stat = DB::table('stats')->insert([
            'machineid' => $request->machineid,
            'weight' => $request->berat,
            'created_at' => $date,
            'updated_at' => $date
        ]);
        return response()->json(['message' => $stat . ' OK. berhasil membuat produksi baru [' . $date . '] => ' . $request->berat . ' Gram']);
    }
}
