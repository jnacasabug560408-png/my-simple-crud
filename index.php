<?php
include 'components/pdo.php';

$sql = "UPDATE users SET firstname = ?, lastname = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);

$newFirstname = "Dave";
$newLastname  = "Cabeza";
$id = 6; // change this to the id you want to update

$stmt->execute([$newFirstname, $newLastname, $id]);

echo "Updated rows: " . $stmt->rowCount();
?>