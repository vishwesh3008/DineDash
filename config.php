<?php
// Local setting
$server = "localhost";
$username = "root";
$password = "root";
$db = "dinedash_final";

$conn = new mysqli($server, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// for server
// $server = "sql105.infinityfree.com";
// $username = "if0_37922755";
// $password = "Gmps1234";
// $db = "if0_37922755_dindash_final";

// $conn = new mysqli($server, $username, $password, $db);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 
?>