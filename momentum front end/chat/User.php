<?php
//CREATE TABLE users 
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
// CREATE TABLE messages 
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  sender_id INT NOT NULL,
  receiver_id INT NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (sender_id) REFERENCES users(id),
  FOREIGN KEY (receiver_id) REFERENCES users(id)
);
//CREATE TABLE groups 
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );
  //CREATE TABLE group_members 
  (
    id INT PRIMARY KEY AUTO_INCREMENT,
    group_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES groups(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
  );
  CREATE TABLE group_members (
  id INT PRIMARY KEY AUTO_INCREMENT,
  group_id INT NOT NULL,
  user_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (group_id) REFERENCES groups(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);
//CREATE TABLE group_messages 
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    group_id INT NOT NULL,
    sender_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_id) REFERENCES groups(id),
    FOREIGN KEY (sender_id) REFERENCES users(id)
  );
  
?>