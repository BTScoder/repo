<?php

$conn = mysqli_connect("localhost","chidinma","hanjisung2","SocialMedia");
if(!$conn) {
  echo "Connection not successful".mysqli_connect_error($conn);
}

$sql = "CREATE TABLE IF NOT EXISTS Users (
  Id INT PRIMARY KEY AUTO_INCREMENT,
  Email VARCHAR(255),
  Username VARCHAR(255),
  Password VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) 
  ";
  
  $stmt = mysqli_prepare($conn,$sql);
  mysqli_stmt_execute($stmt);
  
  $post_Table = "CREATE TABLE IF NOT EXISTS Posts (
  Id INT PRIMARY KEY AUTO_INCREMENT,
  post_author VARCHAR(255),
  post VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  user_id INT,
  FOREIGN KEY (user_id) REFERENCES Users(Id) ON DELETE CASCADE
  )
  ";
  
  $stmt = mysqli_prepare($conn,$post_Table);
  mysqli_stmt_execute($stmt);