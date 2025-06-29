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

// If customer_id is set, you can retrieve it and use it further if needed
$customer_id = $_SESSION['customer_id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin dashboard</title>
        <link rel="stylesheet" href="productaddtrial.css">
    </head>
    <body>
   
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
                        <a href="#">
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
                            <span class="title">Help</span>
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
            <!--========order details list-->
            <!--addproduct.php--only styleproblems-->
<!-- <!Doctype html>
<html lang ="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE-edge">
      <title>Products</title>
</head> -->
<!--    navigation -->
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <title>Products</title> -->

   <!-- ionicons library -->
   <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

   <!-- custom CSS files -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- <link rel="stylesheet" href="addproductstyle.css"> -->
</head>
<body>
<button id="popupButton" class="btn">Add Product</button>
<div class="container">
   <!-- ... your existing PHP code ... -->
</div>

<!-- ... your existing PHP and HTML code ... -->

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

<?php

// @include 'config.php';

// Perform database query to check credentials
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "paperic";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_qty = $_POST['product_qty'];
   $product_price = $_POST['product_price'];
   $description = $_POST['description'];
   $minimum_qty = $_POST['min_qty'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'images/'.$product_image;

   if(empty($product_name) || empty($product_qty) || empty($product_price) || empty($product_image) || empty($description) || empty($minimum_qty)){
      $message[] = 'Please fill out all fields.';
   } else {
      $insert = "INSERT INTO Product(product_name, product_qty, amount, image, description, min_qty) VALUES('$product_name', '$product_qty', '$product_price', '$product_image', '$description', '$minimum_qty')";
      $upload = mysqli_query($conn, $insert);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         echo "<script>alert('new product added successfully')</script>;";
      } else {
         $message[] = 'Could not add the product';
      }
   }
}

// if(isset($_GET['delete'])){
//    $id = $_GET['delete'];
//    mysqli_query($conn, "DELETE FROM Product WHERE p_id = $id");
//    header('location:productaddtrial.php');
// }

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM Product WHERE p_id = $id");
    echo "<script>window.location.href='productaddtrial.php';</script>";
    exit();
 }
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product adding page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="addproductstyle.css"> -->

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<!-- <div class="container">

   <div class="admin-product-form-container">

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <textarea placeholder="description" name="description" class="box"></textarea>
         <input type="number" placeholder="enter the minimum quantity" name="min_qty" class="box">
         <input type="number" placeholder="enter the product quantity" name="product_qty" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div> -->
   <div id="popupFormContainer" class="popupFormContainer">
    <div class="popupFormContent">
        <span class="close">&times;</span>
        <form id="productForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <!-- Form fields -->
            <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box"><br>
         <input type="number" placeholder="enter product price" name="product_price" class="box"><br>
         <textarea placeholder="description" name="description" class="box"></textarea><br>
         <input type="number" placeholder="enter the minimum quantity" name="min_qty" class="box"><br>
         <input type="number" placeholder="enter the product quantity" name="product_qty" class="box"><br>
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box"><br>
         <input type="submit" class="btn" name="add_product" value="add product">

        </form>
    </div>
</div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM Product");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>product description</th>
            <th>product quantity</th>
            <th>minimum quantity</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="images/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['product_qty']; ?></td>
            <td><?php echo $row['min_qty']; ?></td>
            
           <!-- ... -->

<td>
    <a href="productupdate.php?edit=<?php echo $row['p_id']; ?>" class="btn edit-btn">
        <i class="fas fa-edit"></i> Edit&nbsp; &nbsp;
    </a><br>
    <a href="productaddtrial.php?delete=<?php echo $row['p_id']; ?>" class="btn delete-btn">
        <i class="fas fa-trash"></i> Delete
    </a>
</td>

<!-- ... -->

         </tr>
      <?php } ?>
      </table>
   </div>

</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>
    // Get the button and popup form container
    const button = document.getElementById('popupButton');
    const popupFormContainer = document.getElementById('popupFormContainer');

    // When the button is clicked, show the popup form and blur the background
    button.addEventListener('click', function() {
        popupFormContainer.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Disable scrolling
    });

    // Close the popup form when the close button is clicked
    document.querySelector('.close').addEventListener('click', function() {
        popupFormContainer.style.display = 'none';
        document.body.style.overflow = 'auto'; // Enable scrolling
    });

    // Close the popup form when the user clicks outside of it
    window.addEventListener('click', function(event) {
        if (event.target === popupFormContainer) {
            popupFormContainer.style.display = 'none';
            document.body.style.overflow = 'auto'; // Enable scrolling
        }
    });
</script>


           
        <script src="assets/js/admin.js"></script>
        <!--icons-->
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