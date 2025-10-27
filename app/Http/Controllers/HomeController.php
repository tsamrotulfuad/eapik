<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use Jorenvh\Share\Share;
use App\Models\Infografis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        return view('home');
    }

    public function rekakarsacipta()
    {
        return view('rekakarsacipta');
    }

    public function kajian()
    {
        $breadcrump = 'Daftar Kajian';
        $kajian = DB::table('kajians')
            ->join('bidangs', 'bidangs.id', '=', 'kajians.bidang_id')
            ->orderBy('tahun_kajian', 'desc')
            ->limit(9)
            ->get();

        return view('kajian', compact('breadcrump', 'kajian'));
    }

    public function kajian_show($slug)
    {
        $kajian = Kajian::where('slug', $slug)->firstOrFail();
        
        return view('kajian-show', compact('kajian'));
    }

    public function infografis()
    {
        $breadcrump = 'Daftar Infografis';
        // $infografis = DB::table('infografis')
        //     ->join('bidangs', 'bidangs.id', '=', 'infografis.bidang_id')
        //     ->orderBy('tahun_infografis', 'desc')
        //     ->limit(9)
        //     ->get();

        $infografis = Infografis::all();

        return view('infografis', compact('breadcrump', 'infografis'));
    }

    public function infografis_show($slug)
    {
        $infografis = Infografis::with('kajian')
            ->where('slug', $slug)->firstOrFail();
         // ✅ Tambah views hanya sekali per sesi agar tidak spam
        $sessionKey = 'post_viewed_' . $infografis->id;

        if (!session()->has($sessionKey)) {
            $infografis->increment('views');
            session([$sessionKey => true]);
        }
        
        return view('infografis-show', compact('infografis'));
    }
}
