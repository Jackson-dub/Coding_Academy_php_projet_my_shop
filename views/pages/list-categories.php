<?php
/*
 * List Categories display all categories in admin page for CRUD
 */

?>

<body class="listCategories">
	<a href="createCategory.php">Add a new category</a>
	<?php if (empty($categories)): ?>
		<p>No categories founded</p>
	<?php else: ?>
	<?php include_once(FORMS."/editCategories.php");?>
	<?php endif; ?>
</body>
