<?php
// fetch_user.php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT full_name, username, profile_picture FROM users WHERE id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'data' => $user]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch user data.']);
}
?>