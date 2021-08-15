<?php

include_once 'bootstrap.php';

$data = array(
	'page'	=>	'Admin',
	'title'	=>	'Administrator page',
	'description'	=>	'Here you can manage users profiles and product files',
	'keywords'		=>	'create manage and delete products and users',
	'baseDir'		=> dirname(__FILE__)
);

if (!isset($user)) {
	header('location:index.php');
}

if (!$user->isAdmin())
	header('Location:index.php?error=' . ADMIN_FORBIDDEN);

$obj = ['user' => serialize($user)];

try {
	$page = new Classes\Controller($data);
	echo $page->getPage($obj);
} catch (Exception $e) {
	echo $e->getMessage();
}
