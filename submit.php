<?php
$fullname = $_POST['fullname'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$address = $_POST['message'] ?? '';

$dataFile = 'data.json';


// Load existing data
if (file_exists($dataFile)) {
    $existingData = json_decode(file_get_contents($dataFile), true);
} else {
    $existingData = [];
}


$existingData[] = [
    'fullname' => $fullname,
    'email' => $email,
    'phone' => $phone,
    'address' => $address,
];

file_put_contents($dataFile, json_encode($existingData));


header('Location: index.php');
exit;
?>