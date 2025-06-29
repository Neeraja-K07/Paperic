<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Paperic";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $cartId = $_POST['cartId'];
    $newQuantity = $_POST['newQuantity']; // Assuming you have a form field named "newQuantity"

    // Validate and sanitize cart ID and new quantity
    if (!filter_var($cartId, FILTER_VALIDATE_INT) === false && !filter_var($newQuantity, FILTER_VALIDATE_INT) === false) {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to update quantity in cart
        $stmt = $conn->prepare("UPDATE Cart SET quantity = ? WHERE cart_id = ?");
        $stmt->bind_param("ii", $newQuantity, $cartId);

        // Execute SQL statement
        if ($stmt->execute() === TRUE) {
            // Quantity updated successfully
            header("Location: customercart.php"); // Redirect to cart page after updating quantity
            exit();
        } else {
            // Failed to update quantity
            echo "Failed to update quantity.";
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        // Invalid cart ID or new quantity
        echo "Invalid cart ID or quantity.";
    }
} else {
    // Invalid request method or update button not clicked
    echo "Invalid request method.";
}
?>
