<?php
include("includes/common.inc.php");
showHeader("Products");
$sql = "SELECT id, sku, name, price, imgtype FROM products2 ORDER BY price";
$q = $conn->query($sql);
?>
<table width="100%" border="1" cellpadding="3">
    <tr style="font-weight: bold">
        <td>Image</td>
        <td>Product</td>
        <td>Name</td>
        <td>Price</td>
        <td></td>
    </tr>
    <?php
    while($r = $q->fetch(PDO::FETCH_ASSOC)) {
        ?>
    <tr>
        <td>
            <?php if ($r['imgtype']) {?>
            <img src="showImage.php?product=<?php echo $r['id']?>">
            <?php } else { ?>
            <img src="images/no_img.gif">
            <?php }?>
        </td>
        <td><?php echo htmlspecialchars($r['sku']) ?></td>
        <td><?php echo htmlspecialchars($r['name']) ?></td>
        <td><?php echo htmlspecialchars($r['price']) ?></td>
        <td>
            <a href="editProduct.php?id=<?php echo $r['id'] ?>">Edit</a>
            <br>
            <a href="delProduct.php?id=<?php echo $r['id'] ?>">Delete</a>
        </td>

    </tr>
        <?php
    }
    ?>
</table>
<a href="editProduct.php">Add Product</a>
<?php showFooter() ?>