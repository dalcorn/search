<?php
include('includes/common.inc.php');

$id = (int)$_GET['id'];

if($id) {
    $sql = "DELETE from products2 WHERE id=$id";
    try {
        $stmt = $conn->exec($sql);
        header("Location: products.php");
        exit;
    }
    catch(PDOException $e) {
    }
}
?>
