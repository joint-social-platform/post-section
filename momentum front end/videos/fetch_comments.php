<?php
session_start();
include 'config.php';

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $stmt = $conn->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = :post_id ORDER BY comments.created_at DESC");
    $stmt->bindParam(':post_id', $post_id);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($comments);
}
?>