<?php 
session_start();
if($_SESSION['user'] != 'res') 
{
    header("Location: index.php?accessdenied=true");
    die();
} 

include("config.php");

if(isset($_POST['submit']))
{
    if($_POST['price'] > 0)
    {
    $imgname = $_FILES['image']['name'];
    $filename = 'image';
    $path = 'images/'; 
    $location = $path . $_FILES['image']['name']; 
    move_uploaded_file($_FILES['image']['tmp_name'], $location);
    
    $itemname=$_POST['itemname'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    $cuisine=$_POST['cuisine'];
    $pref = NULL;
    if($_POST['pref'] == "veg")
        $pref = 0;
    else
        $pref = 1;

    $query = $conn->prepare("INSERT INTO food (name, price, res_id, pref, image, description, cuisine) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($query) {
        $query->bind_param("siissss", $itemname, $price, $_SESSION['id'], $pref, $location, $description, $cuisine);

    }        
    if($query->execute()) {
        echo '<script type="text/javascript">alert("Your Dish Has Been Added To Our Menu Thank You!");</script>';
    } else {
        echo '<script type="text/javascript">alert("Error adding Your Dish Please Try Again: ' . htmlspecialchars($conn->error, ENT_QUOTES) . '");</script>';
    }    
    
    $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addfood.css">
    <title>Add Menu Item</title>
</head>
<body>
    <div class="form-container">
        <a href="restaurant_home.php"  class="back-link">Return To Options</a>
        <h2 style="color: #ff5e00;">Add New Food Item</h2>
        <form action="add_food.php" method="POST" enctype="multipart/form-data">
            <label for="itemname">Food Item Name</label>
            <input type="text" id="itemname" name="itemname" placeholder="Enter food item name" required>
            
            <label for="price">Price</label>
            <input type="number" step="1" id="price" name="price" placeholder="Enter price" required>
            
            <fieldset>
                <input type="radio" id="veg" name="pref" value="veg" checked>
                <label for="veg">Veg</label>
                <input type="radio" id="non_veg" name="pref" value="non_veg">
                <label for="non_veg">Non-Veg</label>
            </fieldset>
            
            <label for="description">Description</label>
            <input type="text" id="description" name="description" placeholder="Enter description" required>
            
            <label for="cuisine">Cuisine</label>
            <input type="text" id="cuisine" name="cuisine" placeholder="Enter cuisine type" required>
            
            <label for="image">Upload Image</label>
            <input type="file" id="image" name="image" required>
            
            <button type="submit" name="submit">Add Food</button>
        </form>
    </div>
</body>
</html>
