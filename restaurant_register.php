<?php 

include("redirect_to_home.php");
include("config.php");

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $type = $_POST['type']; 
    $rate = $_POST['rate']; 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $location = $_POST['location'];


    $query = $conn->prepare("SELECT * FROM restaurants WHERE email_id = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result_chk = $query->get_result();

    if ($result_chk->num_rows > 0) {
        echo '<script type="text/javascript">alert("Restaurant account with that email already exists!");</script>';
    } else {
      
       
        $query = $conn->prepare("INSERT INTO restaurants (restaurant_name, restaurant_type, rate, location, email_id, password) VALUES (?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssdsss", $name, $type, $rate, $location, $email, $password);

if ($query->execute()) {
    header("Location: index.php?reg_success=yes");
    exit;
} else {
    echo '<script type="text/javascript">alert("Error in registration!");</script>';
}

        if ($query->execute()) {
            header("Location: index.php?reg_success=yes");
            exit;
        } else {
            echo '<script type="text/javascript">alert("Error in registration!");</script>';
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Restaurant Registration</title>
</head>
<body>
    <div>
        <form action="restaurant_register.php" method="POST">
           
            <li>
                <a class="returnbutton" href="<?= isset($_SESSION['user']) ? ($_SESSION['user'] == 'cus' ? 'user_home.php' : 'restaurant_home.php') : 'index.php'; ?>">
                    <i class="fas fa-home"></i> Return to Home Page
                </a>
            </li>

            <h2>Register Restaurant</h2>

            <label for="name">Restaurant Name</label>
            <input type="text" id="name" name="name" placeholder="Enter restaurant name" required>

            <label for="type">Restaurant Type</label>
            <input type="text" id="type" name="type" placeholder="Enter type (e.g., Fast Food, Fine Dining)" required>

            <label for="rate">Rate</label>
            <input type="number" id="rate" name="rate" placeholder="Enter rate (e.g., 4.5)" step="0.1" max="5" required>

            <label for="InputEmail">Email Address</label>
            <input type="email" id="InputEmail" name="email" placeholder="Enter your email" required>

            <label for="InputPassword">Password</label>
            <input type="password" id="InputPassword" name="password" placeholder="Enter password" required>

            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="Enter location" required>

            <button type="submit" id="button" name="submit">Register</button>
        </form>
    </div>
</body>
</html>


