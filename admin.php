
<!--admin.php-->
<!--Order display texted-->
<!--      https://www.youtube.com/watch?v=5n-tiNha5kw     -->

<?php
// Start the session
session_start();

// Check if the customer_id is set in the session
if (!isset($_SESSION['customer_id'])) {
    // If customer_id is not set, redirect the user to the login page or handle it as needed
    header("Location: loginsignup.php"); // Replace "login.php" with the path to your login page
    exit(); // Make sure to exit after redirection
}
$conn = mysqli_connect("localhost", "root", "", "Paperic");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// If customer_id is set, you can retrieve it and use it further if needed
$customer_id = $_SESSION['customer_id'];
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin dashboard</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        
        <style>
            a {
    text-decoration: none; /* Remove underline */
    color: inherit; /* Inherit text color */
}

            .search-button {
    background-color: var(--blue);
    color: var(--white);
    border: none;
    border-radius: 20px;
    padding: 5px 15px;
    margin-left: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-button:hover {
    background-color: #007bff; /* Change color on hover */
}

            .search button[type="submit"],
        .show-all-button {
            background-color: var(--blue);
            color: var(--white);
            border: none;
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search button[type="submit"]:hover,
        .show-all-button:hover {
            background-color: #007bff; /* Change color on hover */
        }
        .search {
        position: center;
        display: flex;
        align-items: center;
        margin-left:200px;
    }

    .search input[type="text"] {
        width: 100%;
        height: 40px;
        border-radius: 40px;
        padding: 5px 20px;
        padding-left: 35px;
        font-size: 10px;
        outline: none;
        border: 1px solid var(--black);
    }

            
            .cardHeader {
    margin-bottom: 0px; /* Add margin-bottom to move it up */
}
@media (max-width: 768px) {
    .details {
        grid-template-columns: 1fr;
    }

    .recentOrders {
        overflow: auto;
        display: flex;
        align-items: flex-start; /* Align contents at the top */
    }

    .status.inProgress {
        white-space: nowrap;
    }
}
/* .details .recentOrders {
    margin-left: -10px; 
} */

.details table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 0px; /* Increase margin-top */
    margin-left: -62px; 
}

.details table thead td {
    font-weight: 600;
}

.details .recentOrders table {
    /* margin-left: -19px;  */
    width: 100%;
    color: var(--black1);
    border-collapse: collapse;
    margin-top: 2px; /* Add margin-top */
}

.details .recentOrders table tr {
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.details .recentOrders table tr:last-child {
    border-bottom: none;
}

.details .recentOrders table tbody tr:hover {
    background: var(--blue);
    color: var(--white);
}

.details .recentOrders table tr td {
    padding: 10px 20px; /* Increase the left and right padding */
    vertical-align: top; /* Align contents at the top */
}



.details .recentOrders table tr td:last-child {
    text-align: right;
}

.details .recentOrders table tr td:nth-child(2),
.details .recentOrders table tr td:nth-child(3) {
    text-align: center;
}
.details .recentOrders table tr td:nth-child(13) {
    padding: 10px 30px; /* Increase the left and right padding */
    vertical-align: top; /* Align contents at the top */
}
.details .recentOrders table tr td:nth-child(11) {
    padding: 10px 30px; /* Increase the left and right padding */
    vertical-align: top; /* Align contents at the top */
}
.details .recentOrders table tr td:nth-child(10) {
    padding: 10px 30px; /* Increase the left and right padding */
    vertical-align: top; /* Align contents at the top */
}
.details .recentOrders table tr td .update-button {
    background-color: green;
    color: white;
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}
/*Model styles*/
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  /* border: 1px solid #888; */
  width: 80%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.status-button {
  border: none;
  color: white;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
}

.purple {
  background-color: #4d0477;
  border: none;
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
}

.red {
  background-color: #f00;
  border: none;
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
}

.blue {
  background-color: #17a9ce;
  border: none;
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
}

.submit-button {
  background-color: green;
  color:white;
  border: none;
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
}

.submit-button:hover {
  background-color: darkgreen;
  border: none;
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
}
#deliveryAddress,
    #deliveryEmail,
    #productName {
        border-color: white;
    }
    .status.delivered{
    padding: 2px 4px;
    background: #8de02c;
    color: var(--white);
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
}
.status.pending{
    padding: 2px 4px;
    background: #f00;
    color: var(--white);
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
}
.status.return{
    padding: 2px 4px;
    background: #f00;
    color: var(--white);
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
}
.status.inProgress{
    padding: 2px 4px;
    background: #17a9ce;
    /* background: #4d0477; */
    color: var(--white);
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
}
/*darkmode*/

            </style>
        <!--    navigation -->
        <div class="container">
            <div class="navigation active">
                <ul>
                    <li>
                        <a href="#">
                            <span class="icon">
                                <ion-icon name="logo-apple"></ion-icon>
                            </span>
                            <span class="title">Paperic</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="customers.php">
                            <span class="icon">
                                <ion-icon name="people-outline"></ion-icon>
                            </span>
                            <span class="title">Customer</span>
                        </a>
                    </li>
                    <li>
                        <a href="productaddtrial.php">
                            <span class="icon">
                                <ion-icon name="bag-outline"></ion-icon>
                            </span>
                            <span class="title">Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="addproducttohome.php">
                            <span class="icon">
                                <ion-icon name="storefront-outline"></ion-icon>
                            </span>
                            <span class="title">Add Products to Home page</span>
                        </a>
                    </li>
                    <li>
                        <a href="myprofile.php">
                            <span class="icon">
                            <ion-icon name="person-circle-outline"></ion-icon>
                            </span>
                            <span class="title">Profile</span>
                        </a>
                    </li>
                    <li>
                    <li>
                        <a href="productrestock.php">
                            <span class="icon">
                            <ion-icon name="add-circle-outline"></ion-icon>
                            </span>
                            <span class="title">Product Restock</span>
                        </a>
                    </li>
                    </li>
                    <li>
    <a href="#" onclick="confirmSignOut()">
        <span class="icon">
            <ion-icon name="log-out-outline"></ion-icon>
        </span>
        <span class="title">Sign Out</span>
    </a>
</li>

                    
                </ul>
            </div>
            <!--  =====              main   ========                -->
            <div class="main active">
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>
                    <!-- <div class="search">
                        <label>
                            <input type="text" placeholder="Search here">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </div> -->
                    

  
                    <div class="user">
            <?php
            // Start session to access session variables
            session_start();

            // Establish connection to the database
            $conn = mysqli_connect("localhost", "root", "", "Paperic");

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Check if c_id is set in the session
            if (isset($_SESSION['customer_id'])) {
                $c_id = $_SESSION['customer_id'];

                // Retrieve user details including the profile image from the Customer table based on the c_id
                $retrieve_user_query = "SELECT * FROM Customer WHERE c_id = $c_id";
                $result = mysqli_query($conn, $retrieve_user_query);

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $profile_image = $row['profile_image'];
                    $image_source = $profile_image ? 'Profileimages/' . $profile_image : 'https://img.icons8.com/bubbles/100/000000/user.png'; // Adjust the path accordingly
                    echo '<img src="' . $image_source . '" class="img-radius" alt="User-Profile-Image">';
                } else {
                    echo '<div>User not found.</div>';
                }
            } else {
                echo '<div>User ID not set in session.</div>';
            }

            
            ?>
        </div>
                </div>
                <!--============cards=============-->
                <div class="cardBox">




                    <?php
// Assuming you have already established a connection to your MySQL database

// Execute the SQL query to get the total number of customers who did either a review or a product review
$query = "SELECT COUNT(DISTINCT c_id) AS total_customers
          FROM (
              SELECT c_id FROM product_review
              UNION
              SELECT c_id FROM Reviews_ratings
          ) AS combined_reviews";

$result = mysqli_query($conn, $query);

if ($result) {
    // Fetch the result row
    $row = mysqli_fetch_assoc($result);
    
    // Extract the total number of customers
    $total_customers = $row['total_customers'];
?>

<div class="card">
    
        <div>
        <a href="reviews_ratings.php"> <!-- Link to the PHP page -->
            <div class="numbers"><?php echo $total_customers; ?></div>
            <div class="cardName">Reviews And Ratings</div>
        </div>
        <div class="iconBx">
            <ion-icon name="chatbubbles-outline"></ion-icon>
        </div>
    </a>
</div>


<?php
    // Close the result set
    mysqli_free_result($result);
    
    // Close the database connection
    // mysqli_close($conn);
} else {
    // Handle the case where the query fails
    echo "Error executing query: " . mysqli_error($conn);
}
?>



<?php
// Assuming you have already established a connection to your MySQL database

// Execute the SQL query to get the total number of orders
$query = "SELECT COUNT(*) AS total_orders FROM orders";

$result = mysqli_query($conn, $query);

if ($result) {
    // Fetch the result row
    $row = mysqli_fetch_assoc($result);
    
    // Extract the total number of orders
    $total_orders = $row['total_orders'];
?>

                    <div class="card">
                    <div>
        <a href="total_orders.php"> <!-- Link to the PHP page -->
            <div class="numbers"><?php echo $total_orders; ?></div>
            <div class="cardName">Total Orders</div>
        </div>
                    <div class="iconBx">
                    <ion-icon name="card-outline"></ion-icon>
                       
                    </div>
</a>

                    <?php
    // Close the result set
    mysqli_free_result($result);
} else {
    // Handle the case where the query fails
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the database connection

?>


                </div>
                <?php
// Assuming you have already established a connection to your MySQL database

// Execute the SQL query to get the total number of carts that haven't been ordered
$query = "SELECT COUNT(*) AS total_unordered_carts FROM cart WHERE order_id = -1";

$result = mysqli_query($conn, $query);

if ($result) {
    // Fetch the result row
    $row = mysqli_fetch_assoc($result);
    
    // Extract the total number of unordered carts
    $total_unordered_carts = $row['total_unordered_carts'];
?>

<div class="card">
                    <div>
        <!-- <a href="unordered_carts.php"> Link to the PHP page -->
        <div class="numbers"><?php echo $total_unordered_carts; ?></div>
            <div class="cardName">Unordered Carts</div>
        </div>
        <div class="iconBx">
        <ion-icon name="cart-outline"></ion-icon>
    </div>
</a>
</div>
<!-- <div class="card">
    <div>
        <div class="numbers"><?php echo $total_unordered_carts; ?></div>
        <div class="cardName">Unordered Carts</div>
    </div>
    <div class="iconBx">
        <ion-icon name="cart-outline"></ion-icon>
    </div>
</div> -->

<?php
} else {
    // Handle the case where the query fails
    echo "Error executing query: " . mysqli_error($connection);
}
?>

<?php
// Assuming you have already established a connection to your MySQL database

// Execute the SQL query to get the total sale amount
$query = "SELECT SUM(amount) AS total_sale_amount FROM payment";

$result = mysqli_query($conn, $query);

if ($result) {
    // Fetch the result row
    $row = mysqli_fetch_assoc($result);
    
    // Extract the total sale amount
    $total_sale_amount = $row['total_sale_amount'];
?>

<div class="card">
    <div>
        <div class="numbers"><?php echo $total_sale_amount; ?></div>
        <div class="cardName">Sale Amount</div>
    </div>
    <div class="iconBx">
        <ion-icon name="cash-outline"></ion-icon>
    </div>
</div>

<?php
} else {
    // Handle the case where the query fails
    echo "Error executing query: " . mysqli_error($connection);
}
?>


            </div>
            
                <!-- Order details -->
                <form action="" method="GET">
    <div class="search-container">
        <div class="search">
            <label>
                <ion-icon name="search-outline"></ion-icon>
                <input type="text" name="search" placeholder="Search here">
            </label>
           
            <button type="submit">Search</button>
      
          


        </div>
    </div>
</form>
<!-- <?php echo htmlspecialchars(json_encode($data)); ?>"> -->
   

<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="show-all-button" onclick="showAllProducts()">Show All Orders</button>
<!-- Button to show delivery details -->
<button class="show-all-button" onclick="showDeliveryDetails()">Delivery Details</button>


<!-- Modal HTML -->
<div id="statusModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Update Order Status</h2>
    <form id="statusForm" method="post" action="update_status.php">
      <input type="hidden" id="orderId" name="orderId">
      <label for="deliveryAddress">Delivery Address:</label>
      <input type="text" id="deliveryAddress" name="deliveryAddress" readonly>
      <label for="deliveryEmail">Delivery Email:</label>
      <input type="text" id="deliveryEmail" name="deliveryEmail" readonly>
      <label for="productName">Product Name:</label>
      <input type="text" id="productName" name="productName" readonly>
      <div>
        <br>
        <button class="status-button purple" type="button" onclick="setStatus('delivered')">Delivered</button>
        <button class="status-button red" type="button" onclick="setStatus('pending')">Pending</button>
        <button class="status-button blue" type="button" onclick="setStatus('progressing')">Progressing</button>
      </div>
      <button class="submit-button green" type="submit" style="color:white">Submit</button>
    </form>
  </div>
</div>
<script>
   function updateStatus(orderId) {
  // Fetch order details from the row
  var row = document.getElementById('row_' + orderId);
  var deliveryAddress = row.cells[2].innerText;
  var deliveryEmail = row.cells[3].innerText;
  var productName = row.cells[9].innerText;

  // Set values in the modal form
  document.getElementById('orderId').value = orderId;
  document.getElementById('deliveryAddress').value = deliveryAddress;
  document.getElementById('deliveryEmail').value = deliveryEmail;
  document.getElementById('productName').value = productName;

  // Show the modal
  var modal = document.getElementById('statusModal');
  modal.style.display = 'block';
}

function closeModal() {
  // Close the modal
  var modal = document.getElementById('statusModal');
  modal.style.display = 'none';
}

function setStatus(status) {
  // Set the status in the form
  var statusInput = document.createElement('input');
  statusInput.setAttribute('type', 'hidden');
  statusInput.setAttribute('name', 'status');
  statusInput.setAttribute('value', status);
  document.getElementById('statusForm').appendChild(statusInput);
}
 
</script>
<div class="details">
    <div class="recentOrders" style="margin-top: 0px; margin-left: 60px;">
    <?php
// Establish connection to the database

// Check if search query is set
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Query to retrieve orders based on search query
    // $query = "SELECT o.order_id, o.deliver_to, o.delivery_address, o.d_email, p.amount, p.date, p.method, c.username, ca.p_id, ca.quantity, ord.status, pr.product_name, pr.amount AS product_amount
    //             FROM orders o
    //             JOIN payment p ON o.order_id = p.order_id
    //             JOIN customer c ON p.c_id = c.c_id
    //             JOIN cart ca ON o.order_id = ca.order_id
    //             JOIN product pr ON ca.p_id = pr.p_id
    //             LEFT JOIN orders ord ON o.order_id = ord.order_id
    //             WHERE o.order_id LIKE '%$search%' OR p.amount LIKE '%$search%' OR o.deliver_to LIKE '%$search%' OR pr.product_name LIKE '%$search%'
    //             ORDER BY p.date DESC";

    $query = "SELECT 
                o.order_id, o.deliver_to, o.delivery_address, o.d_email, 
                p.amount, p.date, p.method, c.username, ca.p_id, ca.quantity, 
                o.status, pr.product_name, pr.amount AS product_amount
              FROM orders o
              JOIN payment p ON o.order_id = p.order_id
              JOIN customer c ON p.c_id = c.c_id
              JOIN cart ca ON o.order_id = ca.order_id
              JOIN product pr ON ca.p_id = pr.p_id
              WHERE o.order_id LIKE '%$search%' 
                 OR p.amount LIKE '%$search%' 
                 OR o.deliver_to LIKE '%$search%' 
                 OR pr.product_name LIKE '%$search%'
              ORDER BY p.date DESC";


} else {
    // Query to retrieve all orders
    // $query = "SELECT o.order_id, o.deliver_to, o.delivery_address, o.d_email, p.amount, p.date, p.method, c.username, ca.p_id, ca.quantity, ord.status, pr.product_name, pr.amount AS product_amount
    //             FROM orders o
    //             JOIN payment p ON o.order_id = p.order_id
    //             JOIN customer c ON p.c_id = c.c_id
    //             JOIN cart ca ON o.order_id = ca.order_id
    //             JOIN product pr ON ca.p_id = pr.p_id
    //             LEFT JOIN orders ord ON o.order_id = ord.order_id
    //             ORDER BY p.date DESC";

    $query = "SELECT 
                o.order_id, o.deliver_to, o.delivery_address, o.d_email, 
                p.amount, p.date, p.method, c.username, ca.p_id, ca.quantity, 
                o.status, pr.product_name, pr.amount AS product_amount
              FROM orders o
              JOIN payment p ON o.order_id = p.order_id
              JOIN customer c ON p.c_id = c.c_id
              JOIN cart ca ON o.order_id = ca.order_id
              JOIN product pr ON ca.p_id = pr.p_id
              WHERE o.order_id IS NOT NULL
              ORDER BY p.date DESC";
    

}

$result = mysqli_query($conn, $query);

// Check if there are any orders
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Output the table
        $data = array(); 
        echo '<table id="order_table">';
        echo '<thead id="table_header"><tr><th>Order ID</th><th>Deliver To</th><th>Delivery Address</th><th>Email</th><th>Amount</th><th>Date</th><th>Payment Method</th><th>Customer</th><th>Product ID</th><th>Product Name</th><th>Product Amount</th><th>Quantity</th><th>Status</th><th>Action</th></tr></thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            // unset($row['status']);
            $data[] = $row;
            echo '<tr id="row_' . $row['order_id'] . '">'; // Unique ID for each row
            echo '<td>' . $row['order_id'] . '</td>';
            echo '<td>' . $row['deliver_to'] . '</td>';
            echo '<td>' . $row['delivery_address'] . '</td>';
            echo '<td>' . $row['d_email'] . '</td>';
            echo '<td>' . $row['amount'] . '</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['method'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['p_id'] . '</td>';
            echo '<td>' . $row['product_name'] . '</td>';
            echo '<td>' . $row['product_amount'] . '</td>';
            echo '<td>' . $row['quantity'] . '</td>';
            // Display status based on the value retrieved
            echo '<td>';
            if ($row['status'] == 0) {
                echo '<span class="status inProgress">Progressing</span>';
            } elseif ($row['status'] == -1) {
                echo '<span class="status pending">Pending</span>';
            } elseif ($row['status'] == 1) {
                echo '<span class="status delivered">Delivered</span>';
            } else {
                // Handle other status types if needed
            }
            echo '</td>';
            // Display button to update status
            echo '<td><button class="update-button" style="background-color:#4d0477" onclick="updateStatus(' . $row['order_id'] . ')">Update Status</button></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        
// Now, you can use the $data array to generate the CSV form
echo'<br>';
echo '<form id="csv_form" action="generate_csv.php" method="post">';
        echo '<input type="hidden" id="csv_data" name="csv_data" value="' . htmlspecialchars(json_encode($data)) . '">';
        echo '<button type="submit" name="download_csv" class="search-button">Download CSV</button>';
        echo '</form>';
        
        
    } else {
        echo '<p>No orders found.</p>';
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<script>
    function showDeliveryDetails() {
        // Get all table rows
        document.getElementById('table_header').style.display = 'none';

        var rows = document.querySelectorAll('#order_table tbody tr');

        // Loop through each row
        rows.forEach(function(row) {
            // Hide all columns initially
            var cells = row.cells;
            for (var i = 0; i < cells.length; i++) {
                cells[i].style.display = 'none';
            }
            // Show only the necessary columns
            row.cells[0].style.display = 'table-cell'; // 1st column
            row.cells[1].style.display = 'table-cell'; // 2nd column
            row.cells[2].style.display = 'table-cell'; // 3rd column
            row.cells[3].style.display = 'table-cell'; // 4th column
            row.cells[4].style.display = 'table-cell'; // 5th column
            row.cells[6].style.display = 'table-cell'; // 7th column
            row.cells[9].style.display = 'table-cell'; // 10th column
        });
    }
</script>
<!-- Download CSV button -->


   <script>
    function downloadCSV() {
        var table = document.getElementById('order_table');
        var rows = table.getElementsByTagName('tr');
        var data = [];

        // Loop through table rows and collect data
        for (var i = 0; i < rows.length; i++) {
            var row = [];
            var cells = rows[i].getElementsByTagName('td');
            for (var j = 0; j < cells.length; j++) {
                row.push(cells[j].innerText.trim());
            }
            data.push(row.join(',')); // Join row elements with commas
        }

        // Set the CSV data in the hidden input field
        document.getElementById('csv_data_input').value = data.join('\n');

        // Submit the form to generate the CSV file
        document.getElementById('csv_form').submit();
    }
</script>









    </div>
</div>


    </div>
</div>


            <!--=========New customer==========-->
            
        <script src="assets/js/admin.js"></script>
        <!--icons--><script>
        function confirmSignOut() {
    // Display a confirmation dialog
    if (confirm("Are you sure you want to sign out?")) {
        // If user clicks "OK", proceed with the signout process
        window.location.href = "signout.php";
    } else {
        // If user clicks "Cancel", do nothing
        return false;
    }
}
</script>
<script>
function showAllProducts() {
    window.location.href = window.location.pathname; // Reload the page without any search parameters
}
</script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>