<body>
	<h1>Attention, vous êtes sur le point de supprimer un produit</h1>
	<p>Êtes-vous sur de vouloir effacer le produit suivant:</p>
	<?php if ($productToDelete->getPicture()): ?>
		<img src="<?php echo $productToDelete->getPicture(); ?>" alt="product_picture" />
	<?php endif; ?>
	<ul>
		<li>Id: <?php echo $productToDelete->getId(); ?></li>
		<li>Name: <?php echo $productToDelete->getName(); ?></li>
		<li>Description: <?php echo $productToDelete->getDescription(); ?></li>
		<li>Price: <?php echo $productToDelete->getPrice(); ?>€</li>
	</ul>

	<a href="<?php echo $_SESSION['source']; ?>">Annuler</a>
	<a href="deleteProduct.php?confirm=true&product=<?php echo $productToDelete->getId(); ?>">Confirmer la suppression</a>
	
</body>
