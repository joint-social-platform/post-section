<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "username", "password", "database");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Check if the password and confirm password match
    if ($password != $confirmPassword) {
        $error = "Passwords do not match";
    } else {
        // Check if the email already exists
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error = "Email already exists";
        } else {
            // Insert the new user into the database
            $sql = "INSERT INTO users (fullName, email, password) VALUES ('$fullName', '$email', '$password')";
            $conn->query($sql);

            // Redirect the user to the login page
            header("Location: ../login/");
            exit;
        }
    }
}
?>