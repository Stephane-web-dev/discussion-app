<?php
$host = 'localhost';
$user = 'your_000webhost_username';
$pass = 'your_database_password';
$db = 'discussion_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Échec de connexion : " . $conn->connect_error);
}
?>