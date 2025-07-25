<?php 
include 'db_config.php'; 
$sql = "SELECT id, name FROM customers ORDER BY name"; 
$result = $conn->query($sql); 
$customers = []; 
if ($result->num_rows > 0) { 
while($row = $result->fetch_assoc()) { 
$customers[] = $row; 
} 
} 
echo json_encode($customers); 
$conn->close(); 
?> 
