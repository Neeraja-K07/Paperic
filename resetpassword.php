<?php
session_start();

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Establish connection to the database
    $conn = mysqli_connect("localhost", "root", "", "Paperic");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve user ID from the session
    if(isset($_SESSION['customer_id'])) {
        $c_id = $_SESSION['customer_id'];

        // Retrieve old password, username, and new password from the form
        $username = $_POST['username'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];

        // Retrieve user details from the Customer table based on the username
        $retrieve_user_query = "SELECT * FROM Customer WHERE username = '$username'";
        $result = mysqli_query($conn, $retrieve_user_query);

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];

            // Verify if the old password matches the stored hashed password
            if(password_verify($old_password, $stored_password)) {
                // Hash the new password
                $encrypted_password = password_hash($new_password, PASSWORD_BCRYPT);

                // Update the password in the Customer table
                $update_password_query = "UPDATE Customer SET password = '$encrypted_password' WHERE c_id = $c_id";

                if(mysqli_query($conn, $update_password_query)) {
                    echo "Password updated successfully.";
                } else {
                    echo "Error updating password: " . mysqli_error($conn);
                }
            } else {
                echo "Old password does not match.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "User ID not set in session.";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Redirect to the form page if the form is not submitted
    header("Location: myprofile.php");
    exit();
}
?>
