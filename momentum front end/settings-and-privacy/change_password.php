<?php
// change_password.php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$re_type_password = $_POST['re_type_password'];

if ($new_password !== $re_type_password) {
    echo json_encode(['status' => 'error', 'message' => 'New passwords do not match.']);
    exit;
}

try {
    // Fetch the current password from the database
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($current_password, $user['password'])) {
        echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect.']);
        exit;
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :user_id");
    $stmt->execute([
        ':password' => $hashed_password,
        ':user_id' => $user_id
    ]);

    echo json_encode(['status' => 'success', 'message' => 'Password updated successfully.']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update password.']);
}
?>