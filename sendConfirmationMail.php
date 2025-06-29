<?php
// Start the session
session_start();



require 'PHPMailer.php';
require 'SMTP.php';
?>
<head>
<style>
    button{
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;"
    }
.alert {
  padding: 20px;
  background-color: Green;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
</head>
<?php
// Check if order ID is set in the session
if (isset($_SESSION['order_id'])) {
    // Get the order ID from the session
    $order_id = $_SESSION['order_id'];

    // Establish connection to the database
    $conn = mysqli_connect("localhost", "root", "", "Paperic");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Call the sendEmail function
    sendEmail($order_id, $conn);

    // Close the connection
    mysqli_close($conn);
} else {
    echo "Order ID not set in session.";
}
// Function to calculate total amount
function calculateTotalAmount($order_id, $conn) {
    // Define your logic to calculate the total amount here
    // For example, you can fetch the total amount from the orders table
    $totalAmountQuery = "SELECT total_amount FROM orders WHERE order_id = $order_id";
    $totalAmountResult = mysqli_query($conn, $totalAmountQuery);
    if ($totalAmountResult && mysqli_num_rows($totalAmountResult) > 0) {
        $totalAmountRow = mysqli_fetch_assoc($totalAmountResult);
        return $totalAmountRow['total_amount'];
    } else {
        return 0; // Default total amount if not found
    }
}
// Function to get payment method
function getPaymentMethod($order_id, $conn) {
    // Define your logic to retrieve the payment method here
    // For example, you can fetch the payment method from the orders table
    $paymentMethodQuery = "SELECT payment_method FROM orders WHERE order_id = $order_id";
    $paymentMethodResult = mysqli_query($conn, $paymentMethodQuery);
    if ($paymentMethodResult && mysqli_num_rows($paymentMethodResult) > 0) {
        $paymentMethodRow = mysqli_fetch_assoc($paymentMethodResult);
        return $paymentMethodRow['payment_method'];
    } else {
        return 'Unknown'; // Default payment method if not found
    }
}

// Function to send email
function sendEmail($order_id, $conn)
{
    // Fetch order details from the orders table
    $orderQuery = "SELECT o.deliver_to, o.delivery_address, o.d_email
                   FROM orders o
                   WHERE o.order_id = $order_id";

    $orderResult = mysqli_query($conn, $orderQuery);

    if ($orderResult && mysqli_num_rows($orderResult) > 0) {
        $orderRow = mysqli_fetch_assoc($orderResult);

        $deliver_to = $orderRow['deliver_to'];
        $delivery_address = $orderRow['delivery_address'];
        $d_email = $orderRow['d_email'];

        // Fetch cart details from the cart table
        $cartQuery = "SELECT c.p_id, c.quantity, p.product_name
                      FROM cart c
                      JOIN product p ON c.p_id = p.p_id
                      WHERE c.order_id = $order_id";

        $cartResult = mysqli_query($conn, $cartQuery);

        $cartData = [];
        if ($cartResult && mysqli_num_rows($cartResult) > 0) {
            while ($cartRow = mysqli_fetch_assoc($cartResult)) {
                $p_id = $cartRow['p_id'];
                $product_name = $cartRow['product_name'];
                $quantity = $cartRow['quantity'];
                $cartData[] = ['p_id' => $p_id, 'product_name' => $product_name, 'quantity' => $quantity];
            }
        }

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "neerajahari02@gmail.com";
            $mail->Password = "rsdh hwlb kwbv kqio";
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('neerajahari02@gmail.com', 'THANK YOU MAIL');
            $mail->addReplyTo('neerajahari02@gmail.com', 'THANK YOU MAIL');
            $mail->isHTML(true);
            $mail->Subject = 'Purchase details';
            $mail->Body = "
                <p>Dear Customer,</p>
                <p>Thank you for purchasing with us! Your Order (Order ID: $order_id) containing the following items:</p>
                <p>Cart Data: " . json_encode($cartData) . "</p>
                <p> The orders will reach $deliver_to within 7 days.</p>
                <p>Delivery Address: $delivery_address</p>
                <p>Total Amount: " . calculateTotalAmount($order_id, $conn) . "</p>
                <p>Payment Method: " . getPaymentMethod($order_id, $conn) . "</p>
                <p>THANK YOU</p>
                <p>HAVE A NICE DAY</p>
            ";

            $mail->addAddress($d_email);

            // Send email
            if ($mail->send()) {
                // echo 'Email sent successfully';
            } else {
                echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No order found with ID: $order_id";
    }
}
?>
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Email sent successfully!!</strong>
</div>
<br>
<button onclick="window.location.href = 'cnavbar.php';">Go to cnavbar.php</button>

    
   