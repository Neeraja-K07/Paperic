<?php
// popup.php

// Include database connection code if necessary

// Check if productId is provided
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Fetch product details and reviews from the database using $productId
    // Example: You can write SQL queries to fetch data from the database

    // Here, I'll provide a sample response for demonstration purposes
    $productName = "Sample Product";
    $price = "$10";
    $description = "This is a sample product description.";
    $reviews = array(
        array("customerName" => "John Doe", "review" => "Good product", "rating" => 4),
        array("customerName" => "Jane Smith", "review" => "Nice product", "rating" => 5),
        // Add more reviews as needed
    );

    // Prepare HTML content for product details and reviews
    $htmlContent = '<h2>' . $productName . '</h2>';
    $htmlContent .= '<p><strong>Price:</strong> ' . $price . '</p>';
    $htmlContent .= '<p><strong>Description:</strong> ' . $description . '</p>';
    $htmlContent .= '<h3>Reviews</h3>';

    foreach ($reviews as $review) {
        $htmlContent .= '<p><strong>' . $review["customerName"] . ':</strong> ' . $review["review"] . ' (Rating: ' . $review["rating"] . ')</p>';
    }

    // Return the HTML content
    echo $htmlContent;
} else {
    echo "Product ID is not provided.";
}
?>
