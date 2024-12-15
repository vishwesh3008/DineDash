<?php
session_start();
if ($_SESSION['user'] !== 'res') {
    header("Location: index.php?accessdenied=true");
    die();
}
include("config.php");

$foodId = $_GET['id'] ?? null;
if ($foodId) {

    $getFoodQuery = $conn->prepare("SELECT * FROM food WHERE id = ?");
    $getFoodQuery->bind_param("i", $foodId);
    $getFoodQuery->execute();
    $foodResult = $getFoodQuery->get_result();
    $foodDetails = $foodResult->fetch_assoc();
} else {

    header("Location: restaurant_home.php?error=no_id");
    exit;
}

if (isset($_POST['submitUpdate'])) {
    $foodName = $_POST['foodName'];
    $foodPrice = $_POST['foodPrice'];
    $foodType = $_POST['foodType'] === "veg" ? 0 : 1; 
    $foodDescription = $_POST['foodDescription'];
    $foodCuisine = $_POST['foodCuisine'];

    $updateFoodQuery = $conn->prepare("UPDATE food SET name=?, price=?, pref=?, description=?, cuisine=? WHERE id=?");
    $updateFoodQuery->bind_param("sisssi", $foodName, $foodPrice, $foodType, $foodDescription, $foodCuisine, $foodId);

    if ($updateFoodQuery->execute()) {
        echo '<script>alert("Your Dish was updated successfully.");window.location.href="restaurant_home.php";</script>';
    } else {
        echo '<script>alert("Error updating Dish Please try again: ' . htmlspecialchars($conn->error, ENT_QUOTES) . '");</script>';
    }
    $updateFoodQuery->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/updatefood.css">
    <title>Update Food Item</title>
</head>
<body>
    <div class="form-container">
        <a href="restaurant_home.php" class="back-link">Back to Dashboard</a>
        <h2>Update Food Item</h2>
        <form action="update_food.php?id=<?= htmlspecialchars($foodId) ?>" method="post">
            <label for="foodName">Food Name:</label>
            <input type="text" id="foodName" name="foodName" value="<?= htmlspecialchars($foodDetails['name']) ?>" required>
            
            <label for="foodPrice">Price:</label>
            <input type="number" id="foodPrice" name="foodPrice" value="<?= htmlspecialchars($foodDetails['price']) ?>" required>
            
            <label for="foodDescription">Description:</label>
            <input type="text" id="foodDescription" name="foodDescription" value="<?= htmlspecialchars($foodDetails['description']) ?>" required>
            
            <label for="foodCuisine">Cuisine:</label>
            <input type="text" id="foodCuisine" name="foodCuisine" value="<?= htmlspecialchars($foodDetails['cuisine']) ?>" required>
            
            <fieldset>
                <input type="radio" id="veg" name="foodType" value="veg" <?= $foodDetails['pref'] == 0 ? 'checked' : '' ?>>
                <label for="veg">Veg</label>
                
                <input type="radio" id="nonVeg" name="foodType" value="non_veg" <?= $foodDetails['pref'] == 1 ? 'checked' : '' ?>>
                <label for="nonVeg">Non-Veg</label>
            </fieldset>
            
            <button type="submit" name="submitUpdate">Update Food</button>
        </form>
    </div>
</body>
</html>
