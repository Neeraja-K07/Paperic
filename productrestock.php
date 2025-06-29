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
        <title>Customers</title>
        <!-- <link rel="stylesheet" href="productaddtrial.css"> -->
        <link rel="stylesheet" href="customers.css">
    </head>
    <body>
    <style>
        /* Table styles */
    .productTable {
        margin-top: 20px;
    }

    .productTable h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        background-color: #ddd;
    }

    th {
        background-color: #0c359e; /* Background color for table header */
        color:white; /* Text color for table header */
        transition: background-color 0.3s ease;
    }

    th:hover {
        background-color:#4488ef; /* Background color for table header on hover */
    }

    /* Table body styles */
    tbody tr:nth-child(even) {
        background-color: #f2f2f2; /* Alternate row background color */
    }

    /* Table cell styles */
td {
    color: #333; /* Text color for table cells */
}

/* Change text color of table cells to white when row is hovered */
tbody tr:hover td {
    background-color: white;
}

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

/*---------------main---------------*/
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
.search{
    position: relative;
    width: 400px;
    margin: 0 10px;
}
.search label{
    position: relative;
    width: 100%;
}
.search label input{
    width: 100%;
    height: 40px;
    border-radius: 40px;
    padding: 5px 20px;
    padding-left: 35px;
    font-size: 10px;
    outline: none;
    border: 1px solid var(--black);
}
.search label ion-icon{
    position: absolute;
    top: 0;
    left: 10px;
    font-size: 1.2rem;
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

/*cards*/
.cardBox{
    position: relative;
    width: 100%;
    padding: 20px;
    display: grid;
    grid-template-columns: repeat(4,1fr);
    grid-gap:30px;

}
.cardBox .card{
    position: relative;
    background: var(--white);
    padding: 30px;
    border-radius: 20px;
    display: flex;
    justify-content: space-between;
    cursor: pointer;
    box-shadow: 0 7px 25px rgba(0,0,0,0.05);
}
.cardBox .card .numbers{
    position: relative;
    font-weight: 500;
    font-size: 2.5rem;
    color: var(--blue);
}
.cardBox .card .cardName{
    color: var(--black);
    font-size: 1.1rem;
    margin-top: 5px;
}
.cardBox .card .iconBx{
    font-size: 1.5rem;
    color: var(--black2);
}
.cardBox .card:hover{
    background: var(--blue);
}
.cardBox .card:hover .numbers,
.cardBox .card:hover .cardName,
.cardBox .card:hover .iconBx{
    color: var(--white);
}
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

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
                </div>
                <!--============cards=============-->
                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers">1,600</div>
                            <div class="cardName">Daily Views</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="eye-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                        <div class="numbers">80</div>
                        <div class="cardName">Sales</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">24</div>
                        <div class="cardName">Comments</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">120000</div>
                        <div class="cardName">Earning</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>

            </div>
            <!-- Table to display products -->
            <div class="productTable">
    <br><h2>Restock Details</h2><br>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Quantity</th>
                <th>Minimum Quantity</th>
                <th>Less Than</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Establish connection to the database
            $conn = mysqli_connect("localhost", "root", "", "Paperic");

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Retrieve products where product quantity is less than the minimum quantity
            $retrieve_products_query = "SELECT * FROM Product WHERE product_qty < min_qty";
            $result = mysqli_query($conn, $retrieve_products_query);

            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    // Calculate the difference between min_qty and product_qty
                    $difference = $row['min_qty'] - $row['product_qty'];

                    echo "<tr>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['product_qty'] . "</td>";
                    echo "<td>" . $row['min_qty'] . "</td>";
                    echo "<td>" . $difference . "</td>"; // Display the difference
                    echo "<td>" . $row['amount'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No products found.</td></tr>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>

            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>    

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