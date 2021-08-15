<?php
/*
 * FORM FOR EDITING USERS IN LIST
 */
?>
<form id ="userForm" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
<?php $i = 0; ?>
<?php foreach($users as $currentUser) : ?>
		<div <?php //echo $currentUser->id % 2 ? ' greyed' : '';class="grid-container ?>>
		<div class="flexContainer adminWrapper">
			<div class="flexContainer UserId">
				<label for="id">Id</label>
				<p><?php echo $currentUser->id; ?></p>
				<input type="hidden" name="id_<?php echo $i; ?>" value="<?php echo $currentUser->id; ?>" />
				
			</div>
			<div class="flexContainer">
				<label for="username">Username</label>
				<input type="text" name="username_<?php echo $i; ?>" value="<?php echo $currentUser->username ?>"/>
			</div>
			<div class="flexContainer">
				<label for="email">Email</label>
				<input type="text" name="email_<?php echo $i; ?>" value = "<?php echo $currentUser->email ?>"/>
			</div>
			<div class="flexContainer isAdmin">
				<label for="admin">Admin ?</label>
				<input type="checkbox" name="admin_<?php echo $i; ?>" <?php if($currentUser->admin){echo "checked";}?>/>
			</div>
			<div class="flexContainer deleteButton">
				<?php if ($user->getId() != $currentUser->id) :?>
				<button><a href="deleteUser.php?user=<?php echo $currentUser->id; ?>">Delete this user</a></button>
				<?php else: ?>
				<p>Your account</p>
				<?php endif; ?>
				<button type="submit" id="submit" >Save changes</button>
			</div>
		</div>			
		
	<?php $i++; ?>
<?php endforeach;  ?>
		<input type="hidden" name="user_count" value="<?php echo $i; ?>" />
</div>
</form>
<?php 

$connect = new Classes\Connect();
$userManager = new Classes\UserManager($connect->getBdd());
$totalUsers = $userManager->getAllUsers();
		Pagin($totalUsers);
?>
