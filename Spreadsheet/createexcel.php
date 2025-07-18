<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// user data
$users = [
    ['John Doe', 'john.doe@example.com', '+91-9876543210', '123 Main Street, Mumbai, India'],
    ['Jane Smith', 'jane.smith@example.com', '+91-9123456780', '456 Park Avenue, Delhi, India'],
    ['Amit Kumar', 'amit.kumar@example.com', '+91-9988776655', '789 Lake Road, Kolkata, India'],
    ['Priya Singh', 'priya.singh@example.com', '+91-8877665544', '321 Hilltop, Pune, India'],
    ['Rahul Sharma', 'rahul.sharma@example.com', '+91-7766554433', '654 River Lane, Chennai, India'],
    ['Sneha Patel', 'sneha.patel@example.com', '+91-6655443322', '987 Ocean Drive, Goa, India'],
    ['Vikram Joshi', 'vikram.joshi@example.com', '+91-5544332211', '159 Green Street, Ahmedabad, India'],
    ['Anjali Mehra', 'anjali.mehra@example.com', '+91-4433221100', '753 Blue Valley, Jaipur, India'],
    ['Suresh Reddy', 'suresh.reddy@example.com', '+91-3322110099', '852 Red Fort, Hyderabad, India'],
    ['Meena Nair', 'meena.nair@example.com', '+91-2211009988', '951 Lotus Lane, Kochi, India'],
];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set headers
$sheet->setCellValue('A1', 'Full Name');
$sheet->setCellValue('B1', 'Email');
$sheet->setCellValue('C1', 'Phone');
$sheet->setCellValue('D1', 'Address');

// Fill user data
$row = 2;
foreach ($users as $user) {
    $sheet->setCellValue('A' . $row, $user[0]);
    $sheet->setCellValue('B' . $row, $user[1]);
    $sheet->setCellValue('C' . $row, $user[2]);
    $sheet->setCellValue('D' . $row, $user[3]);
    $row++;
}

// Output to browser as Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="user_data.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>