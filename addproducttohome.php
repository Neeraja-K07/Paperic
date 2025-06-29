<?php
// Start the session
session_start();

// Check if the customer_id is set in the session
if (!isset($_SESSION['customer_id'])) {
    // If customer_id is not set, redirect the user to the login page or handle it as needed
    header("Location: loginsignup.php"); // Replace "login.php" with the path to your login page
    exit(); // Make sure to exit after redirection
}

// If customer_id is set, you can retrieve it and use it further if needed
$customer_id = $_SESSION['customer_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin dashboard</title>
    <!-- <link rel="stylesheet" href="productaddtohome.css"> -->

</head>
<body>         
<style>
    *{
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
:root{
    --blue:orange;
    --white:#fff;
    --gray:#f5f5f5;
    --black1:#222;
    --black2:#999;
}
body{
    min-height: 100vh;
    overflow-x:hidden;
}
.container{
    position: relative;
    width: 100%;
}
.navigation{
    position: fixed;
    width: 300px;
    height: 100%;
    background: var(--blue);
    border-left: 10px solid var(--blue);
    transition: 0.5s;
    overflow: hidden;
}
.navigation.active{
    width: 80px;
}
.navigation ul{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
}
.navigation ul li{
    position: relative;
    width: 100%;
    list-style: none;
    border-top-left-radius: 30px;
    border-bottom-left-radius: 30px;
}
.navigation ul li:hover,
.navigation ul li.hovered{
    background-color: var(--white);
}
.navigation ul li:nth-child(1){
    margin-bottom: 40px;
    pointer-events: none;
}
.navigation ul li a{
    position: relative;
    display: block;
    width: 100%;
    display: flex;
    text-decoration: none;
    color: var(--white);
}
.navigation ul li:hover a,
.navigation ul li.hovered a{
    color: var(--blue);
}
.navigation ul li a .icon{
    position: relative;
    display: block;
    min-width: 60px;
    height: 60px;
    line-height: 75px;
    text-align: center;
}
.navigation ul li a .icon ion-icon{
    font-size: 1.75rem;
}
.navigation ul li a .title{
    position: relative;
    display: block;
    padding: 0 10px;
    height: 60px;
    line-height: 60px;
    text-align: start;
    white-space: normal;
}


.navigation ul li:hover a::before,
.navigation ul li.hovered a::before{
    content: '';
    position: absolute;
    right: 0;
    top: -50px;
    width: 50px;
    height: 50px;
    background-color: transparent;
    border-radius: 50%;
    box-shadow: 35px 35px 0 10px var(--white);
    pointer-events: none;
}
.navigation ul li:hover a::after,
.navigation ul li.hovered a::after {
    content: '';
    position: absolute;
    right: 0;
    bottom: -50px;
    width: 50px;
    height: 50px;
    background-color: transparent;
    border-radius: 50%;
    box-shadow: 35px -35px 0 10px var(--white);
    pointer-events: none;
}
.main{
    position: absolute;
    width: calc(100% - 300px);
    left: 300px;
    min-height: 100vh;
    background: var(--white);
    transition: 0.5s;
}
.main.active{
    width: calc(100% - 80px);
    left: 80px;
}
.topbar{
    width: 100%;
    height: 60px;         
    display: flex;
    justify-content: space-between;
    align-items: center;  
    padding: 0 10px;                 
}
.toggle{
    position: relative;
    width: 60px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 2.5rem;
    cursor: pointer;
}
.search {
            position: relative;
            display: flex;
            align-items: center;
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

        .search ion-icon {
            /* Adjusted position */
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 5px;
            font-size: 1.2rem;
        }

        .search button[type="submit"] {
            background-color: var(--blue);
            color: var(--white);
            border: none;
            border-radius: 20px;
            padding: 5px 15px;
            margin-left: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search button[type="submit"]:hover {
            background-color: #007bff; /* Change color on hover */
        }
.user{
    position: relative;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
}
.user img{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Product Cards */
.products-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    width: calc(105% - 210px); /* Adjust the width as needed */
    padding: 0 20px;
}

.product {
    width: calc(25% - 15px); /* Adjust the width as needed */
    max-width: 300px;
    height: 320px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 20px;
    padding: 15px;
}

.product img {
    width: 100%;
    border-radius: 5px;
    margin-bottom: 10px;
    object-fit: cover;
    height: 50%;
}

.product h3 {
    margin-bottom: 10px;
    font-size: 16px;
}

.product .price {
    font-weight: bold;
    color: #007bff;
    margin-bottom: 10px;
}

.product p {
    color: #666;
}

@media (max-width: 992px) {
    .product {
        width: calc(33.33% - 15px); /* Adjust the width as needed */
    }
}

@media (max-width: 768px) {
    .product {
        width: calc(50% - 15px); /* Adjust the width as needed */
    }
}

@media (max-width: 576px) {
    .product {
        width: calc(100% - 15px); /* Adjust the width as needed */
    }
}

    /* @media (max-width: 576px) {
        .products-row {
            flex-direction: column;
        }
    }
    .products-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    } */
    /*from admin.html*/
    @media(max-width:991px){
    .navigation{
        left: -300px;
    }
    .navigation.active{
        width: 300px;
        left: 0;
    }
    .main{
        width: 100%;
        left: 0;
    }
    .main.active{
        left: 300px;
    }
    .cardBox{
        grid-template-columns: repeat(2,1fr);
    }
}
@media(max-width:768px){
    .details{
        grid-template-columns: 1fr;
    }
    .recentOrders{
        overflow: auto;
    }
    .status.inProgress{
        white-space: nowrap;
    }
}
@media(max-width:480px){
    .cardBox{
        grid-template-columns: repeat(1,1fr);
    }
    .cardHeader h2{
        font-size: 20px;
    }
    .user{
        min-width: 40px;
    }
    .navigation{
        width: 100%;
        left: -100%;
        z-index: 1000;
    }
    .navigation.active{
        width: 100%;
        left: 0;
    }
    .toggle{
        z-index: 10001;
    }
    .main.active.toggle{
        color: #fff;
        position: fixed;
        right: 0;
        left: initial;
    }
}
.search {
        position: relative;
        display: flex;
        align-items: center;
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

    /* .search ion-icon {
        position: absolute;
        top: 100%;
        transform: translateY(-50%);
        left: 10px; 
        font-size: 1.2rem;
    } */
    .added-text {
        color: green;
        font-size: 14px; /* Adjust the font size as needed */
        margin-top: 5px; /* Add some top margin for spacing */
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
</style>
    <!-- navigation -->
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
                </ul>
            </div>
        <!-- main -->
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
                <form action="" method="GET">
                <div class="search">
                    <label>
                    
                    <ion-icon name="search-outline"></ion-icon><input type="text" name="search" placeholder="Search here">
                        <!-- <ion-icon name="search-outline"></ion-icon>  -->
                    </label>
                    <button type="submit">Search</button>
                </div>
            </form>
            <button class="show-all-button" onclick="showAllProducts()">Show All Products</button>
                <!-- <div class="user">
                    <img src="chutkii.jpg" alt="">
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
                    $image_source = $profile_image ? 'Profileimages/' . $profile_image : 'https://img.freepik.com/free-vector/man-profile-account-picture_24908-81754.jpg?t=st=1710678805~exp=1710682405~hmac=2ce8bd7c92f6bec41a586cc89b0ed0284e423c367e9d54eb444bada809536cf8&w=740'; // Adjust the path accordingly
                    echo '<img src="' . $image_source . '" class="img-radius" alt="User-Profile-Image">';
                } else {
                    echo '<div>User not found.</div>';
                }
            } else {
                echo '<div>User ID not set in session.</div>';
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
            </div>
            <!-- Product Cards -->
            <div class="products-container">
               
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

// Initialize search variable
$search = "";

// Check if search query is submitted
if(isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Fetch products based on search query
$sql = "SELECT * FROM Product WHERE product_name LIKE '%$search%'";
$result = $conn->query($sql);

// Check if products exist
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Check if the product is already added to the home page
        $product_id = $row["p_id"];
        $added_to_home = $row["added_to_home"];

        // Define button text and action based on whether the product is added to home or not
        $button_text = ($added_to_home == 'Yes') ? "Remove from Home" : "Add to Home";
        $button_action = ($added_to_home == 'Yes') ? "remove_from_home" : "add_to_home";

        // Define additional class and content for the product card based on whether it's added to home or not
        $additional_class = ($added_to_home == 'Yes') ? "added-to-home" : "";
        $additional_content = ($added_to_home == 'Yes') ? '<div class="added-text">&#10004; Added</div>' : '';

        // Display the product card with appropriate button and additional content
        echo '<div class="product ' . $additional_class . '">
        <img src="images/' . $row['image'] . '" class="card-img-top" alt="product">
        <h3>' . $row["product_name"] . '</h3>
        <div class="price">$' . $row["amount"] . '</div>
        <p>' . $row["description"] . '</p>
        <br>
        <form action="addproducttohome_works.php" method="post"> <!-- Corrected action -->
            <input type="hidden" name="product_id" value="' . $product_id . '">
            <input type="hidden" name="action" value="' . $button_action . '">
            <button type="submit" class="show-all-button">' . $button_text . '</button>
        </form>' . $additional_content . '<br>
    </div>';
    }
} else {
    // Display alert if product doesn't exist
    echo "<script>alert('Product not found!');window.location.href = 'addproducttohome.php'</script> ;";
}

// Close connection
$conn->close();
?>




            </div>
        </div>
    <!-- script -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.0.0/ionicons.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.0.0/ionicons.min.js"></script>
    <script src="productaddtohome.js"></script>
    <script>
    // JavaScript function to show all products
    function showAllProducts() {
        // Redirect to the page where all products are displayed
        window.location.href = "addproducttohome.php";
    }
</script>
<script>
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
</body>
</html>
