<?php
// update_profile.php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];
$full_name = $_POST['full_name'];
$username = $_POST['username'];

try {
    $stmt = $pdo->prepare("UPDATE users SET full_name = :full_name, username = :username WHERE id = :user_id");
    $stmt->execute([
        ':full_name' => $full_name,
        ':username' => $username,
        ':user_id' => $user_id
    ]);

    echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update profile.']);
}
?>