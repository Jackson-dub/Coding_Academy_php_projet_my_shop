
<?php include_once '../../bootstrap.php'; ?>
<body>
      <div id='logstatus' class='flexContainer'> 
        <?php if (isset($_GET['error']) && $_GET['error'] == ADMIN_FORBIDDEN) : ?>
            <h2>You need to be admin to go to admin page</h2>
        <?php endif; ?>

        <?php if (isset($user)) : ?>
            <p id='greetings'>Hello <?php echo $user->getUsername(); ?></p>
        <?php else : ?>
            <p id='loggedin'>You are not loggedin</p>
        <?php endif; ?>
      </div>

        <section>
            <div class="container">

                <div class="flexContainer" id="articleWrapper">
                    <div class="flexContainer" id="dropDownMenu">
                        <div id="filtersMobile">
                            <div>Filters</div>
                            <div id="arrow"><img src="../html-css/Images/down-arrow.svg" alt="Menu Deroulant" title="Menu Deroulant"></div>
                        </div>
                        <h4>FILTER BY</h4>
                        <ul id=ul2>
                            <li>Collection <div class="arrow"><img src="../html-css/Images/down-arrow.svg" alt="Menu Deroulant" title="Menu Deroulant"></div>
                            </li>
                            <li>Color <div class="arrow"><img src="../html-css/Images/down-arrow.svg" alt="Menu Deroulant" title="Menu Deroulant"></div>
                            </li>
                            <li>Category <div class="arrow"><img src="../html-css/Images/down-arrow.svg" alt="Menu Deroulant" title="Menu Deroulant"></div>
                            </li>
                        </ul>
                        <div id="priceRange">
                            <span>Price Range</span>
                            <div class="middle">
                                <div class="multi-range-slider">
                                    <input type="range" id="input-left" min="0" max="100" value="0">
                                    <input type="range" id="input-right" min="0" max="100" value="100">

                                    <div class="slider">
                                        <div class="track"></div>
                                        <div class="range"></div>
                                        <div class="thumb left"></div>
                                        <div class="thumb right"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="price">
                                <div id="left">$0</div>
                                <div id="right">$10,000+</div>
                            </div>
                        </div>
                    </div>
                    <?php

                    /*
                *DISPLAY ARTICLES
                */
            
                    foreach ($products as $product) {
                        $picture = $product->picture;
                        $id = $product->id;
                        $name = $product->name;
                        $description = $product->description;
                        $price = $product->price;
                        include(LAYOUT . '/article.php');
                    }

                    ?>
                </div>

                    <?php

                    $connect = new Classes\Connect();
                    $productManager = new Classes\ProductManager($connect->getBdd());
                    $allProduct = $productManager->getAllProducts();

                    Pagin($allProduct);

                    ?>
            </div>
        </section>
</body>
