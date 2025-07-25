<?php 
include 'db_config.php'; 
header('Content-Type: application/json'); 
$data = json_decode(file_get_contents("php://input"), true); 
if (!$data) { 
echo json_encode(['success' => false, 'message' => 'Invalid JSON input.']); 
exit; 
} 
$id = intval($data['id'] ?? 0); 
$title = trim($data['title'] ?? ''); 
$author = trim($data['author'] ?? ''); 
$genre = trim($data['genre'] ?? ''); 
$isbn = trim($data['isbn'] ?? ''); 
$price = floatval($data['price'] ?? 0); 
10 
$stock = intval($data['stock'] ?? 0); 
$customer_id = intval($data['customer_id'] ?? 0); 
if ($id <= 0 || empty($title) || empty($author) || empty($genre) || empty($isbn) || $price 
<= 0 || $stock < 0 || $customer_id <= 0) { 
echo json_encode(['success' => false, 'message' => 'Missing or invalid fields.']); 
exit; 
} 
$sql = "UPDATE books SET title = ?, author = ?, genre = ?, isbn = ?, price = ?, stock 
= ?, customer_id = ? WHERE id = ?"; 
$stmt = $conn->prepare($sql); 
if (!$stmt) { 
echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn
>error]); 
exit; 
} 
$stmt->bind_param("ssssdiii", $title, $author, $genre, $isbn, $price, $stock, 
$customer_id, $id); 
if ($stmt->execute()) { 
echo json_encode(['success' => true, 'message' => 'Book updated successfully.']); 
} else { 
echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt
>error]); 
} 
$stmt->close(); 
$conn->close(); 
?> 
