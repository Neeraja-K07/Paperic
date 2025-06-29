<?php
// Start the session
session_start();

// Check if the form is submitted and the user confirmed
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paymentMethod'])) {
    // Establish connection to the database
    $conn = mysqli_connect("localhost", "root", "", "Paperic");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    
    
    // Get the customer ID from the session
    $customerID = $_SESSION['customer_id'];

    // Get the delivery details from the session
    $deliverTo = $_SESSION['deliver_to'];
    $deliveryAddress = $_SESSION['delivery_address'];
    $deliveryEmail = $_SESSION['email'];

    // Get the payment method from the form
    $paymentMethod = $_POST['paymentMethod'];
    // if ($paymentMethod === "Card") {
    //     // Redirect the user to another page
    //     header("Location: cardPaymentPage.php");
    //     exit(); // Stop further execution
    // }

    // Insert order details into the orders table
    $insertOrderQuery = "INSERT INTO orders (deliver_to, delivery_address, d_email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertOrderQuery);
    $stmt->bind_param("sss", $deliverTo, $deliveryAddress, $deliveryEmail);
    $stmt->execute();

    // Check if the order insertion was successful
    if ($stmt->affected_rows > 0) {
        // Get the newly inserted order ID
        $orderID = $stmt->insert_id;
        $_SESSION['order_id'] = $orderID;

        // Get the total amount from the session
        $totalAmount = $_SESSION['total_amount'];

        // Update the order ID in the cart table and adjust product quantity
        $cartItems = $_SESSION['cart_items'];
        foreach ($cartItems as $cartItem) {
            $cartID = $cartItem['cart_id'];
            $quantity = $cartItem['quantity'];

            // Get product ID from the cart
            $getProductIDQuery = "SELECT p_id FROM cart WHERE cart_id = ?";
            $stmt = $conn->prepare($getProductIDQuery);
            $stmt->bind_param("i", $cartID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $productID = $row['p_id'];

            // Update order ID in the cart table
            $updateCartQuery = "UPDATE cart SET order_id = ? WHERE cart_id = ?";
            $stmt = $conn->prepare($updateCartQuery);
            $stmt->bind_param("ii", $orderID, $cartID);
            $stmt->execute();

            // Deduct product quantity from the product table
            $updateProductQuery = "UPDATE product SET product_qty = product_qty - ? WHERE p_id = ?";
            $stmt = $conn->prepare($updateProductQuery);
            $stmt->bind_param("ii", $quantity, $productID);
            $stmt->execute();

            // Check for errors in SQL execution
            if ($stmt->error) {
                echo "Error updating product quantity: " . $stmt->error;
                // Rollback transaction if needed
                // Perform necessary error handling
            }
        }

        // Insert payment details into the payment table
        $insertPaymentQuery = "INSERT INTO payment (c_id, amount, method, order_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertPaymentQuery);
        $stmt->bind_param("idsi", $customerID, $totalAmount, $paymentMethod, $orderID);
        $stmt->execute();

        // Check if the payment insertion was successful
        if ($stmt->affected_rows > 0) {
            // Clear the cart session
            unset($_SESSION['cart_items']);
            unset($_SESSION['total_amount']);
            
             //attempting to send an email to the customer
             
             
            // Redirect to a confirmation page
            header("Location: alertconfirm.php");
            exit();
        } else {
            echo "Error inserting payment details: " . $stmt->error;
        }
    } else {
        echo "Error inserting order details: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    // Close the connection
    $conn->close();
} else {
    // User did not confirm the order or the payment method is not set
    // Redirect back to the payment page
    header("Location:cnavbar.php");
    exit();
}
?>
