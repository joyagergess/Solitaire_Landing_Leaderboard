<?php
include 'connection.php';

function Response($success, $message) {
    echo json_encode([
        "success" => $success,
        "message" => $message
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'] ?? '';

if (!$name) {
        Response(false, "Enter your name");
}

$sql = "SELECT * FROM leaderboard WHERE name = ?";
$query = $connection->prepare($sql);
$query->bind_param("s", $name);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    Response(false, "Name already exists, try another one");
}

$score = rand(0, 1000);
$duration = rand(30, 600);

$sql = "INSERT INTO leaderboard (name, score, duration) VALUES (?, ?, ?)";
$query = $connection->prepare($sql);
$query->bind_param("sii", $name, $score, $duration);

if ($query->execute()) {
    Response(true, "Score is added");
} 
 else {
        Response(false, "Failed to add the score");
     }
?>
