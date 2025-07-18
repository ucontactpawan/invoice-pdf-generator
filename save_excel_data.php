<?php  

if(isset($_POST['sheets_data'])) {
    $allSheets = json_decode($_POST['sheets_data'], true);
    
    $formattedData = [];
    

    $firstSheet = reset($allSheets);
    $rowCount = count($firstSheet) - 1; 

    for($i = 0; $i < $rowCount; $i++) {
        $record = [];
        
      
        foreach($allSheets as $sheetName => $sheetData) {
            $headers = array_shift($sheetData);
           
            foreach($headers as $colIndex => $header) {
                $value = $sheetData[$i][$colIndex] ?? '';            
                $key = strtolower(str_replace(' ', '_', $header));
                $record[$key] = $value;
            }
        }
        
        $formattedData[] = $record;
    }

    $dataFile = 'data.json';
    if(file_exists($dataFile)) {
        $existingData = json_decode(file_get_contents($dataFile), true);
    } else {
        $existingData = [];
    }

    $finalData = array_merge($existingData, $formattedData);
    file_put_contents($dataFile, json_encode($finalData, JSON_PRETTY_PRINT));
    
    header('Location: index.php?success=1');
    exit;
} else{
    header('Location: index.php?error=1');
    exit;
}