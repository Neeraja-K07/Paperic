<?php
// session_start();
// // Establish database connection
// $conn = mysqli_connect("localhost", "root", "", "Paperic");

// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// // Dump $_POST array for debugging
// // var_dump($_POST);

// // Check if the form data is received
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rating-9']) && isset($_POST['review-9']) && isset($_POST['product_id']) && isset($_POST['customer_id'])) {
//     // Retrieve form data
//     $rating = $_POST['rating-9'];
//     $review = $_POST['review-9'];
//     $productID = $_POST['product_id'];
//     $customerID = $_POST['customer_id'];

//     // Insert into Product_Review table
//     $insertQuery = "INSERT INTO Product_Review (p_id, c_id, ratings, reviews) VALUES (?, ?, ?, ?)";
//     $stmt = $conn->prepare($insertQuery);
//     $stmt->bind_param("iiis", $productID, $customerID, $rating, $review);
//     if ($stmt->execute()) {
//         echo "<script>alert('Review submitted successfully!'); window.location.href = 'MyOrdersCustomer.php';</script>";

//     } else {
//         echo "Error: " . $conn->error;
//     }
// } else {
//     echo "Form data not received.";
// }

// // Close the connection
// $conn->close();



session_start();
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "Paperic");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rating']) && isset($_POST['review']) && isset($_POST['product_id']) && isset($_POST['customer_id'])) {
    // Retrieve form data
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $productID = $_POST['product_id'];
    $customerID = $_POST['customer_id'];

    // Insert into Product_Review table
    $insertQuery = "INSERT INTO Product_Review (p_id, c_id, ratings, reviews) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("iiis", $productID, $customerID, $rating, $review);
    if ($stmt->execute()) {
        echo "<script>alert('Review submitted successfully!'); window.location.href = 'MyOrdersCustomer.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Form data not received.";
}

// Close the connection
$conn->close();
?>

?>
