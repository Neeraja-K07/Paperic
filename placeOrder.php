<?php
// Start the session
session_start();

// Check if customer_id is set in the session
if (!isset($_SESSION['customer_id'])) {
    // Customer ID is not set, redirect to login page or display appropriate message
    header("Location: loginsignup.php"); // Replace "login.php" with your login page URL
    exit();
}

// Check if cart_items is set in the session
if (!isset($_SESSION['cart_items'])) {
    // Cart items are not set, redirect to cart page or display appropriate message
    header("Location: cart.php"); // Replace "cart.php" with your cart page URL
    exit();
}

// Establish connection to the database
$conn = mysqli_connect("localhost", "root", "", "Paperic");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize total amount
$totalAmount = 0;

?>
<!DOCTYPE html>
<html>
    <head>
        <!-- <link rel="stylesheet" href="cnavbar.css"> -->
        <title>Customer Home page</title>
    </head>
    <body>
        <style>
            form {
            max-width: 400px;
            margin: 0 auto;
            text-align: left; /* Align the form to the left */
            padding-left: 20px; /* Add padding to align form elements */
        }


        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            appearance: none; /* Remove default styles for select arrow */
            background-color: #f9f9f9; /* Background color */
        }

        select:hover {
            border-color: #aaa; /* Change border color on hover */
        }

        option {
            padding: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
            /* form {
    margin-top: 20px;
    text-align: center;
} */

input[type="text"],

input[type="email"] {
    width: 75%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}
            .order-form {
    margin-top: 20px;
    text-align: center;
}

.order-form input[type="text"],
.order-form input[type="tel"],
.order-form input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.order-form button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.order-form button:hover {
    background-color: #45a049;
}

            .order-now-button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.order-now-button:hover {
    background-color: #45a049;
}

            nav a{
    height: 100%;
    padding: 0 30px;
    text-decoration: none;
    display: flex;
    align-items: center;
    color: white;
}
nav a:hover {
    background-color: #f0f0f0; /* Change background color on hover */
    text-decoration: underline; /* Add underline effect on hover */
    color:black;
}

         nav{
    
    background-color: #4488ef;
    box-shadow: px 3px 5px rgba(0,0,0,0.1);
    text-align: center; 
    height: 80px;
    
    
}
.image-container {
            width: 300px; /* Fixed width for all product cards */
            height: auto; /* Allow height to adjust based on content */
            margin-bottom: 20px; /* Adjust spacing between product cards */
            padding: 10px; /* Add padding to the container */
            box-sizing: border-box; /* Include padding in the total width/height */
            border: 1px solid #ccc; /* Add a border for better visual separation */
            display: inline-block; /* Ensure product cards are displayed in a row */
            vertical-align: top; /* Align product cards to the top */
            text-align: center; /* Center align content */
        }

        .image-container img {
            width: 100%; /* Make image fill the container */
            height: auto; /* Ensure image maintains aspect ratio */
            object-fit: cover; /* This property ensures that the entire image is visible within the fixed dimensions */
        }

        .image-container h3 {
            margin-top: 10px; /* Adjust spacing between image and text */
            font-size: 16px; /* Adjust font size as needed */
        }

        .image-container p {
            font-size: 14px; /* Adjust font size for description */
            margin-top: 5px; /* Adjust spacing between elements */
        }
        *{
    margin: 0;
    padding: 0;
}
body{
    min-height: 100vh;
   
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

nav{
    
    background-color: #4488ef;
    box-shadow: px 3px 5px rgba(0,0,0,0.1);
    text-align: center; 
    height: 80px;
    
    
}
nav ul{
    width: 100%;
    height: 90%;
    list-style: none;
    display: flex;
    justify-content: flex-end;
    align-items: center;
   
}
nav li{
    height: 50px;
}
nav a{
    height: 100%;
    padding: 0 30px;
    text-decoration: none;
    display: flex;
    align-items: center;
    color: white;
}
nav a:hover{
    background-color: #f0f0f0;
}
nav li:first-child{
    margin-right: auto;
}
.sidebar{
    position: fixed;
    top: 0;
    right: 0;
    height: 100vh;
    width: 250px;
    z-index: 999;
    background-color: rgb(226, 229, 237);
    backdrop-filter: blur(10px);
    box-shadow: -10px 0 10px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
}
.sidebar li{
    width: 100%;
}
.sidebar a{
    width: 100%;
}
.menu-button{
    display: none;
}
@media(max-width:800px){
    .hideOnMobile{
        display: none;
    }
    .menu-button{
        display: block ;
    }
} 
@media(max-width:400px){
    .sidebar{
        width: 100%;
    }
}

/* .product-card {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
    width: 200px; 
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
} */

.product-card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.product-card img {
    width: 100%;
    height: auto;
}

.product-details {
    text-align: center;
}

.product-details h3 {
    margin-top: 0;
}

.product-actions {
    margin-top: 10px;
    text-align: center;
}

.product-actions form {
    display: inline-block;
}
.cart-form {
  margin-bottom: 10px;
}

.quantity-input {
  width: 50px;
  padding: 5px;
}

.update-button, .delete-button {
  background-color: #4CAF50;
  color: white;
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.delete-button {
  background-color: #f44336;
}

/* Change button color on hover */
.update-button:hover, .delete-button:hover {
  background-color: #45a049;
}
/* .product-container {
    display: flex;
    flex-wrap: wrap; 
    justify-content: space-between;
    gap: 20px; 
}

.product-card {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: calc(33.33% - 20px); 
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
    box-sizing: border-box;
}


@media screen and (max-width: 768px) {
    .product-card {
        width: calc(50% - 20px);
    }
}


@media screen and (max-width: 480px) {
    .product-card {
        width: 100%; 
    }
} */
.product-container {
    display: flex;
    flex-wrap: wrap; /* Allow items to wrap to the next row */
    /* justify-content: space-between;  */
    gap: 10px; /* Adjust the gap between items */
}

.product-card {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: calc(33.33% - 20px); /* Calculate width to fit three items per row with gap */
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
    box-sizing: border-box; /* Ensure padding and border are included in the width calculation */
}

/* Adjust width for smaller screens */
@media screen and (max-width: 768px) {
    .product-card {
        width: calc(50% - 20px); /* Calculate width to fit two items per row with gap */
    }
}

/* Adjust width for even smaller screens */
@media screen and (max-width: 480px) {
    .product-card {
        width: 100%; /* Display one item per row on smaller screens */
    }
}
   /* Table styles */
   table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #4CAF50; /* Different color for table headers */
            color: white;
            font-weight: bold;
            text-align: left;
            padding: 8px;
        }

        td, th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* Hover effect for table rows */
        tr:hover {
            background-color: #f5f5f5;
        }

        /* Hover effect for table columns */
        td:hover {
            background-color: #e5e5e5;
        }

        /* Strong style for total row */
        tr.total-row td {
            font-weight: bold;
        }
h2{
    text-align:center;
}
.confirmation-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
}

.confirmation-dialog {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 30px; /* Increased padding */
    border-radius: 10px; /* Increased border radius */
    border: 2px solid #ccc; /* Added border */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.confirmation-message {
    margin-bottom: 20px; /* Increased margin */
    font-size: 18px; /* Increased font size */
}

.confirmation-buttons {
    text-align: center;
}

.confirmation-buttons button {
    margin: 0 10px; /* Increased margin */
    padding: 8px 20px; /* Increased padding */
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.confirmation-buttons button#confirm-yes {
    background-color: #4CAF50;
    color: #fff;
}

.confirmation-buttons button#confirm-no {
    background-color: #f44336;
    color: #fff;
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
        <script>
            function showSidebar(){
                const sidebar=document.querySelector('.sidebar')
                sidebar.style.display='flex'
            }
            function hideSidebar(){
                const sidebar=document.querySelector('.sidebar')
                sidebar.style.display='none'
            }</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
   <br><h2>Order Summary</h2><br>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
       <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deliver_to = $_POST['deliver_to'];
    $delivery_address = $_POST['delivery_address'];
    $email = $_POST['email'];
    $_SESSION['deliver_to'] = $deliver_to;
    $_SESSION['delivery_address'] = $delivery_address;
    $_SESSION['email'] = $email;
}?>
        <?php foreach ($_SESSION['cart_items'] as $cartItem): ?>
            <?php
            // Get the cart ID and quantity from the cart item
            $cartID = $cartItem['cart_id'];
            $quantity = $cartItem['quantity'];

            // Retrieve the product details based on the cart ID
            $query = "SELECT product_name, amount FROM product INNER JOIN cart ON product.p_id = cart.p_id WHERE cart.cart_id = ?";
            $stmt = $conn->prepare($query);

            if (!$stmt) {
                die("Error in preparing SQL statement: " . $conn->error);
            }

            $stmt->bind_param("i", $cartID);
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetch the product details
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $productName = $row['product_name'];
                $price = $row['amount'];

                // Calculate subtotal for this item and add to total amount
                $subtotal = $price * $quantity;
                $totalAmount += $subtotal;
                $_SESSION['total_amount'] = $totalAmount

                // Display the item details in the table row
                ?>
                <tr>
                    <td><?php echo $productName; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td><?php echo $subtotal; ?></td>
                </tr>
                <?php
            }
            ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total Amount</strong></td>
            <td><strong><?php echo $totalAmount; ?></strong></td>
        </tr>
    </table>
    
   <br> <h2>Select Payment Method</h2><br>
    <!-- <form action="processOrder.php" method="post" onsubmit="return confirm('Do you want to confirm?')">
        <label for="paymentMethod">Payment Method:</label>
        <select name="paymentMethod" id="paymentMethod">
            <option value="COD">Cash on Delivery</option>
            <option value="UPI">UPI (Google Pay)</option>
        </select>
        <br><br>
        <button type="submit">Place Order</button>
    </form> -->
   
    <div id="confirmation-overlay" class="confirmation-overlay">
    <div class="confirmation-dialog">
        <p class="confirmation-message">Do you want to confirm?</p>
        <div class="confirmation-buttons">
            <button id="confirm-yes">Yes</button>
            <button id="confirm-no">No</button>
        </div>
    </div>
</div>

<form id="order-form" action="processOrder.php" method="post">
    <label for="paymentMethod">Payment Method:</label>
    <select name="paymentMethod" id="paymentMethod">
        <option value="COD">Cash on Delivery</option>
        <!-- <option value="UPI">UPI (Google Pay)</option> -->
        <!-- <option value="UPI">Card Payment</option> -->
    </select>
    <br><br>
    <button type="submit">Place Order</button>
</form>
</body>
</html>
<script>
function logout() {
    window.location.href = 'CustomerLogout.php';
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get the form and confirmation overlay
    const orderForm = document.getElementById('order-form');
    const confirmationOverlay = document.getElementById('confirmation-overlay');

    // Add event listener to the form submission
    orderForm.addEventListener('submit', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Show the confirmation overlay
        confirmationOverlay.style.display = 'block';
    });

    // Get the Yes and No buttons
    const confirmYes = document.getElementById('confirm-yes');
    const confirmNo = document.getElementById('confirm-no');

    // Add event listener to the Yes button
    confirmYes.addEventListener('click', function() {
        // Submit the form if Yes is clicked
        orderForm.submit();
    });

    // Add event listener to the No button
    confirmNo.addEventListener('click', function() {
        // Hide the confirmation overlay if No is clicked
        confirmationOverlay.style.display = 'none';
    });
});

</script>

<?php
// Close the database connection
mysqli_close($conn);
?>
