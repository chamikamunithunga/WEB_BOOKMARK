<?php


session_start();


$conn = new mysqli("localhost", "root", "", "register");


if ($conn->connect_error) {
    echo '<script>console.log("Connection failed: ' . $conn->connect_error . '");</script>';
} else {
    echo '<script>console.log("Connected to database successfully.");</script>';
   
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["usename"];
    $email= $_POST["email"];
    $password = $_POST["pass"];
    

   
    if ($password != $confirmPassword) {
        
        echo '<script>alert("Passwords do not match. Please try again.");</script>';
        echo '<script>window.location.href = "signup.html";</script>';
        
    } else {
       

        $checkQuery = "SELECT * FROM register WHERE email='$email'";
        $result = $conn->query($checkQuery);

        if($result->num_rows>0){
            
            echo '<script>alert("User with the same email already exists. Please use a different email.");</script>';
            echo '<script>window.location.href = "signup.html";</script>';

        }else{
             
               $sql = "INSERT INTO  (email, name, password) VALUES ( '$email','$username', '$confirmPassword')";
        
               echo '<script>window.location.href = "sign.html";</script>';

              if ($conn->query($sql) === TRUE) {
                  
               
                  $_SESSION['user_email'] = $email;
                  $_SESSION['user_name'] = $username;

                  echo '<script>alert("Registration successful!");</script>';
             } else {
                echo '<script>console.log("Error: ' . $sql . '<br>' . $conn->error . '");</script>';
             }
        }

       
    }
   
    $conn->close();
}