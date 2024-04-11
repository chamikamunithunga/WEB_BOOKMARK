<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signin";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM your_table_name WHERE name='$username' AND password='$password'"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    
        $_SESSION['user_name'] = $username;
        header("Location: welcome.php"); 
        exit();
    } else {
        echo '<script>alert("Invalid username or password. Please try again.");</script>';
        echo '<script>window.location.href = "signin.html";</script>';
    }
}

$conn->close();
?>