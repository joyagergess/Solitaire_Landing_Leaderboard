<?php
include 'connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'] ?? '';

if (!$name) {
     $response = [
        "success" => false,
        "message" => "Enter your name"
    ];
    echo json_encode($response);   
     exit;
}

$sql = "SELECT * FROM leaderboard WHERE name = ?";
$query = $connection->prepare($sql);
$query->bind_param("s", $name);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
     $response = [
        "success" => false,
        "message" => "Name already exists , try another one"
    ];
    echo json_encode($response);  
      exit;
}

$score = rand(0, 1000);
$duration = rand(30, 300);

$sql = "INSERT INTO leaderboard (name, score, duration) VALUES (?, ?, ?)";
$query = $connection->prepare($sql);
$query->bind_param("sii", $name, $score, $duration);

if ($query->execute()) {
$response = [
        "success" => true,
        "message" => "Score is added"
    ];
    echo json_encode($response);
} 
    
 else {
      $response = [
        "success" => false,
        "message" => "Failed to add the score"
       ];
     echo json_encode($response);}
?>
