<?php
require "connect.php";

if (!$conn) {
    echo json_encode(["error" => "Connection error"]);
    exit();
}

$sql = "SELECT id,main_topic, subtopic FROM ckeditor";
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
    // สร้างอาร์เรย์เพื่อเก็บข้อมูล
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row; // เพิ่มข้อมูลในอาร์เรย์
    }
    // แสดงข้อมูลในรูปแบบ JSON
    echo json_encode($data);
} else {
    // แสดงข้อความถ้าไม่มีข้อมูล
    echo json_encode(["message" => "No data"]);
}

$conn->close();
?>
