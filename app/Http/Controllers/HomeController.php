<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
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
        $infografis = Infografis::groupBy('tahun_infografis')->limit(6)->get();

        return view('kajian', compact('breadcrump', 'infografis'));
    }
}
