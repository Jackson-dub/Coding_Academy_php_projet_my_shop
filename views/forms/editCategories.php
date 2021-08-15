<?php
/*
 * FORM FOR EDITING CATEGORIES IN LIST
 */
?>
<form id ="usersForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<?php $i = 0; ?>
<?php foreach($categories as $current) : ?>
		<div <?php //echo $current->id % 2 ? ' greyed' : '';class="grid-container ?>>
		<div class="flexContainer adminWrapper">
			<div class="flexContainer UserId">
				<label for="id">Id</label>
				<p><?php echo $current->id; ?></p>
				<input type="hidden" name="id_<?php echo $i; ?>" value="<?php echo $current->id; ?>" />
				
			</div>
			<div class="flexContainer">
				<label for="name">Name</label>
				<input type="text" name="name_<?php echo $i; ?>" value="<?php echo $current->name ?>"/>
			</div>
			<div class="flexContainer">
				<label for="parent">Parent Category</label>
				<select name="parent_<?php echo $i; ?>">
					<option value="0">No parent category</option>
					<?php foreach($allCategories as $currentOption): ?>
						<?php if ($currentOption['id'] == $current->id) {continue;} ?>
						<?php if ($currentOption['id'] == $current->parent_id): ?>
							<option selected value="<?php echo $currentOption['id']; ?>"><?php echo $currentOption['name']; ?></option>
						<?php else: ?>
							<option value="<?php echo $currentOption['id']; ?>"><?php echo $currentOption['name']; ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="flexContainer deleteButton">
				<button><a href="deleteCategory.php?cat=<?php echo $current->id; ?>">Delete this Category</a></button>
				<button type="submit" id="submit" >Save changes</button>
			</div>
		</div>			
		
	<?php $i++; ?>
<?php endforeach;  ?>
		<input type="hidden" name="cat_count" value="<?php echo $i; ?>" />
</div>
</form>
<?php 
		Pagin($users);
?>
