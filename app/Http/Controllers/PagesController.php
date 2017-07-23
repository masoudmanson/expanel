<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function rate()
    {
        return view('pages.rate');
    }
    public function transactions()
    {
        return view('pages.transactions');
    }
    public function factors()
    {
        return view('pages.factors');
    }
    public function settings()
    {
        return view('pages.settings');
    }
}
