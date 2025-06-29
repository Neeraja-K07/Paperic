<?php
// Start the session
session_start();

// Check if the customer_id is set in the session
if (!isset($_SESSION['customer_id'])) {
    // If customer_id is not set, redirect the user to the login page or handle it as needed
    header("Location: loginsignup.php"); // Replace "login.php" with the path to your login page
    exit(); // Make sure to exit after redirection
}

// Establish connection to the database
$conn = mysqli_connect("localhost", "root", "", "Paperic");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $companyaddress = $_POST['companyaddress'];
    $gstno = $_POST['gstno'];
    $profile_image = $_FILES['profile_image']['name'];
    $profile_image_tmp_name = $_FILES['profile_image']['tmp_name'];
    $profile_image_folder = 'Profileimages/'.$profile_image;
    $customer_id = $_SESSION['customer_id']; // Added this line to retrieve the customer_id

    if(empty($username) || empty($email) || empty($phoneno) || empty($companyaddress) || empty($gstno) || empty($profile_image)){
       $message[] = 'Please fill out all fields.';
    } else {
        $update = "UPDATE Customer SET username = '$username', email = '$email', phoneno = '$phoneno', companyaddress = '$companyaddress', gstno = '$gstno', profile_image = '$profile_image' WHERE c_id = $customer_id";

       $upload = mysqli_query($conn, $update);
 
       if($upload){
          move_uploaded_file($profile_image_tmp_name, $profile_image_folder); // Changed variable name to match the correct variable
          echo "<script>alert('New details updated successfully'); window.location='myprofile.php';</script>";

       } else {
          $message[] = 'Could not update the profile';
       }
    }
}
 

// Close the database connection
mysqli_close($conn);
?>