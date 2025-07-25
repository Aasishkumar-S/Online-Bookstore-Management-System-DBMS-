<?php 
include 'db_config.php'; 
$sql = "SELECT books.*, customers.name AS customer_name FROM books LEFT JOIN 
customers ON books.customer_id = customers.id"; 
$result = $conn->query($sql); 
$books = []; 
while ($row = $result->fetch_assoc()) { 
$books[] = $row; 
} 
echo json_encode($books); 
$conn->close(); 
