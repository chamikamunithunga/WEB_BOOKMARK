<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {

    $conn = new mysqli("localhost", "root", " ", "cart");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $book_name = $_POST["book_name"];
    $quantity = $_POST["quantity"];
    $price=$_price["price"];
    
    $user_id = $_SESSION["user_id"]; 
    $check_query = "SELECT * FROM cart WHERE user_id = $user_id AND book_id = $book_id";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
      
        $update_query = "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $user_id AND book_name = $book_name";
        $conn->query($update_query);
    } else {
    
        $insert_query = "INSERT INTO cart (user_id, book_id, quantity) VALUES ($user_id, $book_id, $quantity)";
        $conn->query($insert_query);
    }

    $conn->close();
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["view_cart"])) {
   
    $conn = new mysqli("your_host", "your_username", "your_password", "your_database");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION["user_id"]; 
    $view_query = "SELECT books.title, books.price, cart.quantity FROM cart
                   INNER JOIN books ON cart.book_name = books.name
                   WHERE cart.user_id = $user_id";
    $view_result = $conn->query($view_query);

    if ($view_result->num_rows > 0) {
        while ($row = $view_result->fetch_assoc()) {
            echo "Title: " . $row["title"] . " - Price: " . $row["price"] . " - Quantity: " . $row["quantity"] . "<br>";
        }
    } else {
        echo "Cart is empty.";
    }

    $conn->close();
}


?>