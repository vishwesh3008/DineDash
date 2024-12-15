<?php 
session_start();
include("config.php"); 

if (isset($_POST['submit'])) {
    if (isset($_SESSION['user']) && $_SESSION['user'] == 'cus') {
        $quantity = $_POST['quantity'];
        $food_id = $_POST['food_id'];
       
        if ($quantity > 0) {
            $query = $conn->prepare("INSERT INTO cart (food_id, quantity, user_id) VALUES (?, ?, ?);");
            $query->bind_param("iii", $food_id, $quantity, $_SESSION['id']);
            if ($query->execute()) {
                echo '<script>alert("Added Your Food To Cart");</script>';
            } else {
                echo '<script>alert("OOPS! There was an error while adding to cart.");</script>';
            }
            $query->close();
        } else {
            echo '<script>alert("Quantity should be greater than 0");</script>';
        }
    } elseif (isset($_SESSION['user']) && $_SESSION['user'] == 'res') {
        echo '<script>alert("Restaurants cannot place orders");</script>';
    } else {
        header("Location: user_login.php?login=false");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/menu_page.css">
    <title>Menu</title>
</head>
<body>
   
    <header>
        
       <div> <a class="back-link" href="<?= isset($_SESSION['user']) ? ($_SESSION['user'] == 'cus' ? 'user_home.php' : 'restaurant_home.php') : 'index.php'; ?>">
            <i class="fas fa-home"></i> Return to Home Page
        </a></div>
        <h1 class="menu-title">DineDash Menu</h1>
    </header>

    <main>
        <div class="menu-container">
            <?php 
            $foodResult = $conn->query("SELECT * FROM food");
            if ($foodResult->num_rows > 0) {
                while ($foodRow = $foodResult->fetch_assoc()) {

                    $restaurantQuery = $conn->prepare("SELECT * FROM restaurants WHERE id = ?");
                    $restaurantQuery->bind_param("i", $foodRow['res_id']);
                    $restaurantQuery->execute();
                    $restaurantDetails = $restaurantQuery->get_result()->fetch_assoc();
                    $restaurantQuery->close();

                    $foodType = $foodRow['pref'] ? "Non-Veg" : "Veg";

                    echo "<div class='food-item'>";
                    echo "<img class='food-image' src='" . htmlspecialchars($foodRow['image']) . "' alt='" . htmlspecialchars($foodRow['name']) . "'>";
                    echo "<div class='food-details'>";
                    echo "<h2>" . htmlspecialchars($foodRow['name']) . "</h2>";
                    echo "<p><strong>Price:</strong> " . htmlspecialchars($foodRow['price']) . " $</p>";
                    echo "<p><strong>Type:</strong> " . htmlspecialchars($foodType) . "</p>";
                    echo "<p><strong>Cuisine:</strong> " . htmlspecialchars($foodRow['cuisine']) . "</p>";
                    echo "<p class='food-description'>" . htmlspecialchars($foodRow['description']) . "</p>";
                    echo "<p><strong>Restaurant:</strong> " . htmlspecialchars($restaurantDetails['restaurant_name']) . "</p>";
                    echo "<p><strong>Rating:</strong> " . htmlspecialchars($restaurantDetails['rate']) . "</p>";
                    echo "<p><strong>Location:</strong> " . htmlspecialchars($restaurantDetails['location']) . "</p>";
                    echo "</div>";
                    echo "<form action='menu.php' method='POST' class='food-actions'>";
                    echo "<input type='number' name='quantity' placeholder='Enter quantity' min='1' required>";
                    echo "<input type='hidden' name='food_id' value='" . htmlspecialchars($foodRow['id']) . "'>";
                    echo "<button type='submit' name='submit' class='btn btn-update'>Order</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p class='nodish'>No food available.</p>";
            }

            $conn->close();
            ?>
        </div>
    </main>

    <footer>
        <p>DineDash - Your One Stop Solution.</p>
    </footer>
</body>
</html>
            