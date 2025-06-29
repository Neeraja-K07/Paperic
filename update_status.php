<?php
// Establish connection to the database
$conn = mysqli_connect("localhost", "root", "", "Paperic");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and escape input
    $orderId = isset($_POST['orderId']) ? intval($_POST['orderId']) : 0;
    $statusText = isset($_POST['status']) ? $_POST['status'] : '';

    // Map text status to integer
    $statusMap = [
        'progressing' => 0,
        'pending' => -1,
        'delivered' => 1
    ];

    if (isset($statusMap[$statusText]) && $orderId > 0) {
        $status = $statusMap[$statusText];

        // Run update query
        $query = "UPDATE orders SET status = $status WHERE order_id = $orderId";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: admin.php");
            exit();
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid order ID or status.";
    }
}

mysqli_close($conn);
?>
