<?php
require "connect.php";

if (!$conn) {
    echo json_encode(['error' => 'Connection error']);
    exit();
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$Email = $_POST['Email'] ?? '';


$sql = "INSERT INTO user_app (username, password, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $password, $Email);

$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => 'Login successful']);
} else {
    echo json_encode(['error' => 'Invalid username or password']);
}

$stmt->close();
$conn->close();
?>
