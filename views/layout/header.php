<?php
/*
 * FILE THAT CONTAINS THE HEADER OF WEBSITE
 */
?>

<header class="flexContainer">
	<nav class="flexContainer">
		<?php if (!isset($user) || $user->hasErrors()) : ?>
			<div id="LogoWrapper" class="flexContainer">
                <div id="logo"><a href="/index.php" title="Home"><img src="../html-css/Images/Logo.png" alt="Logo" title="Logo"></a></div>
				<ul id='ul1'>
					<li><a href="/signin.php">SIGN IN</a></li>
					<li><a href="/signup.php">SIGN UP</a></li>
					<li><a href="/index.php">HOME</a></li>
				</ul>
			</div>
		<?php else : ?>
			<div id="LogoWrapper" class="flexContainer">
                <div id="logo"><a href="/index.php" title="Home"><img src="../html-css/Images/Logo.png" alt="Logo" title="Logo"></a></div>
			<ul id='ul1'>
				<?php if($user->isAdmin()){?>
				<li><a href="/admin.php">ADMIN</a></li>
				<?php }?>
				<li><a href="/index.php">HOME</a></li>
			</ul>
			</div>
			<ul id=logout>
			<a id="logout" href="logout.php">Log out</a>
			</ul>
		<?php endif; ?>
	</nav>
</header>
<?php
include_once('search.php');
?>
