<?php
// delete_account.php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
    $stmt->execute([':user_id' => $user_id]);

    session_destroy(); // Destroy the session
    echo json_encode(['status' => 'success', 'message' => 'Account deleted successfully.']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete account.']);
}
?>