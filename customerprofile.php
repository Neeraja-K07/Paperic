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
    header("Location: loginsignup.php"); // Replace "login.php" with your login page URL
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="cnavbar.css">
        <title>Customer Home page</title>
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

/* nav{
    
    background-color: #5fc9f3;
    box-shadow: px 3px 5px rgba(0,0,0,0.1);
    text-align: center; 
    height: 80px;
    
    
} */
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
/* nav a{
    height: 100%;
    padding: 0 30px;
    text-decoration: none;
    display: flex;
    align-items: center;
    color: black;
}
nav a:hover{
    background-color: #f0f0f0;
} */
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
.user-card-full {
    overflow: hidden;
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 20px rgba(69, 90, 100, 0.3); /* Increased shadow */
    box-shadow: 0 5px 20px rgba(69, 90, 100, 0.3); /* Increased shadow */
    border: none;
    margin-bottom: 30px;
}

.m-r-0 {
    margin-right: 0px;
}

.m-l-0 {
    margin-left: 0px;
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px;
}

.bg-c-lite-green {
        /* background: -webkit-gradient(linear, left top, right top, from(#0c359e), to(#4488ef));
    background: linear-gradient(to right,#0c359e, #4488ef); */
    background-color:#4488ef;
}

.user-profile {
    padding: 20px 0;
}

.card-block {
    padding: 1.25rem;
}

.m-b-25 {
    margin-bottom: 25px;
}

/* .img-radius {
    border-radius: 5px;
} */
.img-radius {
    border-radius: 50%; /* Makes the image round */
    width: 100px; /* Adjust the width as needed */
    height: 100px; /* Adjust the height as needed */
    object-fit: cover; /* Ensures the image covers the entire container */
    border: 2px solid #fff; /* Optional: Adds a white border around the image */
}



 
h6 {
    font-size: 14px;
}

.card .card-block p {
    line-height: 25px;
}

@media only screen and (min-width: 1400px){
p {
    font-size: 14px;
}
}

.card-block {
    padding: 1.25rem;
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.m-b-20 {
    margin-bottom: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.card .card-block p {
    line-height: 25px;
}

.m-b-10 {
    margin-bottom: 10px;
}

.text-muted {
    color: #919aa3 !important;
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.f-w-600 {
    font-weight: 600;
}

.m-b-20 {
    margin-bottom: 20px;
}

.m-t-40 {
    margin-top: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.m-b-10 {
    margin-bottom: 10px;
}

.m-t-40 {
    margin-top: 20px;
}

.user-card-full .social-link li {
    display: inline-block;
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
.rounded-button {
    height:50px;
    width:20%;
    outline:none;
    border:none;
    color:white;
    background:#0c359e;
    border-radius: 25px; /* Adjust the border-radius values for an oval shape */
    transition:all 0.4s;
}

.rounded-button:hover {
    background-color:#4488ef;
}

.rounded-button.right {
    float: right;
}
/*Popup*/
.popup-container {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.popup-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}
/*Form*/
form {
    max-width: 400px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/
    
}

label {
    display: block;
    margin-bottom: 8px;
    color: rgb(21, 21, 105);
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: rgb(80, 80, 213);
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: rgb(93, 93, 182);
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
                
                <li>Latha Papers</li>
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
            }
</script>

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
<script>
function logout() {
    window.location.href = 'CustomerLogout.php';
}
</script>
        </script>
        </body>
        </html>