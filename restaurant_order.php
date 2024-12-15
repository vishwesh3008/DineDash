<?php 
session_start();
if ($_SESSION['user'] !== 'res') {
    header("Location: index.php?accessdenied=true");
    exit;
}
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/restaurantorders.css"> 
    <title>Orders Taken</title>
</head>
<body>
<div class="navbar">
    <a href="restaurant_home.php" class="back-link"><i class="fas fa-home"></i> Return to Options</a>
    <header class="page-header">Orders Taken</header>
</div>
<div class="menu">
    <?php 
    $query = $conn->prepare("SELECT o.*, f.name AS food_name, f.price AS food_price, f.image AS food_image, 
                            u.name AS customer_name, u.phone_number AS customer_phone 
                            FROM orders o
                            JOIN food f ON f.id = o.food_id
                            JOIN users u ON u.user_id = o.user_id
                            WHERE f.res_id = ? ORDER BY o.time DESC");
    $query->bind_param("i", $_SESSION['id']);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        while ($order = $result->fetch_assoc()) {
            $datetime = explode(" ", $order['time']);
            $order_date = $datetime[0];
            $order_time = $datetime[1];
            $price=$order['food_price']*$order['quantity'];
            echo "<div class='order-item'>";
            echo "<img src='" . htmlspecialchars($order['food_image']) . "' alt='" . htmlspecialchars($order['food_name']) . "'>";
            echo "<div class='order-details'>";
            echo "<h2>Food: " . htmlspecialchars($order['food_name']) . "</h2>";
            echo "<h2>Price: $" . $price . "</h2>";
            echo "<h2>Quantity: " . htmlspecialchars($order['quantity']) . "</h2>";
            echo "<h2>Customer: " . htmlspecialchars($order['customer_name']) . "</h2>";
            echo "<h2>Phone: " . htmlspecialchars($order['customer_phone']) . "</h2>";
            echo "<h2>Date: " . htmlspecialchars($order_date) . "</h2>";
            echo "<h2>Time: " . htmlspecialchars($order_time) . " hrs</h2>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<h2 style='text-align: center;'>No orders yet!</h2>";
    }
    $conn->close();
    ?>
</div>
</body>
</html>
