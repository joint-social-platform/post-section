<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];
    $comment = htmlspecialchars($_POST['comment']);

    $stmt = $conn->prepare("INSERT INTO comments (user_id, post_id, comment) VALUES (:user_id, :post_id, :comment)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':post_id', $post_id);
    $stmt->bindParam(':comment', $comment);

    if ($stmt->execute()) {
        echo "Comment added successfully!";
    } else {
        echo "Error adding comment.";
    }
}
?>