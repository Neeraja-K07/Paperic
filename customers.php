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
            .recentCustomers{
    position: relative;
    display: grid;
    min-height: 500px;
    padding: 20px;
    background: var(--white);
    box-shadow: 0 70px 25px rgba(0,0,0,0.08);
    border-radius: 20px;
}
.recentCustomers .imgBx{
    position: relative;
    width: 40px;
    height: 40px;
    border-radius: 50px;
    overflow: hidden;
}
.recentCustomers .imgBx img{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.recentCustomers table tr:hover{
    background: var(--blue);
    color: var(--white);
}
.recentCustomers table tr td{
    padding: 12px 10px;
}
.recentCustomers table tr td h4{
    font-size: 16px;
    font-weight: 500;
    line-height: 1.2rem;
}
.recentCustomers table tr td h4 span{
    font-size: 14px;
    color: var(--black2);
}
.recentCustomers table tr:hover td h4 span{
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
                    <div class="search">
                        <label>
                            <input type="text" placeholder="Search here">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </div>
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
                <!-- <div class="cardBox">
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

            </div> -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <!-- <h2>Recent Customers</h2> -->
                    

                    <?php
// Establish connection to the database
$conn = mysqli_connect("localhost", "root", "", "Paperic");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve recent customers' data from the Customer table
$retrieve_customers_query = "SELECT username, email, phoneno, companyaddress, profile_image FROM Customer ORDER BY c_id DESC LIMIT 3"; // Change the limit according to your requirement
$result = mysqli_query($conn, $retrieve_customers_query);

// Check if there are any customers
if (mysqli_num_rows($result) > 0) {
    echo '<div class="recentCustomers">
            <div class="cardHeader">
                <h2>Recent Customers</h2>
                <table>';
    // Loop through the retrieved data
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td width="60px">
                    <div class="imgBx"><img src="' . ($row['profile_image'] ? 'Profileimages/' . $row['profile_image'] : 'https://img.freepik.com/free-vector/man-profile-account-picture_24908-81754.jpg?t=st=1710678805~exp=1710682405~hmac=2ce8bd7c92f6bec41a586cc89b0ed0284e423c367e9d54eb444bada809536cf8&w=740') . '" alt=""></div>
                </td>
                <td>
                    <h4>' . $row['username'] . '<br><span>' . $row['email'] . '</span></h4>
                    <p>' . $row['phoneno'] . '</p>
                    <p>' . $row['companyaddress'] . '</p>
                </td>
            </tr>';
    }
    echo '</table></div></div>';

} else {
    echo 'No recent customers found.';
}

// Close the database connection
mysqli_close($conn);
?>

              
                <!-- <table>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmG7ndpBcMr-tar3dYRsj4ftcnWCDnOPnydA&usqp=CAU" alt=""></div>
                        </td>
                        <td>
                            <h4>Chhotta Bheem <br><span>Italy</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmG7ndpBcMr-tar3dYRsj4ftcnWCDnOPnydA&usqp=CAU" alt=""></div>
                        </td>
                        <td>
                            <h4>Chhotta Bheem <br><span>Italy</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmG7ndpBcMr-tar3dYRsj4ftcnWCDnOPnydA&usqp=CAU" alt=""></div>
                        </td>
                        <td>
                            <h4>Chhotta Bheem <br><span>Italy</span></h4>
                        </td>
                    </tr>
                </table> -->
            </div>
          

        </div>
        <script src="assets/js/admin.js"></script>
        <!--icons-->
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
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>    
</body>
</html>