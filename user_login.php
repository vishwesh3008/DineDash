<?php 


if (isset($_SESSION['user']) && $_SESSION['user'] == 'cus') {
    header('Location: user_home.php');
    exit;
}

if (isset($_GET['login'])) {
    echo '<script type="text/javascript">alert("Login to Order");</script>';
}

include("redirect_to_home.php");
include("config.php");

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = $conn->prepare("SELECT user_id, name, password FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); 
        $pass = $user['password']; 

        if ($password= $pass) {

            $_SESSION['id'] = $user["user_id"];
            $_SESSION['name'] = $user["name"];
            $_SESSION['user'] = 'cus';

            header('Location: user_home.php'); 
            exit; 
        } else {
            echo '<script type="text/javascript">alert("Password Incorrect");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Email not Found");</script>';
    }
    $query->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssnormalize/cssnormalize-min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>User Login</title>
</head>
<body>
   
    

    <form action="user_login.php" method="POST">
    <li>
                <a class="returnbutton" href="<?= isset($_SESSION['user']) ? ($_SESSION['user'] == 'cus' ? 'user_home.php' : 'restaurant_home.php') : 'index.php'; ?>">
                    <i class="fas fa-home"></i> Return to Home Page
                </a>
            </li>
            <h2 >User Login</h2>
        <label for="InputEmail">Email address</label>
        <input 
            type="email" 
            id="InputEmail" 
            name="email" 
            placeholder="Enter your Email" 
            value="<?php echo isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : ''; ?>" 
            required>
        <label for="InputPassword">Password</label>
        <input 
            type="password" 
            id="InputPassword" 
            name="password" 
            placeholder="Enter password" 
            value="<?php echo isset($_COOKIE['password']) ? htmlspecialchars($_COOKIE['password']) : ''; ?>" 
            required>
        <button style="width: 100%" type="submit" id="button" name="submit">Login</button>
    </form>
</body>
</html>

