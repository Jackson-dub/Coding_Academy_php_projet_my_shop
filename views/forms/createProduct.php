<?php
/*
 * PRODUCT FORM USED FOR ADD AND EDIT PRODUCT
 */
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
	
<div class="flexContainer productWrapper">
		<div class="flexContainer">
			<label for="name">Product name</label>
			<input type="text" name="name" />
		</div>
		<div class="flexContainer">
			<label for="description">Product description</label>
			<textarea type="textarea" name="description"></textarea>
		</div>
		<div class="flexContainer">
			<label for="price">Product price</label>
			<input type="text" name="price" />
		</div>
		<div class="flexContainer">
			<label for="picture">Product picture</label>
			<input type="file" name="picture"/>
		</div>
        <div class="flexContainer">
			<input type="hidden" name="id" value="0"/>
		</div>
		<div class="flexContainer deleteButton">
			<button type="submit" value="Add propduct">Add product product</button>
			<button><a href="<?php echo $_SESSION['source']; ?>">Cancel</a></button>
		</div>
</div>
</form>
