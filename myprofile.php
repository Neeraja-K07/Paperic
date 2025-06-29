<!--myprofile.php--profile image not showing-->
<!--      https://www.youtube.com/watch?v=5n-tiNha5kw     -->

<?php
// Start the session
session_start();
// Enable error reporting to display errors on the page
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
        <link rel="stylesheet" href="myprofile.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eU02nT/TzftbGkqx4O/+r38TEid6ezbQBEQVRMNFbE4EBU5YOWF2gt4kNpd1TJB" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    </head>
    <body>
        <style>
            .img-radius {
    border-radius: 50%; /* This creates a circular shape */
    width: 100px; /* Adjust the width and height as needed */
    height: 100px;
}

            .popup-form button {
        background-color: red;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }
    

    /* Hover effect for the Close button */
    .popup-form button:hover {
        background-color: darkred;
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
                        <a href="productrestock.php">
                            <span class="icon">
                            <ion-icon name="add-circle-outline"></ion-icon>
                            </span>
                            <span class="title">Product Restock</span>
                        </a>
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

                
                
                <!--  -->
            <script src="assets/js/admin.js"></script>
        <!--icons-->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<!--User Profile Card-->
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
<div class="col-xl-6 col-md-12">
<?php
// Start session to access session variables
// session_start();

// Establish connection to the database
$conn = mysqli_connect("localhost", "root", "", "Paperic");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if c_id is set in the session
if(isset($_SESSION['customer_id'])) {
    $c_id = $_SESSION['customer_id'];

    // Retrieve user details from the Customer table based on the c_id
    $retrieve_user_query = "SELECT * FROM Customer WHERE c_id = $c_id";
    $result = mysqli_query($conn, $retrieve_user_query);
    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $email = $row['email'];
        $phoneno = $row['phoneno'];
        $companyaddress = $row['companyaddress'];
        $gstno = $row['gstno'];
        $profile_image = $row['profile_image'];
        $image_source = $profile_image ? 'Profileimages/'.$profile_image : 'https://img.icons8.com/bubbles/100/000000/user.png'; // Adjust the path accordingly

        // Debugging statement to print the value of $image_source
        // echo "Image Source: " . $image_source . "<br>";
        // // Alternatively, you can use var_dump() for more detailed output
        // var_dump($image_source);

        // Display user details in the HTML structure
        echo '
        <div class="card user-card-full">
            <div class="row m-l-0 m-r-0">
                <div class="col-sm-4 bg-c-lite-green user-profile">
                    <div class="card-block text-center text-white">
                        <div class="m-b-25">
                        
                        <img src="' . $image_source . '" class="img-radius" alt="User-Profile-Image">
                        </div>
                        <h6 class="f-w-600" style="color:white">'.$username.'</h6>
                        
                        <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card-block">
                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Email</p>
                                <h6 class="text-muted f-w-400">'.$email.'</h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Phone</p>
                                <h6 class="text-muted f-w-400">'.$phoneno.'</h6>
                            </div>
                        </div>
                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Company Details</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Company Address</p>
                                <h6 class="text-muted f-w-400">'.$companyaddress.'</h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">GST No.</p>
                                <h6 class="text-muted f-w-400">'.$gstno.'</h6>
                            </div>
                        </div>
                        <ul class="social-link list-unstyled m-t-40 m-b-10">
                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>';
    } else {
        echo '<div>User not found.</div>';
    }
} else {
    echo '<div>User ID not set in session.</div>';
}

// Close the database connection
mysqli_close($conn);
?>
 <!-- Edit Profile Button -->
                    <!-- Edit Profile Button -->
                    <button class="rounded-button" onclick="OpenEditPopup()">Edit Profile</button>

                    <!-- Reset Password Button -->
                    <button class="rounded-button" onclick="openPopup()">Reset Password</button>
</div>
<div class="popup-container" id="popupContainer">
        <div class="popup-form">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <form action="resetpassword.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required><br>

                <label for="password">Old password:</label>
                <input type="password" name="old_password" required><br>

                <label for="password">New password</label>
                <input type="password" name="new_password" required><br>

                <input type="submit" name="submit" value="Reset Password">
            </form>
            <button onclick="closePopup()"><b>Close</b></button>
        </div>
    </div>
    <div class="popup-container" id="editPopupContainer">
    <div class="popup-form">
        <span class="close-btn" onclick="closeEditPopup()">&times;</span>
        <form action="editprofile.php" method="post" enctype="multipart/form-data"> <!-- Added enctype="multipart/form-data" -->
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="phoneno">Phone Number:</label>
    <input type="text" name="phoneno" required><br>

    <label for="companyaddress">Company Address:</label>
    <input type="text" name="companyaddress" required><br>

    <label for="gstno">GST No.:</label>
    <input type="text" name="gstno" required><br>

    <label for="profile_image">Profile Image:</label>
    <input type="file" accept="image/png, image/jpeg, image/jpg" name="profile_image" class="box"><br>

    <input type="submit" name="submit" value="Update Profile">
</form>
    </div>
</div>
    
<script>
    function openPopup() {
        document.getElementById("popupContainer").style.display = "flex";
    }

    function closePopup() {
        document.getElementById("popupContainer").style.display = "none";
    }

    function OpenEditPopup() {
        document.getElementById("editPopupContainer").style.display = "flex";
    }

    function closeEditPopup() {
        document.getElementById("editPopupContainer").style.display = "none";
    }

    // Close popup when clicking outside the form
    window.onclick = function(event) {
        var popup = document.getElementById("popupContainer");
        if (event.target == popup) {
            popup.style.display = "none";
        }

        var editPopup = document.getElementById("editPopupContainer");
        if (event.target == editPopup) {
            editPopup.style.display = "none";
        }
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