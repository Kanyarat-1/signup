<?php
require "connect.php";

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    echo json_encode(["error" => "Connection error"]);
    exit();
}

// รับค่า id จาก GET parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ปรับ SQL query ให้ใช้ id
$sql = "SELECT * FROM ckeditor WHERE id = ?";
$stmt = $conn->prepare($sql);

// ตรวจสอบการเตรียม statement
if (!$stmt) {
    echo json_encode(["error" => "Statement preparation failed"]);
    exit();
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
    // ดึงข้อมูล
    $data = $result->fetch_assoc();
    
    // เพิ่ม imageUrl สำหรับ Get รูปภาพ
    $imageUrl = "http://192.168.217.28/signup/upload/";
    if (isset($data['image']) && !empty($data['image'])) {
        $data['image'] = $imageUrl . $data['image'];
    }
    // แสดงข้อมูลในรูปแบบ JSON
    echo json_encode($data);
} else {
    // แสดงข้อความถ้าไม่มีข้อมูล
    echo json_encode(["message" => "No data found for this ID"]);
}

$stmt->close();
$conn->close();
?>