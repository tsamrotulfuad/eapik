<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use Illuminate\Http\Request;

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
        $kajian = Kajian::limit(9)->get();

        return view('kajian', compact('breadcrump', 'kajian'));
    }

    public function kajian_show($slug)
    {
        $kajian = Kajian::where('slug', $slug)->firstOrFail();
        
        return view('kajian-show', compact('kajian'));
    }
}
