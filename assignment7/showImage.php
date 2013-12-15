<?php
include('includes/common.inc.php');
$id = (int)$_GET['product'];
$stmt = $conn->prepare("SELECT imgtype, image FROM products2 WHERE id=$id");
$stmt->execute();
$stmt->bindColumn(1, $mime);
$stmt->bindColumn(2, $image, PDO::PARAM_LOB);
$stmt->fetch(PDO::FETCH_BOUND);
header("Content-Type: $mime");
echo $image;
?>
