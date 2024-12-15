
<?php 

include("redirect_to_home.php");

$messages = [
    'reg_success' => "Registered successfully",
    'accessdenied' => "Access Denied",
    'loggedout' => "No one logged in!"
];

foreach ($messages as $key => $message) {
    if (isset($_GET[$key])) {
        echo "<script type='text/javascript'>alert('{$message}');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>DineDash</title>
</head>
<body>
    <header>
        <title>DINEDASH</title>
        <h1 style="color: #ff5e00;">DINEDASH</h1>
        <nav class="navbar" >
            <ul class="nav-links" >
                <li><a href="menu.php" ><i class="fas fa-utensils"></i> Menu</a></li>
                <li><a href="user_login.php"><i class="fas fa-user"></i> Login (Customer)</a></li>
                <li><a href="user_register.php"><i class="fas fa-user-plus"></i> Register (Customer)</a></li>
                <li><a href="restaurant_login.php"><i class="fas fa-store"></i> Login (Restaurant)</a></li>
                <li><a href="restaurant_register.php"><i class="fas fa-store-alt"></i> Register (Restaurant)</a></li>
            </ul>
        </nav>
    </header>
    <main class="id">
        <div class="id-content">
            <h2 style="color: #ff5e00;">Welcome to DineDash</h2>
            <p>Your one-stop solution to browse and order from the best restaurants in town.</p>
            <a href="menu.php" class="cta-button">Explore the Menu</a>
        </div>
    </main>
    <footer>
        Best Place To Order Food Online
    </footer>
</body>
</html>
