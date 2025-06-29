<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Paperic";

// Check if customer_id is set in the session
if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['customer_id'])) {
    // Customer ID is set, proceed with adding item to cart
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate product ID
        $productId = $_POST['productId']; // Product ID from form

        // Validate and sanitize product ID
        if (!filter_var($productId, FILTER_VALIDATE_INT) === false) {
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve customer ID from session
            $customerId = $_SESSION['customer_id'];

            // Prepare SQL statement to insert item into cart
            $stmt = $conn->prepare("INSERT INTO Cart (p_id, c_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $productId, $customerId);

            // Execute SQL statement
            if ($stmt->execute() === TRUE) {
                // Item added to cart successfully
                header("Location: cnavbar.php"); 
               
                exit();
            } else {
                // Failed to add item to cart
                echo "Failed to add item to cart.";
            }

            // Close statement and database connection
            $stmt->close();
            $conn->close();
        } else {
            // Invalid product ID
            echo "Invalid product ID.";
        }
    } else {
        // Invalid request method
        echo "Invalid request method.";
    }
} else {
    // Customer ID is not set in session
    echo "Customer ID not set.";
}
?>
