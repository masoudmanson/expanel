<?php
/**
 * Created by PhpStorm.
 * User: pooria
 * Date: 8/5/17
 * Time: 4:10 PM
 */

namespace App\Traits;
use Excel;

trait ExportTrait
{
    public function excel_export($data,$inputsArray,$file_name,$creator,$company,$description='')
    {
        foreach ($data as $row) {
            $inputsArray[] = $row->toArray();
        }

        // Generate and return the spreadsheet
        $excel = Excel::create($file_name, function($excel) use ($inputsArray,$file_name,$creator,$company,$description) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle($file_name);
            $excel->setCreator($creator)->setCompany($company);
            $excel->setDescription($description);

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($inputsArray) {
                $sheet->fromArray($inputsArray, null, 'A1', false, false);
            });

        })->download('xls');
        //->download('pdf');
    }

}