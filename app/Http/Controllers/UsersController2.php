<?php

namespace App\Http\Controllers;

use App\Client;
use App\Identifier;
use App\Traits\ExportTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
//use Input;
use App\Authorized;
use Illuminate\Http\Request;
use Excel;
use DB;
use PHPExcel_IOFactory;
use PHPExcel_Settings;

class UsersController2 extends Controller
{
    use ExportTrait;
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('checkToken');
        $this->middleware('checkUser');
    }

    public function index(Request $request , $page)
    {
        //$page = $request->page;
        if (view()->exists('pages.'.$page)) {
            $view = 'pages.'.$page;
        } else {
            $view = 'home';
        }
//        return view('file_import_export');
        return view($view);
    }

}
