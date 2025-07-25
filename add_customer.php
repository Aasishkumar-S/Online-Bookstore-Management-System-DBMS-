<?php 
include 'db_config.php'; 
$data = json_decode(file_get_contents("php://input"), true); 
if (!isset($data['name'], $data['email'], $data['phone'])) { 
echo json_encode(['success' => false, 'message' => 'Missing required fields.']); 
exit; 
} 
$name = $data['name']; 
$email = $data['email']; 
8 
$phone = $data['phone']; 
$sql = "INSERT INTO customers (name, email, phone) VALUES (?, ?, ?)"; 
$stmt = $conn->prepare($sql); 
if ($stmt === false) { 
echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]); 
exit; 
} 
$stmt->bind_param("sss", $name, $email, $phone); 
if ($stmt->execute()) { 
echo json_encode(['success' => true, 'message' => 'Customer added successfully.']); 
} else { 
echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]); 
} 
$stmt->close(); 
$conn->close(); 
?> 
