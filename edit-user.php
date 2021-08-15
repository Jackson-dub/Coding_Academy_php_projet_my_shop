<?php
include_once 'bootstrap.php';

$data = array(
	'page'	=>	'Connexion',
	'title'	=>	'Sign In',
	'description'	=>	'Here you can connect to your account',
	'keywords'		=>	'connexion user shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);

//SI LE FORMULAIRE A ETE ENVOYE
if (isset($_POST) && !empty($_POST)) {
   
}


try {
	$page = new Classes\Controller($data);
	echo $page->getPage(['user' => serialize($user)]);
} catch (Exception $e) {
	echo $e->getMessage();
}