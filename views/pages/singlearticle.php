<?php
 $picture = $product->getPicture();
 $id = $product->getId();
 $name = $product->getName();
 $description = $product->getDescription();
 $price = $product->getPrice();

?>

<body>
    <h1><?php echo $name ?></h1>
    <?php include_once(LAYOUT.'/single-product.php'); ?>
</body>
