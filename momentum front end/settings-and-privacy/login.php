<?php
// login.php
session_start();
require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        echo json_encode(['status' => 'success', 'message' => 'Login successful.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Login failed.']);
}
?>