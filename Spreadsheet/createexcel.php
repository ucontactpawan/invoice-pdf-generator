<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$dataFile = '../data.json';

if (file_exists($dataFile)) {
    $users = json_decode(file_get_contents($dataFile), true);
} else {
    $users = [];
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->setCellValue('A1', 'Full Name');
$sheet->setCellValue('B1', 'Email');
$sheet->setCellValue('C1', 'Phone');
$sheet->setCellValue('D1', 'Address');


$row = 2;
if ($users) { 
    foreach ($users as $user) {
        $sheet->setCellValue('A' . $row, $user['fullname'] ?? '');
        $sheet->setCellValue('B' . $row, $user['email'] ?? '');
        $sheet->setCellValue('C' . $row, $user['phone'] ?? '');
        $sheet->setCellValue('D' . $row, $user['address'] ?? '');
        $row++;
    }
}


// Output to browser as Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="user_data.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>