<?php
session_start();

include_once 'bootstrap.php';

$data = array(
	'page'	=>	'singlearticle',
	'title'	=>	'Products',
	'description'	=>	'Here you can connect to your account',
	'keywords'		=>	'connexion user shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);



//SI LE FORMULAIRE A ETE ENVOYE
 if (isset($_GET) && !empty($_GET)) {
	 $id = $_GET['product'];
     $connect = new Classes\Connect();
    $productManager = new Classes\ProductManager($connect->getBdd());
	 $product= $productManager->getById($id);
  	
 }

$obj = array (
	'user'		=> serialize($user),
	'product' 	=> serialize($product)
);

 try {
	$page = new Classes\Controller($data);
	echo $page->getPage($obj);
} catch (Exception $e) {
	echo $e->getMessage();
}
?>
