<?php

namespace App\Http\Controllers;

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
    public function index($request,$page)
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

    public function importFileIntoDB(Request $request)
    {
        if (Input::hasFile('sample_file')) {
            $path = Input::file('sample_file')->getRealPath();
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'firstname' => $value->firstname,
                        'lastname' => $value->lastname,
                        'identity_number' => $value->identity_number,
                        'mobile' => $value->mobile,
                        'identifier_id' => Auth::user()->currencyExchange->identifier->id,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ];
                }
                if (!empty($insert)) {
                    DB::table('authorized')->insert($insert);
                    dd('Insert Record successfully.');
                }
            }
        }
        return back();
    }

    public function downloadExcelFile($type)
    {
        $products = Authorized::get()->toArray();
        return Excel::create('My_Users', function ($excel) use ($products) {
            $excel->sheet('sheet name', function ($sheet) use ($products) {
                $sheet->fromArray($products);
            });
        })->download($type);
    }

    public function add_auth_user($request)
    {
        $request['identifier_id'] = Auth::user()->currencyExchange->identifier->id;

        Authorized::create($request->all());

        return redirect()->back();
    }
}
