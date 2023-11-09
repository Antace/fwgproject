<?php

// Load the database configuration file
include_once '../condb.php';

// Include Phpspreadsheet library autoloader
require_once '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if(isset($_POST['importSubmit'])){
    // Allowed mime types
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    // Validate whether selected file is a Excel file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)){
        // if the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $reader = new Xlsx();
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet_arr = $worksheet->toArray();

            // Remove header row
            unset($worksheet_arr[0]);

            foreach($worksheet_arr as $row){
                $lh_place = $row[0];
                $lh_side = $row[1];
                $lh_fenceside = $row[2];
                $lh_length = $row[3];
                $lh_date = $row[4];
                $lh_fencetype  = $row[5];
                $lh_department = $row[6];
                $lh_amount = $row[7];
                $lh_phase = $row[8];
                $lh_unit = $row[9];
                $lh_price = $row[10];
                $lh_number = $row[11];
                $lh_insurance = $row[12];
                $status = $row[13];


                    // Insert member data in the database
                    $con->query("INSERT INTO tb_lh (lh_place, lh_side, lh_fenceside, lh_length, lh_date, lh_fencetype, lh_department, lh_amount, lh_phase, lh_unit, lh_price, lh_number, lh_insurance, status, created, modified) VALUES 
                    ('".$lh_place."','".$lh_side."','".$lh_fenceside."','".$lh_length."','".$lh_date."','".$lh_fencetype."','".$lh_department."','".$lh_amount."','".$lh_phase."','".$lh_unit."','".$lh_price."','".$lh_number."','".$lh_insurance."','".$status."',NOW(),NOW())");
                
            }

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: lh.php".$qstring);
?>