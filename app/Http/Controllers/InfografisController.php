<?php

namespace App\Http\Controllers;

use App\Models\Infografis;
use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public function index() {
        $breadcrump = 'Daftar Infografis';
        // $infografis = DB::table('infografis')
        //     ->join('bidangs', 'bidangs.id', '=', 'infografis.bidang_id')
        //     ->orderBy('tahun_infografis', 'desc')
        //     ->limit(9)
        //     ->get();

        $infografis = Infografis::with('kajian')->get();

        return view('infografis', compact('breadcrump', 'infografis'));
    }

    public function search(Request $request)
    {
        $search = $request->query('search');

        if (!$search) {
            return response()->json([]);
        }

        $infografis = Infografis::with('bidang')
            ->where('nama_infografis', 'like', "%{$search}%")
            ->orWhere('tahun_infografis', 'like', "%{$search}%")
            ->orWhereHas('bidang', function ($q) use ($search) {
                $q->where('nama_bidang', 'like', "%{$search}%");
            })
            ->latest()
            ->take(10)
            ->get();

        // Transform supaya file_infografis selalu array (jika disimpan sebagai JSON string)
        $result = $infografis->map(function ($i) {
            $files = $i->file_infografis;

            // jika kolom disimpan sebagai string JSON, decode; jika sudah array, biarkan.
            if (is_string($files)) {
                $decoded = json_decode($files, true);
                $files = is_array($decoded) ? $decoded : [];
            } elseif (!is_array($files)) {
                $files = [];
            }

            return [
                'id' => $i->id,
                'slug' => $i->slug,
                'nama_infografis' => $i->nama_infografis,
                'tahun_infografis' => $i->tahun_infografis,
                'file_infografis' => $files,
                'bidang' => $i->bidang ? ['nama_bidang' => $i->bidang->nama_bidang] : null,
            ];
        });

        return response()->json($result);
    }

}
