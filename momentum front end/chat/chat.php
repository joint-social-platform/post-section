<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat_app";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Function to get user data
function get_user_data($user_id) {
  global $conn;
  $query = "SELECT * FROM users WHERE id = '$user_id'";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return null;
  }
}

// Function to get messages
function get_messages($sender_id, $receiver_id) {
  global $conn;
  $query = "SELECT * FROM messages WHERE (sender_id = '$sender_id' AND receiver_id = '$receiver_id') OR (sender_id = '$receiver_id' AND receiver_id = '$sender_id') ORDER BY timestamp ASC";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    return $result->fetch_all(MYSQLI_ASSOC);
  } else {
    return array();
  }
}

// Function to send message
function send_message($sender_id, $receiver_id, $message) {
  global $conn;
  $query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$sender_id', '$receiver_id', '$message')";
  if ($conn->query($query) === TRUE) {
    return true;
  } else {
    return false;
  }
}

// Function to get group data
function get_group_data($group_id) {
  global $conn;
  $query = "SELECT * FROM groups WHERE id = '$group_id'";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return null;
  }
}

// Function to get group messages
function get_group_messages($group_id) {
  global $conn;
  $query = "SELECT * FROM group_messages WHERE group_id = '$group_id' ORDER BY timestamp ASC";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    return $result->fetch_all(MYSQLI_ASSOC);
  } else {
    return array();
  }
}

// Function to send group message
function send_group_message($group_id, $sender_id, $message) {
  global $conn;
  $query = "INSERT INTO group_messages (group_id, sender_id, message) VALUES ('$group_id', '$sender_id', '$message')";
  if ($conn->query($query) === TRUE) {
    return true;
  } else {
    return false;
  }
}

// Close database connection
$conn->close();
?>

