<?php
require 'db.php';
session_start();

$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = $data['password'];

$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
  $stmt->bind_result($id, $hashed);
  $stmt->fetch();
  if (password_verify($password, $hashed)) {
    $_SESSION['user_id'] = $id;
    echo "success";
    exit;
  }
}
echo "fail";
?>