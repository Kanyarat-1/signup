<?php
require "connect.php";

if ($conn->connect_error) {
    echo json_encode("connection error");
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user_app WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode("SQL prepare error");
    exit;
}

$stmt->bind_param("ss", $username, $password);

$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    echo json_encode("Success");
} else {
    echo json_encode("Error");
}

$stmt->close();
$conn->close();
?>

