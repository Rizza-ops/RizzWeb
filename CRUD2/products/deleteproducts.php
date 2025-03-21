<?php
include '../config.php';
$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: tabelproducts.php");
?>
