<?php
/*
 * PRODUCT FORM USED FOR ADD AND EDIT PRODUCT
 */
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
	<?php if (isset($product)) : ?>
		<div class="flexContainer productWrapper">
			<img src="<?php echo $product->getPicture(); ?>" alt="image du produit" height=500px width=500px />
		<?php endif; ?>
		<input type="hidden" name="id" value="<?php echo $product->getId(); ?>" />
		<div class="flexContainer">
			<label for="name">Product name</label>
			<input type="text" name="name" value="<?php echo $product->getName(); ?>" />
		</div>
		<div class="flexContainer">
			<label for="description">Product description</label>
			<textarea type="textarea" name="description" value="<?php echo $product->getDescription(); ?>"><?php echo $product->getDescription(); ?></textarea>
		</div>
		<div class="flexContainer">
			<label for="price">Product price</label>
			<input type="text" name="price" value="<?php echo $product->getPrice(); ?>" />
		</div>
		<div class="flexContainer">
			<label for="picture">Product picture</label>
			<input type="file" name="picture" value="<?php echo $product->getPicture(); ?>" accept="image/*" />
		</div>
		<div class="flexContainer deleteButton">
			<button type="submit" value="Modify product">Modify product</button>
			<button><a href="<?php echo $_SESSION['source']; ?>">Cancel</a></button>
		</div>
		</div>
</form>
