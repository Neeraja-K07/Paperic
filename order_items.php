<!--customercart.php working-->
<?php
// Start the session
session_start();

// Check if customer_id is set in the session
if(isset($_SESSION['customer_id'])) {
    // Customer ID is set, proceed with your code
    // Establish connection to the database
    $conn = mysqli_connect("localhost", "root", "", "Paperic");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Rest of your PHP code here...
} else {
    // Customer ID is not set, redirect to login page or display appropriate message
    header("Location: login.php"); // Replace "login.php" with your login page URL
    exit();
}
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
    margin-top: 20px;
    text-align: center;
}

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
<html>
<head>
    <!-- <link rel="stylesheet" href="cnavbar.css"> -->
    <title>Customer Order page</title>
</head>
<body>
    <style>
        /* CSS styles here */
    </style>
    <!-- Navigation bar -->
    
    <br>
    <?php
// // Check if customer_id is set in the session
// if(isset($_SESSION['customer_id'])) {
//     // Customer ID is set, proceed with your code
//     // Establish connection to the database
//     $conn = mysqli_connect("localhost", "root", "", "Paperic");

//     // Check connection
//     if (!$conn) {
//         die("Connection failed: " . mysqli_connect_error());
//     }

//     // Fetch cart details for the current customer
//     $customerId = $_SESSION['customer_id'];
//     $query = "SELECT cart.cart_id, product.product_name, product.amount, product.image, product.min_qty, product.product_qty, cart.quantity 
//               FROM Cart 
//               INNER JOIN Product ON cart.p_id = product.p_id 
//               WHERE cart.c_id = $customerId";
//     $result = mysqli_query($conn, $query);

//     // Check if the query was executed successfully
//     if ($result) {
//         // Initialize an empty array to store cart items
//         $cartItems = array();

//         // Display cart items and buttons for each item
//         echo '<div class="product-container">'; // Open product container
//         while ($row = mysqli_fetch_assoc($result)) {
//             // Check if cart quantity is greater than or equal to the product's minimum quantity
//             if ($row['quantity'] <= $row['min_qty']) {
//                 // Add item details to the cart items array
//                 $cartItems[] = array(
//                     'cart_id' => $row['cart_id'],
//                     'quantity' => $row['quantity']
//                 );

//                 // Output cart item details within a product card
//                 echo '<div class="product-card">';
//                 $imagePath = 'images/' . $row['image'];
//                 echo '<img src="' . $imagePath . '" alt="' . $row['product_name'] . '">';
//                 echo '<div class="product-details">';
//                 echo '<h3>' . $row['product_name'] . '</h3>';
//                 echo '<p>Price: $' . $row['amount'] . '</p>';
//                 echo '<p>Quantity: ' . $row['quantity'] . '</p>';
//                 echo '</div>'; // Close product-details div
//                 echo '</div>'; // Close product-card div
//             }
//         }
//         echo '</div>'; // Close product container
       
//         // Check if any cart items were displayed
//         if (!empty($cartItems)) {
//             // Store cart items in session for carrying them to the next page
//             $_SESSION['cart_items'] = $cartItems;

//             // Display order form
//             echo '<div style="text-align: center; margin-top: 20px;">';
//             echo '<form action="placeOrder.php" method="post">';
//             echo '<input type="text" name="deliver_to" placeholder="Deliver To" pattern="[a-zA-Z\s]+" title="Please enter alphabetic characters only" required><br>';
//             echo '<input type="text" name="delivery_address" placeholder="Delivery Address" pattern="^[a-zA-Z\s]*$" title="Please enter alphabetic characters and spaces only" required><br>';        
//             echo '<input type="email" name="email" placeholder="Email" required><br>';
//             echo '<button type="submit" class="order-now-button">Place Order</button>';
//             echo '</form>';
//             echo '</div>';
//         } else {
//             // No cart items were displayed, display a message
//             echo "No items in your cart meet the minimum quantity requirement.";
//         }
//     } else {
//         // Query execution failed, handle the error
//         echo "Error executing query: " . mysqli_error($conn);
//     }

//     // Close the database connection
//     mysqli_close($conn);
// } else {
//     // Customer ID is not set, redirect to login page or display appropriate message
//     header("Location: loginsignup.php"); // Replace "login.php" with your login page URL
//     exit();
// }
?>
<?php
// Check if customer_id is set in the session
if(isset($_SESSION['customer_id'])) {
    // Customer ID is set, proceed with your code
    // Establish connection to the database
    $conn = mysqli_connect("localhost", "root", "", "Paperic");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch cart details for the current customer
    $customerId = $_SESSION['customer_id'];
    $query = "SELECT cart.cart_id, product.product_name, product.amount, product.image, product.min_qty, product.product_qty, cart.quantity 
              FROM Cart 
              INNER JOIN Product ON cart.p_id = product.p_id 
              WHERE cart.c_id = $customerId AND cart.order_id = -1";
    $result = mysqli_query($conn, $query);

    // Check if the query was executed successfully
    if ($result) {
        // Initialize an empty array to store cart items
        $cartItems = array();

        // Display cart items and buttons for each item
        echo '<div class="product-container">'; // Open product container
        while ($row = mysqli_fetch_assoc($result)) {
            // Check if cart quantity is less than product quantity
            if ($row['quantity'] < $row['product_qty']) {
                // Add item details to the cart items array
                $cartItems[] = array(
                    'cart_id' => $row['cart_id'],
                    'quantity' => $row['quantity']
                );
               
                // Output cart item details within a product card
                echo '<div class="product-card">';
                $imagePath = 'images/' . $row['image'];
                echo '<img src="' . $imagePath . '" alt="' . $row['product_name'] . '">';
                echo '<div class="product-details">';
                echo '<h3>' . $row['product_name'] . '</h3>';
                echo '<p>Price: $' . $row['amount'] . '</p>';
                echo '<p>Quantity: ' . $row['quantity'] . '</p>';
                echo '</div>'; // Close product-details div
                echo '</div>'; // Close product-card div
            }
        }
        echo '</div>'; // Close product container
       
        // Check if any cart items were displayed
        if (!empty($cartItems)) {
            // Store cart items in session for carrying them to the next page
            $_SESSION['cart_items'] = $cartItems;

            // Display order form
            // echo '<div style="text-align: center; margin-top: 20px;">';
            // echo '<form action="placeOrder.php" method="post">';
            // echo '<input type="text" name="deliver_to" placeholder="Deliver To" pattern="[a-zA-Z\s]+" title="Please enter alphabetic characters only" required><br>';
            // echo '<input type="text" name="delivery_address" placeholder="Delivery Address" pattern="^[a-zA-Z\s]*$" title="Please enter alphabetic characters and spaces only" required><br>';        
            // echo '<input type="email" name="email" placeholder="Email" required><br>';
            // echo '<button type="submit" class="order-now-button">Place Order</button>';
            // echo '</form>';
            // echo '</div>';
            echo'<div style="text-align: center; margin-top: 20px;">';
    echo'<form action="placeOrder.php" method="post" style="max-width: 500px; margin: 0 auto;">';
       echo' <input type="text" name="deliver_to" placeholder="Deliver To" pattern="[a-zA-Z\s]+" title="Please enter alphabetic characters only" required style="width: 100%; padding: 10px; margin-bottom: 10px;">';
        echo'<input type="text" name="delivery_address" placeholder="Delivery Address" pattern="^[a-zA-Z\s]*$" title="Please enter alphabetic characters and spaces only" required style="width: 100%; padding: 10px; margin-bottom: 10px;">';
        echo'<input type="email" name="email" placeholder="Email" required style="width: 100%; padding: 10px; margin-bottom: 10px;">';
        echo'<button type="submit" class="order-now-button" style="width: 100%; padding: 10px;">Place Order</button>';
    echo'</form>';
echo'</div>';

        } else {
            // No cart items were displayed, display a message
            echo "No items in your cart meet the quantity requirement.";
        }
    } else {
        // Query execution failed, handle the error
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Customer ID is not set, redirect to login page or display appropriate message
    header("Location: loginsignup.php"); // Replace "login.php" with your login page URL
    exit();
}
?>






</body>
</html>



<script>
function logout() {
    window.location.href = 'CustomerLogout.php';
}
</script>
        </body>
        </html>