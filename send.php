<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) exit;

$content = $_POST['message'] ?? '';
$uid = $_SESSION['user_id'];
$group = 'groupe1';
$imagePath = null;

if (!empty($_FILES['image']['name'])) {
  $targetDir = "uploads/";
  if (!file_exists($targetDir)) mkdir($targetDir);
  $imageName = time() . "_" . basename($_FILES["image"]["name"]);
  $targetFile = $targetDir . $imageName;
  move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
  $imagePath = $targetFile;
}

$stmt = $conn->prepare("INSERT INTO messages (user_id, group_name, content, image_path) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $uid, $group, $content, $imagePath);
$stmt->execute();
?>