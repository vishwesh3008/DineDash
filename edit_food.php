<?php 
session_start();
if ($_SESSION['user'] != 'res') {
    header("Location: index.php?accessdenied=true");
    die();
}
include("config.php");
if (isset($_GET['id'])) {
    $foodItemId = $_GET['id'];
    $deleteFoodQuery = $conn->prepare("DELETE FROM food WHERE id = ?");
    $deleteFoodQuery->bind_param("i", $foodItemId);
    $deleteFoodQuery->execute();
    $deleteOrderQuery = $conn->prepare("DELETE FROM orders WHERE food_id = ?");
    $deleteOrderQuery->bind_param("i", $foodItemId);
    $deleteOrderQuery->execute();
    $deleteCartQuery = $conn->prepare("DELETE FROM cart WHERE food_id = ?");
    $deleteCartQuery->bind_param("i", $foodItemId);
    $deleteCartQuery->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/editfood.css">
    <title>My Food Menu</title>
</head>
<body>

    <header class="page-header">
        <div><a href="restaurant_home.php" class="back-link"><i class="fas fa-home"></i>Return to Options</a> </div>
    My Dishes</header>

    <main>
        <div class="menu-container">
            <?php 
            $fetchFoodQuery = "SELECT * FROM food WHERE res_id = ?";
            $getFoodStatement = $conn->prepare($fetchFoodQuery);
            $getFoodStatement->bind_param("i", $_SESSION['id']);
            $getFoodStatement->execute();
            $foodResult = $getFoodStatement->get_result();

            if ($foodResult->num_rows > 0) {
                while ($foodItem = $foodResult->fetch_assoc()) {
                    $foodTypeLabel = $foodItem['pref'] ? "Non-veg" : "Veg";

                    echo "<div class='food-card'>";
                    echo "<img class='food-image' src='" . htmlspecialchars($foodItem['image']) . "' alt='" . htmlspecialchars($foodItem['name']) . "'>";
                    echo "<div class='food-details'>";
                    echo "<h2>" . htmlspecialchars($foodItem['name']) . "</h2>";
                    echo "<p>Price: $" . htmlspecialchars($foodItem['price']) . "</p>";
                    echo "<p>Type: " . htmlspecialchars($foodTypeLabel) . "</p>";
                    echo "<p>Description: " . htmlspecialchars($foodItem['description']) . "</p>";
                    echo "<p>Cuisine: " . htmlspecialchars($foodItem['cuisine']) . "</p>";
                    echo "<div class='food-actions'>";
                    echo "<a class='btn btn-update' href='update_food.php?id=" . htmlspecialchars($foodItem['id']) . "'>Update</a>";
                    echo "<a class='btn btn-delete' href='edit_food.php?id=" . htmlspecialchars($foodItem['id']) . "'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='Nodish'>No food items found!</p>";
            }
            $conn->close();
            ?>
        </div>
    </main>
</body>
</html>
