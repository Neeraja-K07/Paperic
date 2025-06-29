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
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        
        <style>
            .row {
    display: flex;
    justify-content: space-between;
}

.review {
    width: calc(20% - 10px); /* Adjust width as needed */
    margin-bottom: 20px; /* Adjust margin as needed */
    border: 1px solid transparent; /* Invisible border */
    padding: 10px;
    box-sizing: border-box;
}

            .review-container {
    display: inline-block;
    margin-right: 20px; /* Adjust margin as needed */
}

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

        /* Style for the star icons */
        /*  */
        .star{
    text-align:end;
    color:orange;
}
    </style>
           
            <body>
            <!-- <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> -->

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

            // Close the database connection
            // mysqli_close($conn);
            ?>
        </div>
                </div>
                <!--============cards=============-->
                <div class="cardBox">



                    <!-- <div class="card">
                        <div>
                            <div class="numbers">1,600</div>
                            <div class="cardName">Daily Views</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="eye-outline"></ion-icon>
                        </div>
                    </div> -->


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
            <div class="cardName">Unordered carts</div>
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
<?php
// Assuming you have already established a connection to your MySQL database

// SQL query to fetch ratings and reviews along with customer names
$query = "SELECT 
            rr.r_id AS review_id,
            rr.c_id,
            c.username AS customer_name,
            rr.Review AS review,
            rr.ratings AS rating
          FROM 
            Reviews_Ratings rr
          JOIN 
            customer c ON rr.c_id = c.c_id
          UNION ALL
          SELECT 
            pr.pr_id AS review_id,
            pr.c_id,
            c.username AS customer_name,
            pr.reviews AS review,
            pr.ratings AS rating
          FROM 
            product_review pr
          JOIN 
            customer c ON pr.c_id = c.c_id
          ORDER BY 
            c_id, review_id";

$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Counter for rows
        $row_counter = 0;

        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            // Open a row div for every 5 reviews
            if ($row_counter % 5 == 0) {
                echo '<div class="row">';
            }

            // Output review and rating
            echo '<div class="review">';
            echo "Review ID: " . $row["review_id"]. "<br>";
            echo "Customer Name: " . $row["customer_name"]. "<br>";
            echo "Review: " . $row["review"]. "<br>";
            echo "Rating: " . $row["rating"]. "<br>";
            // Display colored stars based on the rating
            $rating = $row["rating"];
            echo '<div class="star">';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $rating) {
                    echo '<span><img src="https://t4.ftcdn.net/jpg/05/70/03/51/360_F_570035178_kjB04e6Myv95x9YukX6ie8ynaaaY7i0L.jpg" width="20" height="20">
                    </span>';
                } 
            }
            echo '</div>';
            echo '</div>';

            // Close the row div for every 5 reviews
            if ($row_counter % 5 == 4) {
                echo '</div>'; // Close the row
            }

            // Increment the row counter
            $row_counter++;
        }

        // If there are remaining reviews, close the row div
        if ($row_counter % 5 != 0) {
            echo '</div>'; // Close the row
        }
    } else {
        echo "No reviews found.";
    }
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

      
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

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>