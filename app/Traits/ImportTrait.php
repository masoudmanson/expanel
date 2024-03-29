<?php


namespace App\Traits;

use App\Authorized;
use Excel;
use Illuminate\Http\Request;

trait ImportTrait
{

    public function importFileIntoDB(Request $request)
    {
        if ($request->hasFile('sample_file')) {
            $path = $request->file('sample_file')->getRealPath();
            $data = \Excel::load($path)->get();
            if ($data->count()) {
                foreach ($data as $key => $value) {
                    $arr[] = ['name' => $value->name, 'details' => $value->details];
                }
                if (!empty($arr)) {
                    \DB::table('authorized')->insert($arr);
                    dd('Insert Record successfully.');
                }
            }
        }
        dd('Request data does not have any files to import.');
    }

    public function downloadExcelFile($type)
    {
        $products = Authorized::get()->toArray();
        return \Excel::create('expertphp_demo', function ($excel) use ($products) {
            $excel->sheet('sheet name', function ($sheet) use ($products) {
                $sheet->fromArray($products);
            });
        })->download($type);
    }
}