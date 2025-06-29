<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Paperic";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $cartId = $_POST['cartId'];

    // Validate and sanitize cart ID
    if (!filter_var($cartId, FILTER_VALIDATE_INT) === false) {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to delete item from cart
        $stmt = $conn->prepare("DELETE FROM Cart WHERE cart_id = ?");
        $stmt->bind_param("i", $cartId);

        // Execute SQL statement
        if ($stmt->execute() === TRUE) {
            // Item deleted successfully
            header("Location: customercart.php"); // Redirect to cart page after deleting item
            exit();
        } else {
            // Failed to delete item
            echo "Failed to delete item.";
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        // Invalid cart ID
        echo "Invalid cart ID.";
    }
} else {
    // Invalid request method or delete button not clicked
    echo "Invalid request method.";
}
?>
