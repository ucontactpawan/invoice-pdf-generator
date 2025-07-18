<?php

require 'Spreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel Data Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">';

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

    $uploadedFile = $_FILES['file'];
    $tmpName = $uploadedFile['tmp_name'];
    $fileName = $uploadedFile['name'];

    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($fileExtension !== 'xlsx' && $fileExtension !== 'csv') {
        
        $html .= '<div class="alert alert-danger">Error: Please upload a valid .xlsx or .csv file.</div>';
        $html .= '<a href="index.php" class="btn btn-secondary">Back to Form</a>';

    } else {

        $spreadsheet = IOFactory::load($tmpName);
  
        $allSheets = [];
        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $sheetName = $worksheet->getTitle();
            $allSheets[$sheetName] = $worksheet->toArray();
        }
        
        foreach ($allSheets as $sheetName => $sheetData) {
            $html .= '<h2>' . htmlspecialchars($sheetName) . '</h2>';
            $html .= '<div class="table-responsive mb-4">';
            $html .= '<table class="table table-bordered table-striped">';
    
            if (!empty($sheetData)) {
                $html .= '<thead class="table-dark"><tr>';
                foreach ($sheetData[0] as $headerCell) {
                    $html .= '<th>' . htmlspecialchars($headerCell) . '</th>';
                }
                $html .= '</tr></thead>';
                $html .= '<tbody>';
                for ($i = 1; $i < count($sheetData); $i++) {
                    $html .= '<tr>';
                    foreach ($sheetData[$i] as $cell) {
                        $html .= '<td>' . htmlspecialchars($cell) . '</td>';
                    }
                    $html .= '</tr>';
                }
                $html .= '</tbody>';
            }
            
            $html .= '</table></div>';
        }

        $html .= '<div class="mt-3">';

        $html .= '<form action="save_excel_data.php" method="post" class="d-inline">';
        $html .= '<input type="hidden" name="sheets_data" value="' . htmlspecialchars(json_encode($allSheets)) . '">';
        $html .= '<button type="submit" class="btn btn-success me-2">Save Data</button>';
        $html .= '</form>';
        //button
        $html .= '<form action="Spreadsheet/createexcel.php" method="post" class="d-inline">';
        $html .= '<button type="submit" class="btn btn-success me-2">Download Excel</button>';
        $html .= '</form>';
        // Back to Form button
        $html .= '<a href="index.php" class="btn btn-secondary">Back to Form</a>';
        $html .= '</div>';
    }

} else {
    $html .= '<div class="alert alert-danger">No file was uploaded or an error occurred.</div>';
    $html .= '<a href="index.php" class="btn btn-secondary">Back to Form</a>';
}

$html .= '</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>';

// Finally, print the entire HTML page
echo $html;
?>
