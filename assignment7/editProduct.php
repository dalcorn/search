<?php
include('includes/common.inc.php');

$id = (int)$_REQUEST['id'];
if($id) {
    $q = $conn->query("SELECT * FROM products2 WHERE id=$id");
    $product = $q->fetch(PDO::FETCH_ASSOC);
    $q->closeCursor();
    $q = null;
}
else {
    $product = array();
}

if($_POST['submit']) {
    if($product['id']) {
        $sql = "UPDATE products2 SET sku=?, name=?, price=? WHERE id=$product[id]";
    }
    else {
        $sql = "INSERT INTO products2(sku, name, price) VALUES(?, ?, ?)";
    }
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute(array($_POST['sku'], $_POST['name'], $_POST['price']));

        if(!$product['id']) {
            $product['id'] = $conn->lastInsertId();
        }

        $uploadOK = $_FILES['product']['error'] == 0 && is_uploaded_file($_FILES['product']['tmp_name']);
        if ($uploadOK) {
            $stmt = $conn->prepare("UPDATE products2 SET imgtype=?, image=? WHERE id=$product[id]");
            $image = fopen($_FILES['product']['tmp_name'], 'rb');
            $stmt->bindParam(1, $_FILES['product']['type']);
            $stmt->bindParam(2, $image, PDO::PARAM_LOB);
            $stmt->execute();
        }

        header("Location: products.php");
        exit;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }

} else if ($_POST['cancel']) {
    header("Location: products.php");
    exit;
} else {
    $_POST = $product;
}

showHeader('Edit Product');
?>

<form action="" method="post" enctype="multipart/form-data">
    <table border="1" cellpadding="3">
        <tr>
            <td>SKU</td>
            <td>
                <input type="text" name="sku" value="<?php echo htmlspecialchars($_POST['sku']) ?>">
            </td>
        </tr>
        <tr>
            <td>Name</td>
            <td>
                <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name']) ?>">
            </td>
        </tr>
        <tr>
            <td>Price</td>
            <td>
                <input type="text" name="price" value="<?php echo htmlspecialchars($_POST['price'])?>">
            </td>
        </tr>
        <tr>
            <td>Product Image</td>
            <td><input type="file" name="product"></td>
        </tr>
        <?php if($product['imgtype']) { ?>
        <tr>
            <td>Current Image</td>
            <td><img src="showImage.php?product=<?php echo $product['id']?>"></td>
        </tr>
            <?php } ?>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" value="Save">
                <input type="submit" name="cancel" value="Cancel">
            </td>
        </tr>
    </table>
    <?php if($product['id']) { ?>
    <input type="hidden" name="id" value="<?php echo $product['id']?>">
        <?php } ?>
</form>
<?php
showFooter();
?>
