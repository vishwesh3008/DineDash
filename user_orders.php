<?php 
session_start();
if ($_SESSION['user'] != 'cus') {
    header("Location: index.php?accessdenied=true");
    die();
}

include("config.php");

$sql = "SELECT orders.*, food.name AS food_name, food.price AS food_price, food.image AS food_image, food.pref AS food_pref, 
               restaurants.restaurant_name AS restaurant_name, restaurants.location AS restaurant_location 
        FROM orders 
        JOIN food ON orders.food_id = food.id 
        JOIN restaurants ON food.res_id = restaurants.id 
        WHERE orders.user_id = ?
        ORDER BY orders.time DESC";
$query = $conn->prepare($sql);
$query->bind_param("i", $_SESSION['id']);
$query->execute();
$result = $query->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/restaurantorders.css"> 
    <title>My Orders</title>
</head>
<body>
<header>
<a class="back-to-home" href="user_home.php">
        <i class="fas fa-home"></i> Back to Home
    </a>
        <h1 class="order-title">My Orders</h1>
       
    </header>

<div class="menu">
    <?php 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pref = $row['food_pref'] ? "Non-Veg" : "Veg";
            $datetime = explode(" ", $row['time']);
            $order_date = $datetime[0];
            $order_time = $datetime[1];
            $price=$row['food_price']*$row['quantity'];
            echo "<div class='order-item'>";
            echo "<img src='" . htmlspecialchars($row['food_image']) . "' alt='" . htmlspecialchars($row['food_name']) . "'>";
            echo "<div class='order-details'>";
            echo "<h2>Food: " . htmlspecialchars($row['food_name']) . "</h2>";
            echo "<h3>Price: $" . $price . "</h3>";
            echo "<h3>Food Type: " . htmlspecialchars($pref) . "</h3>";
            echo "<h3>Quantity: " . htmlspecialchars($row['quantity']) . "</h3>";
            echo "<h3>Restaurant: " . htmlspecialchars($row['restaurant_name']) . "</h3>";
            echo "<h3>Location: " . htmlspecialchars($row['restaurant_location']) . "</h3>";
            echo "<h3>Date: " . htmlspecialchars($order_date) . "</h3>";
            echo "<h3>Time: " . htmlspecialchars($order_time) . " hrs</h3>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<h2 class='no-orders'>No orders yet!</h2>";
    }
    $conn->close();
    ?>
</div>

</body>
</html>
