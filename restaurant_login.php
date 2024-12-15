<?php 

include("redirect_to_home.php");
include("config.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT id, password FROM restaurants WHERE email_id = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['user'] = 'res';
            header('Location: restaurant_home.php');
            exit;
        } else {
            echo '<script type="text/javascript">alert("Password Incorrect");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Email not Found");</script>';
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Restaurant Login</title>
    
    

</head>

<body>
    

    <form action="restaurant_login.php" method="POST">
    <li ><a class="returnbutton" href='<?= isset($_SESSION['user']) ? ($_SESSION['user'] == 'cus' ? 'user_home.php' : 'restaurant_home.php') : 'index.php'; ?>'><i class="fas fa-home"></i>Return to Home Page</a></li>
        
    <h2>Login as Restaurant Owner</h2>
        <label for="InputEmail">Email address</label>
        <input type="email" id="InputEmail" name="email" placeholder="Enter your Email" required>
        <label for="InputPassword">Password</label>
        <input type="password" id="InputPassword" name="password" placeholder="Enter password" required>    
        <button style="width: 100%" type="submit" id="button" name="submit">Login</button>
    </form>
</body>
</html>
