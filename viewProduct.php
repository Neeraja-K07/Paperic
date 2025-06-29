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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
</head>
<body>
<style>
    .star {
        text-align: end;
        color: orange;
    }

    nav {
        background-color: #4488ef;
        box-shadow: px 3px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        height: 80px;
        line-height: 80px;
        position: relative;
    }

    .logo {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        height: 80px;
        padding-left: 20px;
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
        background-color: #f0f0f0;
        text-decoration: underline;
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

    .product-details-container {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    padding: 30px;
    background-color: #f9f9f9;
    border-radius: 12px;
    margin: 30px auto;
    width: 90%;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
}

.product-image {
    flex: 1 1 300px;
    max-width: 350px;
    text-align: center;
}

.product-image img {
    width: 100%;
    max-height: 300px;
    object-fit: contain;
    border-radius: 10px;
    border: 1px solid #ccc;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.product-details {
    flex: 1 1 400px;
    padding: 10px 20px;
    font-family: 'Montserrat', sans-serif;
}

.product-details h2 {
    font-size: 24px;
    margin-bottom: 15px;
    color: #333;
}

.product-details p {
    margin-bottom: 12px;
    font-size: 16px;
    color: #555;
}

.product-details h3 {
    margin-top: 25px;
    font-size: 20px;
    color: #222;
}

.star i {
    color: orange;
}

</style>
<nav>
    <ul class="sidebar">
        <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
        <li><a href="cnavbar.php">Home</a></li>
        <li><a href="MyOrdersCustomer.php">My Orders</a></li>
        <li><a href="customercart.php">Cart</a></li>
        <li><a href="customerprofile.php">Profile</a></li>
        <li><a href="#" onclick="logout()">Logout</a></li>
    </ul>
    <ul>
        <br>&nbsp;
        <li class="hideOnMobile"><a href="cnavbar.php">Home</a></li>
        <li class="hideOnMobile"><a href="MyOrdersCustomer.php">My Orders</a></li>
        <li class="hideOnMobile"><a href="customercart.php">Cart</a></li>
        <li class="hideOnMobile"><a href="customerprofile.php">Profile</a></li>
        <li class="hideOnMobile"><a href="#" onclick="logout()">Logout</a></li>
        <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
    </ul>
</nav>
<?php
// viewProduct.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Paperic";

// Check if productId is provided
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch product details from the product table
    $productQuery = "SELECT * FROM product WHERE p_id = $productId";
    $productResult = mysqli_query($conn, $productQuery);

    if (mysqli_num_rows($productResult) > 0) {
        $productRow = mysqli_fetch_assoc($productResult);

        // Fetch product reviews and ratings from the product_review table
        $reviewQuery = "SELECT pr.*, c.username 
                        FROM product_review pr 
                        INNER JOIN customer c ON pr.c_id = c.c_id 
                        WHERE pr.p_id = $productId";
        $reviewResult = mysqli_query($conn, $reviewQuery);

        // Prepare HTML content for product details and reviews
        echo '<div class="product-details-container">';
        // Product details
        echo '<div class="product-details">';
        echo '<h2>' . $productRow['product_name'] . '</h2>';
        echo '<p><strong>Price:</strong> ' . $productRow['amount'] . '</p>';
        echo '<p><strong>Description:</strong> ' . $productRow['description'] . '</p>';
        while ($reviewRow = mysqli_fetch_assoc($reviewResult)) {
            echo '<h3>Reviews</h3>';
            echo '<p><strong>Customer:</strong> ' . $reviewRow['username'] . '</p>';
            echo '<p><strong>Rating:</strong> ';
            // Display stars based on customer rating
            for ($i = 1; $i <= $reviewRow['ratings']; $i++) {
                echo '<span><i class="bi bi-star-fill" style="color: orange;"></i></span>';
            }
            echo '</p>';
            echo '<p><strong>Review:</strong> ' . $reviewRow['reviews'] . '</p>';
        }
        echo '</div>';
        // Product image
        echo '<div class="product-image">';
        echo '<img src="images/' . $productRow['image'] . '" alt="' . $productRow['product_name'] . '">';
        echo '</div>';
        echo '</div>';

    } else {
        echo "Product not found.";
    }

    mysqli_close($conn);
} else {
    echo "Product ID is not provided.";
}
?>
</body>
</html>
