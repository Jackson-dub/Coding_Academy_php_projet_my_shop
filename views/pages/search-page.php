
<body id="searchPage">
    <main>
        <section>

             <?php 
             if($searchResult){
                foreach($searchResult as $result){

                    $name = $result['name'];
                    $price = $result['price'];
                    $picture = $result['picture'];
                    $category = $result['category'];
                    $description = $result['description'];
            ?>

            <a href="/view-product.php/?product=<?php echo $result['id'];?>">
            <div class="flexContainer" id="productContainer">
                <figure><img src="../html-css/Images/<?php echo $picture ?>" alt="<?php echo $name ?>"></figure>
                <div class="productDetail">
                    <div>
                        <h3><?php echo $name ?></h3>
                        <h4><?php echo $category ?></h4>
                        <p id="description"><?php echo $description ?></p>
                    </div>
                    <div id="detailProd">
                        <div id="price"><?php echo "$ ".$price ?></div>
                        <div id="review"></div>
                    </div>
                </div>
            </div>
            </a>

            <?php } 
             }else{
                 echo "<div class='flexContainer' id='noResults'>No results have been found for your search. Please try again with a valid string.";
             }
            
            Pagin($searchResult);
            
            ?>



        </section>
    </main>
</body>