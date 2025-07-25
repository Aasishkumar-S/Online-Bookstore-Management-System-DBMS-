<?php 
include 'db_config.php'; 
$data = json_decode(file_get_contents("php://input"), true); 
if (!$data || !isset($data['id'])) { 
echo json_encode(['success' => false, 'message' => 'Invalid input']); 
exit; 
} 
$id = intval($data['id']); 
$sql = "DELETE FROM books WHERE id=?"; 
$stmt = $conn->prepare($sql); 
if (!$stmt) { 
echo json_encode(['success' => false, 'message' => 'Prepare failed']); 
exit; 
} 
$stmt->bind_param("i", $id); 
if ($stmt->execute()) { 
echo json_encode(['success' => true]); 
} else { 
echo json_encode(['success' => false, 'message' => 'Execute failed']); 
} 
$stmt->close(); 
$conn->close(); 
9 
?> 
