<!--cnavbar.html -- working-->
<!--  https://www.youtube.com/watch?v=GdrbE-s5DgQ&t=305s  -->

<!-- https://www.youtube.com/watch?v=U8smiWQ8Seg  -->
<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="cnavbar.css">
        <title>Customer Home page</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--stylesheet-->
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <!--bootstrapicons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Google font montserrat-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">  
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">


</head>
    <body>
        <style>
            .star{
    text-align:end;
    color:orange;
}
      
        nav {
            background-color: #4488ef;
            box-shadow: px 3px 5px rgba(0,0,0,0.1);
            text-align: center; 
            height: 80px;
            line-height: 80px;
            position: relative; /* Added position relative */
        }

        .logo {
            position: absolute; /* Absolute positioning */
            top: 0; /* Touching the top of the navbar */
            bottom: 0; /* Touching the bottom of the navbar */
            left: 0; /* Leftmost side of the navbar */
            margin: auto; /* Center the logo vertically */
            height: 80px; /* Adjust the height of the logo */
            padding-left: 20px; /* Adjust the padding as needed */
        }

        nav a {
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
            color: black;
        }

        .sidebar {
            display: none;
        }

        @media only screen and (max-width: 768px) {
            .sidebar {
                display: block;
            }
            .hideOnMobile {
                display: none;
            }
        }

        .image-container {
            width: 300px;
            height: auto;
            margin-bottom: 20px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            display: inline-block;
            vertical-align: top;
            text-align: center;
        }

        .image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .image-container h3 {
            margin-top: 10px;
            font-size: 16px;
        }

        .image-container p {
            font-size: 14px;
            margin-top: 5px;
        }

        .search-form {
            margin-left: 20px;
            display: flex;
            align-items: center;
        }

        .search-form input[type="search"] {
            padding: 8px;
            border: none;
            border-radius: 4px;
            margin-right: 5px;
            width: 200px;
        }

        .search-form button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #45a049;
        }
     
       /*footer*/
       #Lovespoon{
    width:150px;
    height:140px;
    padding:10px;
    margin:10px;
    float:left;
}
footer {
            background-color: #4488ef;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
            z-index: 1000; /* Ensure footer is on top of other content */
        }
#a1,#a2,#a3,#a4
{
    color:white;
}

.swal2-popup {
        font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
    }
    .button-container {
    display: flex;
    align-items: center;
    margin-top: 10px; /* Adjust as needed */
}

.button-container button {
    margin-right: 10px; /* Adjust as needed */
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
                <li><?php
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
        </li>
            </ul>
            
            <ul>
               
            <li class="search-form">
        <form class="d-flex" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!-- Changed the form method to POST and added action to submit to the same page -->
            <input class="form-control me-2" type="search" name="search_query" placeholder="Search" aria-label="Search">
            <!-- Added name attribute to input field for form submission -->
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        &nbsp;
        <form class="d-flex" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <button class="btn btn-outline-primary" type="submit" name="show_all">Show All Products</button>
            <!-- Added button to show all products -->
        </form>
    </li>
   
       
    
            <!-- <li class="search-form">
                <form class="d-flex">
                    
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </li> -->
            <br>&nbsp;
            <li class="hideOnMobile"><a href="cnavbar.php">Home</a></li>
            <li class="hideOnMobile"><a href="MyOrdersCustomer.php">My Orders</a></li>
            <li class="hideOnMobile"><a href="customercart.php">Cart</a></li>
            <li class="hideOnMobile"><a href="customerprofile.php">Profile</a></li>
            <li class="hideOnMobile"><a href="#"onclick="logout()">Logout</a></li>
            <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
        </nav>
 
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Paperic";

if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['customer_id'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle Search Query
    if (isset($_POST['search_query'])) {
        $searchQuery = $_POST['search_query'];
        $query = "SELECT p.*, AVG(pr.ratings) AS average_rating
                  FROM Product p
                  LEFT JOIN product_review pr ON p.p_id = pr.p_id
                  WHERE p.product_name LIKE '%$searchQuery%'
                  GROUP BY p.p_id";
    } else {
        // If no search query, fetch all products
        $query = "SELECT p.*, AVG(pr.ratings) AS average_rating
                  FROM Product p
                  LEFT JOIN product_review pr ON p.p_id = pr.p_id
                  GROUP BY p.p_id";
    }

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="image-container" >';
            $imagePath = 'images/' . $row['image'];
            echo '<img src="' . $imagePath . '">';
            echo '<h3>' . $row['product_name'] . '<br>';
            echo 'Price: ' . $row['amount'] . '<br>';
            echo 'Description: ' . $row['description'] . '</h3>';

            // Calculate number of orange stars based on average rating
            $averageRating = $row['average_rating'];
            $orangeStars = ceil($averageRating); // Round up to the nearest integer
            if ($orangeStars > 5) {
                $orangeStars = 5; // Maximum 5 stars
            }

            // Display the stars
            echo '<div class="star">';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $orangeStars) {
                    echo '<span><i class="bi bi-star-fill" style="color: orange;"></i></span>';
                } else {
                    echo '<span><i class="bi bi-star"></i></span>';
                }
            }
            echo '</div>';
            echo '<form method="post" action="viewProduct.php">';
            echo '<input type="hidden" name="productId" value="' . $row['p_id'] . '">';
           
            echo '<button type="submit" name="viewProduct" style="background-color: orange; color: white; border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; justify-content: center; align-items: center;">View</button>';

            echo '</form>';
            if ($row['product_qty'] < $row['min_qty']) {
                echo '<p style="color: red;">Out of Stock</p>';
                echo '<button disabled>Add to Cart</button>';
            } else {
                echo '<form action="addToCart.php" method="post">';
                echo '<input type="hidden" name="productId" value="' . $row['p_id'] . '">';
                echo '<button type="submit" class="inquiry-to-cart" onclick="showAlert()">Add to Cart</button>';
                echo '</form>';
               
            }
            // echo '<form method="post">';
            // echo '<input type="hidden" name="productId" value="' . $row['p_id'] . '">';
            // echo '<button type="submit" name="viewProduct" style="background-color: orange; color: white; border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; justify-content: center; align-items: center;">';
            // echo '<strong><ion-icon name="eye-outline" style="font-size: 24px;"></ion-icon></strong>'; // Increase font-size here
            // echo '</button>';
            // echo '</form>';
            // echo '</div>';
            echo '</div>';
        }
        echo'<br>';
        echo'<br>';
        echo'<br>';
        echo'<br>';
        echo'<br>';
        echo'<br>';
        echo'<br>';
    } else {
        echo "No products found.";
    }

    mysqli_close($conn);
} else {
    header("Location: login.php");
    exit();
}
?>
<!-- Hidden popup container -->
<!-- <div id="product-popup" class="product-popup">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopup()">&times;</span>
      
        <div id="product-details"></div>
    </div>
</div> -->
<footer>
        <div >
            <img id="Lovespoon" src="images/latha papers.jpg" alt="Logo">
            <div>
            <p id="intro">
                <b>Welcome to Latha Papers !!</b><br><br>At Latha Papers , we take pride in delivering quality paper solutions to meet your business needs. <br>
                As a dedicated supplier of KRAFT, DUPLEX Board and other paper products we bring reliability ,expertise and commitment to excellence to every transaction.<br><br><br>
                <br>
                <a id="a1" href="https://www.instagram.com/"><i class='bx bxl-instagram'></i></a>&nbsp  &nbsp<a id="a2" href="https://twitter.com/"><i class='bx bxl-twitter'></i></a>&nbsp &nbsp<a id="a3" href="#Support"><i class='bx bx-support'></i></a>&nbsp &nbsp<a id="a4" href="https://www.facebook.com/"><i class='bx bxl-meta'></i></a>
            </div>
        </div>
        <p>&copy;Latha papers</p>
    </footer>
<!-- Hidden popup container -->



    <!-- Add this JavaScript function to toggle the visibility of the popup -->


        
<script>
    function showSidebar() {
        const sidebar = document.querySelector('.sidebar')
        sidebar.style.display = 'flex'
    }

    function hideSidebar() {
        const sidebar = document.querySelector('.sidebar')
        sidebar.style.display = 'none'
    }
        </script>
        <script>
function logout() {
    window.location.href = 'CustomerLogout.php';
}
</script>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
<script>
  
function showAlert() {
    // Display the alert
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Item has been added to cart!',
        showConfirmButton: false,
        // timer: 4000 // Display the alert for 4 seconds
    });
}

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>





</html>

