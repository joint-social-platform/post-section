<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $content = htmlspecialchars($_POST['content']);
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO posts (user_id, content, image) VALUES (:user_id, :content, :image)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image', $image);

        if ($stmt->execute()) {
            echo "Post created successfully!";
        } else {
            echo "Error creating post.";
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>