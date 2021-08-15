<?php if (isset($_SESSION['info']) && !empty($_SESSION['info'])) : ?>
	<ul class="information_message">
		<?php foreach($_SESSION['info'] as $info) : ?>
			<li class="message"><?php echo $info; ?></li>
		<?php endforeach; ?>
	</ul>
<?php $_SESSION['info'] = []; ?>
<?php endif; ?>
