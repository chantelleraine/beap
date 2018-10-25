<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:director');
    }
    public function index(){
        $title = 'Welcome to BEAP!';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function dashboard(){
        $title = 'dashboard';
        return view('pages.dashboard')->with('title', $title);
    }

    public function reports(){
        $title = 'reports';
        return view('pages.reports')->with('title', $title);
    }

    public function calamities(){
        $title = 'Add a calamity';
        return view('pages.calamityposts')->with('title', $title);
    }

    public function illustrations(){
        $title = 'Add an illustration';
        return view('pages.illustrationposts')->with('title', $title);
    }
}
