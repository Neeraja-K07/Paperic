<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "paperic";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

$id = $_GET['edit'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['update_product'])) {
    $product_name = $_POST['product_name'];
    $product_qty = $_POST['product_qty'];
    $product_price = $_POST['product_price'];
    $description = $_POST['description'];
    $minimum_qty = $_POST['min_qty'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'images/' . $product_image;

    if (empty($product_name) || empty($product_qty) || empty($product_price) || empty($product_image) || empty($description) || empty($minimum_qty)) {
        $message[] = 'Please fill out all fields!';
    } else {
        // Use prepared statement to prevent SQL injection
        $update_data = $conn->prepare("UPDATE Product SET product_name=?, amount=?, image=?, product_qty=?, description=?, min_qty=? WHERE p_id = ?");
        
        if (!$update_data) {
            die("Error preparing update statement: " . $conn->error);
        }

        $update_data->bind_param("sssissi", $product_name, $product_price, $product_image, $product_qty, $description, $minimum_qty, $id);

        if (!$update_data->execute()) {
            $message[] = 'Failed to update product: ' . $conn->error; // Include the specific error in the message
        } else {
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            header('location: productaddtrial.php');
        }

        $update_data->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="addproductstyle.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">

<div class="admin-product-form-container centered">

   <?php
      $select = $conn->prepare("SELECT * FROM Product WHERE p_id = ?");
      
      if (!$select) {
         die("Error preparing select statement: " . $conn->error);
      }

      $select->bind_param("i", $id);

      if (!$select->execute()) {
         die("Error executing select statement: " . $select->error);
      }

      $result = $select->get_result();

      while($row = $result->fetch_assoc()){
   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update the product</h3>
      <input type="text" class="box" name="product_name" value="<?php echo $row['product_name']; ?>" placeholder="Enter the product name">
      <input type="number" min="0" class="box" name="product_qty" value="<?php echo $row['product_qty']; ?>" placeholder="Enter the product quantity">
      <input type="number" min="0" class="box" name="product_price" value="<?php echo $row['amount']; ?>" placeholder="Enter the product price">
      <textarea placeholder="Description" name="description" class="box"><?php echo $row['description']; ?></textarea>
      <input type="number" min="0" class="box" name="min_qty" value="<?php echo $row['min_qty']; ?>" placeholder="Enter the minimum quantity">
      <input type="file" class="box" name="product_image" accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="Update Product" name="update_product" class="btn">
      <a href="productaddtrial.php" class="btn">Go back!</a>
   </form>

   <?php }; ?>

</div>

</div>

</body>
</html>
