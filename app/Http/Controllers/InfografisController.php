<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Infografis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function downloadAll($id)
    {
        $infografis = Infografis::findOrFail($id);
        $files = $infografis->file_infografis;

        if (empty($files)) {
            return back()->with('error', 'Tidak ada file untuk diunduh.');
        }

        $zipFileName = 'infografis-' . $infografis->slug . '.zip';
        $zipPath = storage_path('app/public/' . $zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($files as $file) {
                $filePath = storage_path('app/public/' . $file);
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($file));
                }
            }
            $zip->close();
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

}
