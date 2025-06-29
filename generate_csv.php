<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// // Check if the form data is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Check if csv_data is set and not empty
//     if (isset($_POST["csv_data"]) && !empty($_POST["csv_data"])) {
//         // Decode the JSON string into an array
//         $data = json_decode($_POST["csv_data"], true);

//         // Check if $data is an array
//         if (is_array($data)) {
//             // Now you can iterate over $data using foreach loop
//             foreach ($data as $row) {
//                 // Process each row as needed
//                 // For example, you can echo each row as CSV
//                 echo implode(',', $row) . "\n";
//             }
//         } else {
//             echo "Invalid data format!";
//         }
//     } else {
//         echo "No CSV data received!";
//     }
// } else {
//     echo "Invalid request method!";
// }

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if csv_data is set and not empty
    if (isset($_POST["csv_data"]) && !empty($_POST["csv_data"])) {
        // Decode the JSON data
        $data = json_decode($_POST["csv_data"], true);

        // Set headers to force download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=orders.csv');

        // Open a file handle to php://output with write access
        $output = fopen('php://output', 'w');

        // Write the CSV header
        fputcsv($output, array_keys($data[0]));

        // Write the CSV data
        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        // Close the file handle
        fclose($output);

        // Exit script to prevent further output
        exit;
    } else {
        // If csv_data is not set or empty, redirect to an error page or handle it accordingly
        header('Location: error.php');
        exit;
    }
} else {
    // If the form is not submitted via POST method, redirect to an error page or handle it accordingly
    header('Location: error.php');
    exit;
}
?>


