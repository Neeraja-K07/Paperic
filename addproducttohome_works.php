<?php
// Establish connection to your database
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "Paperic"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted and the "Add to Home" button is clicked
if(isset($_POST['action'])) {
    // Get the product ID from the form
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];

    // Check if the action is to add or remove from home
    if ($action == 'add_to_home') {
        $update_sql = "UPDATE Product SET added_to_home = 'Yes' WHERE p_id = $product_id";
        $message = 'Product added to home successfully!';
    } elseif ($action == 'remove_from_home') {
        $update_sql = "UPDATE Product SET added_to_home = 'No' WHERE p_id = $product_id";
        $message = 'Product removed from home successfully!';
    }

    // Execute the SQL query
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('$message');window.location.href = 'addproducttohome.php'</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
} else {
    // If action is not set, redirect to the main page
    header("Location: addproducttohome.php");
}

// Close connection
$conn->close();
?>
