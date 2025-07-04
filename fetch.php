<?php
require 'db.php';
session_start();

$group = 'groupe1'; // à rendre dynamique plus tard
$sql = "SELECT u.username, m.content, m.image_path FROM messages m 
        JOIN users u ON m.user_id = u.id 
        WHERE group_name = ? ORDER BY m.created_at DESC LIMIT 30";

$messages = [];
while ($row = $res->fetch_assoc()) {
  $msg = $row['username'] . ' : ' . $row['content'];
  if ($row['image_path']) {
    $msg .= '<br><img src=\"' . $row['image_path'] . '\" style=\"max-width:200px\">';
  }
  $messages[] = $msg;
}
?>