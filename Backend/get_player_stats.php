<?php
include 'connection.php'; 

$sql = "SELECT * FROM leaderboard ORDER BY score DESC";
$res = $connection->query($sql);

$players = $res->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode($players);
?>
