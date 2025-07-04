<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);
$code = $data['code'];

if ($code !== 'CNTEMAD2024') {
  echo "Code étudiant invalide.";
  exit;
}

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);
if ($stmt->execute()) {
  echo "Inscription réussie !";
} else {
  echo "Nom d'utilisateur déjà utilisé.";
}
?>