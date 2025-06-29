<?php
session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="cnavbar.css">
        <title>Customer Home page</title>
    </head>
    <body>
        <style>
            /* Style for the rating buttons */
/* Style for the review text area */
/* --- Existing Styles (Retained) --- */
.review-section textarea {
    width: 100%;
    height: 100px;
    padding: 10px;
    margin-bottom: 10px;
    resize: vertical;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
}

/* Style for the rating buttons */
.rating-buttons button {
    background-color: #4488ef;
    color: white;
    border: none;
    padding: 10px 20px;
    margin-right: 5px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.rating-buttons button:hover {
    background-color: #3465a4;
}

/* Submit button in review section */
.review-section input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.review-section input[type="submit"]:hover {
    background-color: #45a049;
}

/* Go Back Button */
.goback-btn {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background-color: #4488ef;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}
.goback-btn:hover {
    background-color: #3465a4;
}

/* Navbar styling */
nav a {
    height: 100%;
    padding: 0 30px;
    text-decoration: none;
    display: flex;
    align-items: center;
    color: white;
}
nav a:hover {
    background-color: #f0f0f0;
    text-decoration: underline;
    color: black;
}
nav {
    background-color: #4488ef;
    box-shadow: 0 3px 5px rgba(0,0,0,0.1);
    text-align: center;
    height: 80px;
}

/* --- Updated Card Styles --- */
.order-container {
    width: 95%;
    margin: 30px auto;
    padding: 20px;
    border-radius: 15px;
    background: #f9f9f9;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}
.order-container:hover {
    transform: scale(1.01);
}

.product-container {
    margin-top: 15px;
    padding: 15px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    display: flex;
    align-items: flex-start;
    gap: 20px;
    transition: box-shadow 0.3s ease-in-out;
}
.product-container:hover {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
}
.product-container img {
    border-radius: 10px;
    width: 120px;
    height: auto;
    object-fit: cover;
    border: 1px solid #ddd;
}
.product-container h3 {
    margin-top: 0;
    font-size: 18px;
    color: #333;
}
.product-container p {
    margin: 6px 0;
    font-size: 14px;
    color: #555;
}
/* Review Form Container */
.review-section {
    margin-top: 20px;
    padding: 20px;
    background-color: #f0f8ff;
    border-left: 6px solid #4488ef;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

/* Review Textarea */
.review-section textarea {
    width: 100%;
    height: 100px;
    padding: 12px;
    margin-top: 10px;
    margin-bottom: 15px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    resize: vertical;
    background-color: #fff;
}

/* Rating Buttons */
.rating-buttons {
    display: flex;
    gap: 12px;
    margin-bottom: 15px;
}
.rating-buttons label {
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 5px;
}
.rating-buttons input[type="radio"] {
    accent-color: #4488ef;
}
/*.review-section {
    margin-top: 20px;
    padding: 15px;
    background-color: #f0f4ff;
    border-left: 5px solid #4488ef;
    border-radius: 10px;
}*/
.review-section p {
    margin: 5px 0;
    font-size: 15px;
    color: #333;
}
.review-section form {
    margin-top: 10px;
}
#reviewForm-[id] {
    padding-top: 15px;
}
.image-container {
    width: 300px;
    height: auto;
    margin-bottom: 20px;
    padding: 10px;
    box-sizing: border-box;
    border-radius: 10px;
    border: 1px solid #ccc;
    display: inline-block;
    vertical-align: top;
    text-align: center;
    background-color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}
.image-container img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
}
.image-container h3 {
    margin-top: 10px;
    font-size: 16px;
}
.image-container p {
    font-size: 14px;
    margin-top: 5px;
}

/* Red Review Button */
.review-button {
    background-color: #ff3333;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    border-radius: 12px;
}
.review-button:hover {
    background-color: #cc0000;
}

        </style>
   <nav>
            
            <ul class="sidebar">
                <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
                <li><a href="cnavbar.php">Home</a></li>
                <li><a href="MyOrdersCustomer.php">My Orders</a></li>
                <li><a href="customercart.php">Cart</a></li>
                <li><a href="customerprofile.php">Profile</a></li>
                <li><a href="#"onclick="logout()">Logout</a></li>
            </ul>
            <ul>
                
                <li>&nbsp;</li>
                <li class="hideOnMobile"><a href="cnavbar.php">Home</a></li>
                <li class="hideOnMobile"><a href="MyOrdersCustomer.php">My Orders</a></li>
                <li class="hideOnMobile"><a href="customercart.php">Cart</a></li>
                <li class="hideOnMobile"><a href="customerprofile.php">Profile</a></li>
                <li class="hideOnMobile"><a href="#"onclick="logout()">Logout</a></li>
                <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>

            </ul>
        </nav>
        <br>
        <br>
        <?php




// Check if customer ID is in the session
$conn = mysqli_connect("localhost", "root", "", "Paperic");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get customer ID from session
if (isset($_SESSION['customer_id'])) {
    $customerID = $_SESSION['customer_id'];

    // Step 2: Check if there are any orders in the cart
    $cartQuery = "SELECT cart.*, product.product_name, product.image, product.amount 
                  FROM cart 
                  INNER JOIN product ON cart.p_id = product.p_id
                  WHERE cart.c_id = ? AND cart.order_id != -1";
    $stmt = $conn->prepare($cartQuery);
    $stmt->bind_param("i", $customerID);
    $stmt->execute();
    $cartResult = $stmt->get_result();

    if ($cartResult->num_rows == 0) {
        echo "You have no orders. Please make your first order with us!";
    } else {
        // Step 3: Fetch cart details
        $orders = [];
        while ($cartRow = $cartResult->fetch_assoc()) {
            $orders[$cartRow['order_id']][] = $cartRow;
        }

        // Step 4: Fetch order details from the orders table
        $orderQuery = "SELECT * FROM orders WHERE order_id IN (" . implode(",", array_keys($orders)) . ") ORDER BY order_id DESC";
        $orderResult = $conn->query($orderQuery);
        $orderDetails = [];
        while ($orderRow = $orderResult->fetch_assoc()) {
            $orderDetails[$orderRow['order_id']] = $orderRow;
        }

        // Step 5: Fetch payment details from the payment table
        $paymentQuery = "SELECT * FROM payment WHERE order_id IN (" . implode(",", array_keys($orders)) . ")";
        $paymentResult = $conn->query($paymentQuery);
        $paymentDetails = [];
        while ($paymentRow = $paymentResult->fetch_assoc()) {
            $paymentDetails[$paymentRow['order_id']] = $paymentRow;
        }

        // Step 6: Display order details
        foreach ($orders as $orderID => $orderItems) {
            $order = $orderDetails[$orderID];
            $payment = $paymentDetails[$orderID];

            // Start order container
            echo "<div class='order-container'>";
            echo "<h2>Order ID: " . $orderID . "</h2>";
            echo "<p>Delivery To: " . $order['deliver_to'] . "</p>";
            echo "<p>Delivery Address: " . $order['delivery_address'] . "</p>";
            echo "<p>Email: " . $order['d_email'] . "</p>";
            echo "<p>Total Amount: " . $payment['amount'] . "</p>";
            echo "<p>Date: " . $payment['date'] . "</p>";
            echo "<p>Payment Method: " . $payment['method'] . "</p>";


            // Display order status as a colored button
$status = $order['status'];
$statusText = '';
$btnColor = '';

if ($status == -1) {
    $statusText = 'Pending';
    $btnColor = 'background-color: red;';
} elseif ($status == 0) {
    $statusText = 'Progressing';
    $btnColor = 'background-color: blue;';
} elseif ($status == 1) {
    $statusText = 'Delivered';
    $btnColor = 'background-color: green;';
}

echo "<button style='color: white; padding: 8px 16px; border: none; border-radius: 5px; margin-top: 10px; $btnColor'>$statusText</button>";


            // Display individual product details
            foreach ($orderItems as $item) {
                echo "<div class='product-container'>";
                echo "<h3>Product Name: " . $item['product_name'] . "</h3>";
                echo "<p>Quantity: " . $item['quantity'] . "</p>";
                echo "<p>Price: $" . $item['amount'] . "</p>";
                
                // Construct image path
                $imagePath = 'images/' . $item['image'];
                
                // Output image
                echo '<img src="' . $imagePath . '" alt="Product Image" style="width: 100px; height: auto;">';
                
                // Add more product details here if needed
                echo "</div>";
            }

         
            echo "<div class='review-section'>";
            // Check if reviews and ratings are submitted for this order
            $reviewQuery = "SELECT * FROM Reviews_Ratings WHERE order_id = ?";
            $stmt = $conn->prepare($reviewQuery);
            $stmt->bind_param("i", $orderID);
            $stmt->execute();
            $reviewResult = $stmt->get_result();

            if ($reviewResult->num_rows > 0) {
                // Reviews and ratings already submitted, display them
                while ($reviewRow = $reviewResult->fetch_assoc()) {
                    echo "<p>Review: " . $reviewRow['Review'] . "</p>";
                    echo "<p>Rating: " . $reviewRow['ratings'] . "</p>";
                }
            } else {
                // Reviews and ratings not submitted, show the textarea and radio button along with the submit button
                echo "<form method='POST'>";
                echo "<textarea name='review' placeholder='Enter your review'></textarea>";

                // Add radio buttons for ratings
                echo "<div class='rating-buttons'>";
                for ($i = 1; $i <= 5; $i++) {
                    echo "<label><input type='radio' name='rating' value='$i'>$i</label>";
                    echo'&nbsp&nbsp&nbsp&nbsp';
                }
                echo "</div>";

                // Hidden input for order ID
                echo "<input type='hidden' name='order_id' value='$orderID'>";

                // Submit button
                echo "<input type='submit' value='Submit Review & Rating'>";
                echo "</form>";
                echo'<br>';
                echo'<br>';
                
                    // Review section
echo "<div class='review-section'>";
echo "<button onclick='showReviewForm(" . $item['p_id'] . ")' class='review-button'>Product Review</button>";
echo "<div id='reviewForm-" . $item['p_id'] . "' style='display: none;'>";
echo "<form method='POST' action='handle_review_submission.php'>";
echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($item['p_id']) . "'>";
echo "<input type='hidden' name='customer_id' value='" . htmlspecialchars($_SESSION['customer_id']) . "'>";
echo "<h3>Product Name: " . $item['product_name'] . "</h3>";
echo "<div class='rating-section'>";
echo "<p>Rating: ";
for ($i = 1; $i <= 5; $i++) {
    echo "<label><input type='radio' name='rating' value='$i'>$i</label>";
}
echo "</p>";
echo "</div>"; // End rating section
echo "<div class='review-section'>";
echo "<textarea name='review' placeholder='Enter your review'></textarea>";
echo "</div>"; // End review section
echo "<div class='submit-section'>";
echo "<input type='submit' value='Submit Review & Rating' class='submit-button'>";
echo "</div>"; // End submit section
echo "</form>";
echo "</div>";
echo "</div>";


                echo "</div>"; // End review form
            }
            echo "</div>";

            // End order container
            echo "</div>";
        }
    }
} else {
    echo "Customer ID not found in session.";
}








// Handle review and rating submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['review']) && isset($_POST['rating']) && isset($_POST['order_id'])) {
        $review = $_POST['review'];
        $rating = $_POST['rating'];
        $orderID = $_POST['order_id'];

        // Insert into Reviews_Ratings table
        $insertQuery = "INSERT INTO Reviews_Ratings (c_id, order_id, Review, ratings) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iisi", $customerID, $orderID, $review, $rating);
        if ($stmt->execute()) {
            // echo "Review and rating submitted successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>

           
           <button class="goback-btn" onclick='goBack()'>Go Back</button>
           
           <script>
               // JavaScript function to handle button click
               function goBack() {
                   window.history.back();
               }
           </script>

<button class="goback-btn" onclick='goBack()'>Go Back</button>

        <script>
            function showSidebar(){
                const sidebar=document.querySelector('.sidebar')
                sidebar.style.display='flex'
            }
            function hideSidebar(){
                const sidebar=document.querySelector('.sidebar')
                sidebar.style.display='none'
            }
        </script>
            <script>
function logout() {
    window.location.href = 'CustomerLogout.php';
}
</script>
        <script>
    function goBack() {
        window.history.back();
    }
</script>
<script>
    // Function to handle button click
    function handleClick(value) {
        // Reset all buttons to default color
        var buttons = document.querySelectorAll('.rating-buttons button');
        buttons.forEach(function(button) {
            button.style.backgroundColor = '#4488ef';
        });

        // Set clicked button to different color
        var clickedButton = document.querySelector('button[value="' + value + '"]');
        clickedButton.style.backgroundColor = '#ffcc00'; // Change to your desired color
    }
</script>
<script>
        // JavaScript function to show review form
        function showReviewForm(productId) {
            var reviewForm = document.getElementById('reviewForm-' + productId);
            if (reviewForm.style.display === 'none') {
                reviewForm.style.display = 'block';
            } else {
                reviewForm.style.display = 'none';
            }
        }
    </script>
    </body>
</html>