<?php
session_start();
include 'config.php';

// Fetch posts with user details
$stmt = $conn->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your existing head content -->
</head>
<body>
    <div class="fullpage">
        <!-- Your existing HTML content -->

        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h3><?php echo htmlspecialchars($post['username']); ?></h3>
                <p><?php echo htmlspecialchars($post['content']); ?></p>
                <?php if ($post['image']): ?>
                    <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <!-- Your existing HTML content -->
    </div>
</body>
</html>