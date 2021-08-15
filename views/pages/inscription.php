<body id="inscription">
	<h1 >Inscription</h1>
    <!-- Conditions retour d'erreurs -->
    <?php if (isset($user)) : ?>
        <?php if ($user->hasErrors()) : ?>
            <?php foreach ($user->getErrors("general") as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Account created succesfully!</p>
            <?php unset($user); ?>
        <?php endif ?>
    <?php endif ?>
	<?php include_once(FORMS.'/signup.php'); ?>
</body>
