<?php

use Classes\Product;
use Classes\ProductManager;

include_once 'ProductManager.class.php';
include_once 'Product.class.php';

$data = array(
'name' => 'Sofa',
'price' => 500,
'description' => 'Ce meuble en bois de chêne est un sofa d\'exception',
'picture' =>'03_Nille.jpg'
);

$name= $data['name'];
$price = $data['price'];
$description= $data['description'];
$picture = $data['picture'];

$connect = new Classes\Connect();
$product = new Classes\Product($data);
$productManager = new Classes\ProductManager($connect->getBdd());

$productManager->addProduct($product);