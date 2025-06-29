<?php
require 'vendor/autoload.php'; // Include PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
echo "Download script accessed!";
// Establish connection to the database
$conn = mysqli_connect("localhost", "root", "", "Paperic");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve all orders
$query = "SELECT o.order_id, o.deliver_to, o.delivery_address, o.d_email, p.amount, p.date, p.method, c.username, ca.p_id, ca.quantity, ord.status, pr.product_name, pr.amount AS product_amount
            FROM orders o
            JOIN payment p ON o.order_id = p.order_id
            JOIN customer c ON p.c_id = c.c_id
            JOIN cart ca ON o.order_id = ca.order_id
            JOIN product pr ON ca.p_id = pr.p_id
            LEFT JOIN orders ord ON o.order_id = ord.order_id
            ORDER BY p.date DESC";

// Debugging: Output the query to check its structure and correctness
echo "Query: $query <br>";

$result = mysqli_query($conn, $query);

// Debugging: Check if the query executed successfully
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

try {
    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Write table headers
    $headers = ['Order ID', 'Deliver To', 'Delivery Address', 'Email', 'Amount', 'Date', 'Payment Method', 'Customer', 'Product ID', 'Product Name', 'Product Amount', 'Quantity', 'Status'];
    $column = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($column . '1', $header);
        $column++;
    }

    // Debugging: Output the headers to verify they are correct
    echo "Headers: <pre>";
    print_r($headers);
    echo "</pre>";

    // Write table data
    $row = 2;
    while ($row_data = mysqli_fetch_assoc($result)) {
        // Debugging: Output the row data to check its structure
        echo "Row Data: <pre>";
        print_r($row_data);
        echo "</pre>";

        $column = 'A';
        foreach ($row_data as $value) {
            $sheet->setCellValue($column++ . $row, $value);
        }
        $row++;
    }

    // Specify the full path where you want to save the Excel file
    $filePath = 'C:\wamp64\www\18March\orders.xlsx';

    // Debugging: Output the file path to ensure it is correct
    echo "File Path: $filePath <br>";

    // Save Excel file with the specified path
    $writer = new Xlsx($spreadsheet);
    $writer->save($filePath);

    // Close connection
    mysqli_close($conn);

    echo 'File created successfully at: ' . $filePath;
    
} catch (Exception $e) {
    // Log the error to a file for debugging
    $errorLog = fopen('error.log', 'a');
    fwrite($errorLog, date('Y-m-d H:i:s') . ' - Error creating file: ' . $e->getMessage() . PHP_EOL);
    fclose($errorLog);

    // Output a generic error message to the user
    echo 'An error occurred. Please try again later.';
}
?>
