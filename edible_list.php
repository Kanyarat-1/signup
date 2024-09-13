<?php
include_once 'connect.php';

// Check the connection
if (!$conn) {
    echo json_encode(["error" => "Connection error"]);
    exit();
}

$result = $conn->query("SELECT mush_id,mush_name,image FROM mushroom WHERE cate_id = 3");

$list = array();
if ($result) {
    while($row = mysqli_fetch_assoc($result)){
        $list[] = $row;
    }
    echo json_encode($list);
} else {
    echo json_encode(["error" => "Query failed"]);
}

// Close the connection
$conn->close();
?>

