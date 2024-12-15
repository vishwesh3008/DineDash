<?php
session_start();
if ($_SESSION['user'] != 'cus') {
    header("Location: index.php?accessdenied=true");
    die();
}

include("config.php");
$query = $conn->prepare("SELECT name FROM users WHERE user_id = ?");
$query->bind_param("i", $_SESSION['id']);
$query->execute();
$result = $query->get_result();
$name_ = $result->fetch_assoc();
$name = $name_['name'];
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/res_home.css">
    <title>Customer Home</title>
</head>
<body>
   
    <nav>
        <h1>DineDash</h1>
        <h3>Welcome, <span id="customer-name"><?php echo htmlspecialchars($name); ?></span></h3>
    </nav>

    <main>
        <div class="welcome-section">
            <h2>Welcome to Your Customer Dashboard</h2>
            <p>Explore our menu, manage your cart, and track your orders seamlessly with DineDash.</p>
            <div class="button-links">
                <button onclick="location.href='menu.php'"><i class="fas fa-utensils"></i> Browse Menu</button>
                <button onclick="location.href='cart.php'"><i class="fas fa-shopping-cart"></i> My Cart</button>
                <button onclick="location.href='user_orders.php'"><i class="fas fa-box-open"></i> My Orders</button>
                <button onclick="location.href='logout.php'"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </div>
        </div>
    </main>

    <footer>
        <p>DineDash - Your Favorite Online Food Ordering Service</p>
    </footer>
</body>
</html>
