<?php
include 'components/pdo.php';

$sql = "DELETE FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);

$id = 3; // change this to the id you want to delete

$stmt->execute([$id]);

echo "Deleted rows: " . $stmt->rowCount();

?>