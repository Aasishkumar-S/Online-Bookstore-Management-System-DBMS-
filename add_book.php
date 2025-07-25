<?php 
include 'db_config.php'; 
header('Content-Type: application/json'); 
$data = json_decode(file_get_contents("php://input"), true); 
if (!$data) { 
echo json_encode(['success' => false, 'message' => 'Invalid JSON input.']); 
exit; 
} 
$title = trim($data['title'] ?? ''); 
$author = trim($data['author'] ?? ''); 
$genre = trim($data['genre'] ?? ''); 
$isbn = trim($data['isbn'] ?? ''); 
$price = floatval($data['price'] ?? 0); 
$stock = intval($data['stock'] ?? 0); 
$customer_id = intval($data['customer_id'] ?? 0); 
if ($title === '' || $author === '' || $genre === '' || $isbn === '' || $price <= 0 || $stock < 0 || 
$customer_id <= 0) { 
echo json_encode(['success' => false, 'message' => 'Missing or invalid fields.']); 
exit; 
} 
$sql = "INSERT INTO books (title, author, genre, isbn, price, stock, customer_id) VALUES 
(?, ?, ?, ?, ?, ?, ?)"; 
$stmt = $conn->prepare($sql); 
if (!$stmt) { 
echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]); 
exit; 
} 
$stmt->bind_param("ssssdii", $title, $author, $genre, $isbn, $price, $stock, $customer_id); 
if ($stmt->execute()) { 
echo json_encode(['success' => true, 'message' => 'Book added successfully.']); 
} else { 
echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]); 
} 
$stmt->close(); 
$conn->close(); 
?> 
