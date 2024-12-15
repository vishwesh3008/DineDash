<?php 

include("redirect_to_home.php");
include("config.php");

if(isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $password = $_POST['password'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $marital_status = $_POST['marital_status'];
    $family_size = $_POST['family_size'];

    $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if($result->num_rows > 0) {
        echo '<script type="text/javascript">alert("User account with that email already exists!");</script>';
    } elseif(strlen($phone_number) != 10) {
        echo '<script type="text/javascript">alert("Phone number should be of 10 digits.");</script>';
    } 
    else {
        $query = $conn->prepare("INSERT INTO users (name, email, password, age, gender, marital_status, family_size, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssssisis", $name, $email, $password, $age, $gender, $marital_status, $family_size, $phone_number);
        if ($query->execute()) {
            header("Location: index.php?reg_success=yes");
            exit;
        } else {
            echo '<script type="text/javascript">alert("Registration failed: ' . htmlspecialchars(mysqli_error($conn)) . '");</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>User Registration</title>
</head>
<body>
    <div>
        <form action="user_register.php" method="POST">
        <li ><a class="returnbutton" href='index.php'; ?><i class="fas fa-home"></i>Return to Home Page</a></li>
        <br>
        <h2>Register Customer</h2>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your Name" required>

            <label for="InputEmail">Email address</label>
            <input type="email" id="InputEmail" name="email" placeholder="Enter your Email" required>

            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" required>

            <label for="InputPassword">Password</label>
            <input type="password" id="InputPassword" name="password" placeholder="Enter password" required>

            <label for="age">Age</label>
            <input type="number" id="age" name="age" placeholder="Enter your age" required>

            <label for="gender">Gender</label>
            <input type="text" id="gender" name="gender" placeholder="Gender" required>

            <label for="marital_status">Marital Status</label>
            <input type="text" id="marital_status" name="marital_status" placeholder="Marital Status" required>
            <label for="family_size">Family Size</label>
            <input type="number" id="family_size" name="family_size" placeholder="Family Size" required>


            <button style="width: 100%" type="submit" id="button" name="submit">Register</button>
        </form>
    </div>
</body>
</html>
