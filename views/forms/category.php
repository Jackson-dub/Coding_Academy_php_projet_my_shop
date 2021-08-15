<?php
/*
 * CATEGORY FORM USED FOR ADD AND EDIT CATEGORY
 */
?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
	<div>
		<label for="name">Category name</label>
		<input type="text" name="name" value="<?php echo isset($category) ? $category->getName() : ''; ?>" />
	</div>
	<div>
		<label for="parent">Parent Category</label>
		<select name="parent">
			<option value="0">No parent category</option>
			<?php foreach($allCategories as $current): ?>
				<?php if (isset($category) && $current['id'] == $category->getId()) {continue;} ?>
				<option value="<?php echo $current['id']; ?>"><?php echo $current['name']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<input type="submit" value="Save" />
	<a href="<?php echo $_SESSION['source']; ?>">Cancel</a>
</form>

