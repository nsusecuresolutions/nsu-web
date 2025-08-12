<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $fname   = $_POST['fname'] ?? '';
    $lname   = $_POST['lname'] ?? '';
    $phone   = $_POST['phone'] ?? '';
    $email   = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    // File path
    $filePath = 'contact.csv';

    // Check if file exists before opening
    $isNewFile = !file_exists($filePath);

    // Open file in append mode
    $file = fopen($filePath, 'a');

    if ($file) {
        // If file is new, write headers first
        if ($isNewFile) {
            fputcsv($file, ['First Name', 'Last Name', 'Phone', 'Email', 'Message', 'Date']);
        }

        // Prepare CSV line
        $data = [$fname, $lname, $phone, $email, $message, date('Y-m-d H:i:s')];
        fputcsv($file, $data);

        fclose($file);
        echo "Form data saved successfully.";
    } else {
        echo "Error: Unable to save data.";
    }
} else {
    echo "Invalid request.";
}
?>
