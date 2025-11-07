<?php
include 'connection.php'; 

$sql = "SELECT * FROM leaderboard ORDER BY score DESC, duration ASC";
$query = $connection->prepare($sql);

$query->execute();

$result = $query->get_result();

$response = [];

while ($player = $result->fetch_assoc()) {
    $response[] = $player;
}

echo json_encode($response);
?>
