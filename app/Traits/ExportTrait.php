<?php
/**
 * Created by PhpStorm.
 * User: pooria
 * Date: 8/5/17
 * Time: 4:10 PM
 */

namespace App\Traits;


trait ExportTrait
{
    public function pdf_export($transactions,$paymentsArray,$file_name,$creator,$company,$description='')
    {
        foreach ($transactions as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        $excel = Excel::create('payments', function($excel) use ($paymentsArray,$file_name,$creator,$company,$description) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle($file_name);
            $excel->setCreator($creator)->setCompany($company);
            $excel->setDescription($description);

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xls');
        //->download('pdf');
    }

}