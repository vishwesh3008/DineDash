<?php
session_start();

if ($_SESSION['user'] !== 'res') {
    header("Location: index.php?accessdenied=true");
    exit;
}

include("config.php");


$query = $conn->prepare("SELECT restaurant_name FROM restaurants WHERE id = ?");
$query->bind_param("i", $_SESSION['id']); 
$query->execute();
$result = $query->get_result();

$row = $result->fetch_assoc();
$name = $row ? $row['restaurant_name'] : "Unknown Restaurant";

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/res_home.css">
    <title>Restaurant Dashboard</title>
    
</head>
<body>
   <nav><h1>DineDash</h1></nav>
    <h3>Welcome, <span id="restaurant-name"></span></h3>
    <main>
    <div class="welcome-section">
        <h2>Welcome to Your Restaurant Dashboard</h2>
        <p>Manage your menu, view orders, and keep your customers happy with DineDash.</p>
        <div class="button-links">
            <button onclick="location.href='add_food.php'"><i class="fas fa-plus-circle"></i> Add Your Dishes To Our Menu</button>
            <button onclick="location.href='edit_food.php'"><i class="fas fa-edit"></i>Existing Dishes</button>
            <button onclick="location.href='restaurant_order.php'"><i class="fas fa-receipt"></i>Orders Taken</button>
            <button onclick="location.href='logout.php'"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </div>
    </div>
</main>

<footer>
        Best Place to Order Food Online
    </footer>
    <script>
        document.getElementById('restaurant-name').textContent = "<?php echo htmlspecialchars($name); ?>";
    </script>
</body>
</html>
