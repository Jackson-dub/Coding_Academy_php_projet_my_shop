<?php

include_once 'bootstrap.php';

$pageInfo = array(
	'page'	=>	'deleteConfirmation',
	'title'	=>	'Confirm delete',
	'description'	=>	'Mon super site de shop en ligne',
	'keywords'		=>	'shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);

if(!isset($user)){
	header('location:index.php');
}

if (!$user->isAdmin())
  header('Location:index.php?error='.ADMIN_FORBIDDEN);

if (!isset($_GET['user']))
	header('Location: index.php');

$connect = new Classes\Connect();
$userManager = new Classes\UserManager($connect->getBdd());

if ( !($userToDelete = $userManager->getUserById($_GET['user'])) ) {
	$_SESSION['info'][] = "L'utilisateur que vous voulez supprimer n'existe pas.";
	header('Location: index.php');
} else if ($userToDelete == $user) {
	$_SESSION['info'][] = "Impossible de supprimer votre compte";
	header('Location: index.php');
} else if ($_GET['confirm'] == true) {
	$_SESSION['info'][] = "L'utilisateur ".$userToDelete->getUsername()." a bien été supprimé.";
	$userManager->delete($userToDelete->getId());
	header('Location: listUsers.php');
}

$obj = array(
	'userToDelete' => serialize($userToDelete)
);

try {
	$page = new Classes\Controller($pageInfo);
	echo $page->getPage($obj);
} catch (Exception $e) {
	echo $e->getMessage();
}
?>
