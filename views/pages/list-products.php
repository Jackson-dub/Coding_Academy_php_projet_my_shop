<?php
include_once '../../bootstrap.php';
/*
 * List Users display all users in admin page for CRUD
 */

?>

<body id = "products">
	<h1>List of products</h1>
	<button><a href="createProduct.php">Add a new product</a></button>
<?php foreach($products as $product): ?>
	<div class="grid-container<?php echo $id % 2 ? ' greyed' : ''; ?>">
		<div class="flexContainer adminWrapper">
			<div class="producId flexContainer">
				<?php echo '<div class="title">Product id</div><div>'.$product->id."</div>"; ?>
			</div>
			<figure>
				<img src="<?php echo $product->picture; ?>" alt="picture" height=120px width=120px />
			</figure>
			<div class="productName flexContainer">
				<?php echo '<div class="title">Product name</div><div>'.$product->name."</div>";?>
			</div>
			<div class="productDescription flexContainer">
				<?php echo '<div class="title">Product description</div><div>'.$product->description."</div>";?>
			</div>
			<div class="buttons flexContainer">
				<button><a href="editProduct.php?product=<?php echo $product->id; ?>">Edit</a></button>
			
				<button><a href="deleteProduct.php?product=<?php echo $product->id; ?>">Delete</a></button>
			</div>
		</div>
	</div>
<?php endforeach; ?>


<?php 

$connect = new Classes\Connect();
$productManager = new Classes\ProductManager($connect->getBdd());
$listProducts = $productManager->getAllProducts();
Pagin($listProducts); 
?>


<body>
