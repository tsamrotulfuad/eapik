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
        return view('kajian');
    }

    public function kajian_show($slug)
    {
        $kajian = Kajian::where('slug', $slug)->firstOrFail();
        
        return view('kajian-show', compact('kajian'));
    }
}
