<?php
// Start the session
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efc2.js" crossorigin="anonymous"></script>
    <title>Login and Sign up form</title>
    <link rel="stylesheet" href="loginsignup.css">
</head>
<body>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <form class="sign-in-form" method="POST">
                <h2 class="title">Login</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters"/>
                </div>
                <input type="submit" value="Login" name="login"class="btn solid">
            </form>

            <form class="sign-up-form" method="POST">
                <h2 class="title">Sign Up</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Username" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
                <div class="input-field">
                    <input type="email" name="email" placeholder="Email" required/>
                </div>
                <div class="input-field">
                    <input type="text" name="phoneno" placeholder="Phone no" required pattern="[0-9]{10}"
                           title="Must contain only 10 digits">
                </div>
                <div class="input-field">
                    <input type="text" name="companyaddress" placeholder="Company address" required>
                </div>
                <div class="input-field">
                    <input type="text" name="GSTNO" placeholder="GST_No" required>
                </div>
                <input type="submit" value="Sign up" class="btn solid" name="register">
            </form>
        </div>
    </div>
    <div class="panels-container">
        <div class="panel left-panel">
            <div class="content">
                <h3>New here?</h3>
                <h2><p><b>Welcome...unlock exclusive benefits</b></p></h2>
                <button class="btn transparent" id="sign-up-btn">Sign Up</button>
            </div>
        </div>
        <div class="panel right-panel">
            <div class="content">
                <h3>One of us?</h3>
                <h2><p><b>Welcome back...It's great to see you</b></p></h2>
                <button class="btn transparent" id="sign-in-btn">Login</button>
            </div>
        </div>
    </div>
</div>
<script src="loginsignup.js"></script>

</body>
</html>
<?php
// Establish connection to the database
$conn = mysqli_connect("localhost", "root", "", "Paperic");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Your code to handle customer registration
if (isset($_POST["register"])) {
    $username = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phoneno = $_POST["phoneno"];
    // $companyaddress = $_POST["companyaddress"];
    $gstno = $_POST["GSTNO"];

    // Check if the username is already taken
    $check_username_query = "SELECT * FROM Customer WHERE username='$username'";
    $result = mysqli_query($conn, $check_username_query);
    if (mysqli_num_rows($result) > 0) {
        // Username is already taken, handle accordingly (display error message or redirect)
        echo '<script>alert("Username is already taken. Please choose a different username.");</script>';
    } else {
        // Username is available, proceed with registration
        // Default role is set to "user"
        $role = "user";

        // Hash the password
        $encrypted_password = password_hash($password, PASSWORD_BCRYPT);

        $companyaddress = mysqli_real_escape_string($conn, $_POST["companyaddress"]);
$sql = "INSERT INTO Customer (username, password, email, phoneno, companyaddress, gstno, role) 
        VALUES ('$username', '$encrypted_password', '$email', '$phoneno', '$companyaddress', '$gstno', '$role')";

        
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Sign up successful."); window.location.href = "loginsignup.php";</script>';

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Your code to handle customer login
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Retrieve user details from the Customer table based on the provided username
    $retrieve_user_query = "SELECT * FROM Customer WHERE username='$username'";
    $result = mysqli_query($conn, $retrieve_user_query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        // Compare the user-entered password with the stored hashed password
        if (password_verify($password, $stored_password)) {
            // Password is correct, retrieve user role
            $role = $row['role'];
            $customer_id = $row['c_id'];

            // Store customer ID in a session variable
            $_SESSION['customer_id'] = $customer_id;


            // Redirect users based on their role
            if ($role === "admin") {
                header("Location: admin.php");
                exit();
            } else {
                // For other roles (assuming "user" role), you can redirect them to a different page if needed
                // Example: header("Location: user.html");
                // Alternatively, you can handle user authentication and redirection in a single script
                echo '<script>alert("Login successful."); window.location.href = "cnavbar.php";</script>';
            }
        } else {
            // Incorrect password
            echo '<script>alert("Incorrect password.");</script>';
        }
    } else {
        // User not found
        echo '<script>alert("User not found.");</script>';
    }
}

// Close the database connection
mysqli_close($conn);
?>





