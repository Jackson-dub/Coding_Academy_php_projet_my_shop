<body>
	<h1>Attention, vous êtes sur le point de supprimer un utilisateur</h1>
	<p>Êtes-vous sur de vouloir effacer l'utilisateur / l'administrateur suivant:</p>
	<ul>
		<li>Id: <?php echo $userToDelete->getId(); ?></li>
		<li>Username: <?php echo $userToDelete->getUsername(); ?></li>
		<li>Email: <?php echo $userToDelete->getEmail(); ?></li>
	</ul>

	<a href="<?php echo $_SESSION['source']; ?>">Annuler</a>
	<a href="deleteUser.php?confirm=true&user=<?php echo $userToDelete->getId(); ?>">Confirmer la suppression</a>
	
</body>
