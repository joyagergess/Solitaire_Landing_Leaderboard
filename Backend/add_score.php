<?php
include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'] ?? '';

if (!$name) {
    echo "Name is required";
    exit;
}

$sql = "SELECT * FROM leaderboard WHERE name = ?";
$query = $connection->prepare($sql);
$query->bind_param("s", $name);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    echo "Name already exists";
    exit;
}

$score = rand(0, 1000);
$duration = rand(30, 300);

$sql = "INSERT INTO leaderboard (name, score, duration) VALUES (?, ?, ?)";
$query = $connection->prepare($sql);
$query->bind_param("sii", $name, $score, $duration);

if ($query->execute()) {
    echo "Score added successfully";
} else {
    echo "Failed to add the score";
}
?>
