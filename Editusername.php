<?php

$db_name = "mydatabase";
$db_user = "root";
$db_password = "";
$db_host = "localhost";
$db_port = "3307";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name, $db_port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$user_id = $_POST['id'];
$new_username = $_POST['new_username'];

$sql = "UPDATE user_app SET username = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $new_username, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "username updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error updating username"]);
}

$stmt->close();
$conn->close();
?>