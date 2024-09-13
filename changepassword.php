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
$user_id = $_POST['user_id'];
$new_password = $_POST['new_password'];

// Update the password in the database without hashing
$sql = "UPDATE user_app SET password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $new_password, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "เปลี่ยนชื่อผู้ใช้สำเร็จ"]);
} else {
    echo json_encode(["success" => false, "message" => "เปลี่ยนชื่อผู้ใช้ไม่สำเร็จ"]);
}

$stmt->close();
$conn->close();
?>