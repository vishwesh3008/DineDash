<?php
session_start();

if ($_SESSION['user'] != 'cus') {
    header("Location: index.php?accessdenied=true");
    die();
}

include("config.php");

if (isset($_GET['id'])) {
    $query = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $query->bind_param("i", $_GET['id']);
    $query->execute();
    $query->close();
}

if (isset($_GET['order'])) {
    $sql = "SELECT * FROM cart WHERE user_id = ?";
    $query = $conn->prepare($sql);
    $query->bind_param("i", $_SESSION['id']);
    $query->execute();
    $result = $query->get_result();

    $price = 0;

    while ($row = $result->fetch_assoc()) {

        $foodStmt = $conn->prepare("SELECT * FROM food WHERE id = ?");
        $foodStmt->bind_param("i", $row['food_id']);
        $foodStmt->execute();
        $food = $foodStmt->get_result()->fetch_assoc();

        $price += $row['quantity'] * $food['price'];

        $orderStmt = $conn->prepare("INSERT INTO orders (food_id, quantity, user_id, time, restaurant_id) VALUES (?, ?, ?, NOW(), ?)");
        $orderStmt->bind_param("iiii", $food['id'], $row['quantity'], $_SESSION['id'], $food['res_id']);
        $orderStmt->execute();

        $foodStmt->close();
        $orderStmt->close();
    }

    $deleteStmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $deleteStmt->bind_param("i", $_SESSION['id']);
    $deleteStmt->execute();
    $deleteStmt->close();

    echo '<script type="text/javascript">alert("Order Placed Successfully. Pay a total of ' . $price . ' $ on delivery.");</script>';
    $query->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/cart.css">
    <title>My Cart</title>
</head>
<body>

    <header>
    
        <h1 class="cart-title">My Cart</h1>
        <a class="back-to-home" href="user_home.php">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>
    </header>

   

  
    <div class="cart">
        <?php
        $sql = "SELECT * FROM cart WHERE user_id = " . $_SESSION['id'];
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $food = $conn->query("SELECT * FROM food WHERE id = " . $row['food_id'])->fetch_assoc();
                $res = $conn->query("SELECT * FROM restaurants WHERE id = " . $food['res_id'])->fetch_assoc();
                $pref = $food['pref'] ? "Non-Veg" : "Veg";

                echo "<div class='cart-item'>";
                echo "<img src='" . htmlspecialchars($food['image']) . "' alt='" . htmlspecialchars($food['name']) . "'>" .
                     "<div class='cart-item-details'>" .
                     "<h2>" . htmlspecialchars($food['name']) . "</h2>" .
                     "<p><strong>Price:</strong> " . htmlspecialchars($food['price']) . " $</p>" .
                     "<p><strong>Food Type:</strong> " . htmlspecialchars($pref) . "</p>" .
                     "<p><strong>Quantity:</strong> " . htmlspecialchars($row['quantity']) . "</p>" .
                     "<p><strong>Restaurant:</strong> " . htmlspecialchars($res['restaurant_name']) . "</p>" .
                     "<p><strong>Location:</strong> " . htmlspecialchars($res['location']) . "</p>" .
                     "</div>" .
                     "<a class='delete-button' href='cart.php?id=" . htmlspecialchars($row['id']) . "'>Remove</a>";
                echo "</div>";
            }

            echo "<div class='order-button-container'>
                    <a class='order-button' href='cart.php?order=true'>Place Order</a>
                  </div>";
        } else {
            echo "<p class='empty-cart'>Your cart is empty.</p>";
        }
        $conn->close();
        ?>
    </div>

    <footer>
        <p>DineDash. One Stop Food Solution.</p>
    </footer>
</body>
</html>
