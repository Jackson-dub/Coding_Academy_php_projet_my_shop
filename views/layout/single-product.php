<section id ="sectionsingle">
        <div class="singleArticle">
            <figure><img src="<?php echo "../".$picture?>" alt="<?php echo $name ?>" title="<?php echo $name ?>">
            </figure>
            <div id="details">
                <h3><?php echo $name?></h3>
                <h3>Catégorie</h3>
                <p><?php echo "$ ".$price ?></p>
                <h2>Description du produit</h2>
                <p id="description"><?php echo $description ?></p> 
            </div>
        </div>
        <div class="flexContainer" id="singleArticleWrapper">
            <div class="flexContainer" id="singleDropDownMenu">

                <h3><?php echo $name ?></h3>
                <div class="flexContainer d2">
                   
                        <div class="cat"><a href="#details">Details</a></div>
                        <div class="stars">
                            <span class="star checked"><img src="../html-css/Images/Star-On.png" alt="Note valide"
                                    title="Note valide"></span>
                            <span class="star checked"><img src="../html-css/Images/Star-On.png" alt="Note valide"
                                    title="Note valide"></span>
                            <span class="star checked"><img src="../html-css/Images/Star-On.png" alt="Note valide"
                                    title="Note valide"></span>
                            <span class="star checked"><img src="../html-css/Images/Star-On.png" alt="Note valide"
                                    title="Note valide"></span>
                            <span class="star"><img src="../html-css/Images/Star.png" alt="Note vide" title="Note vide"></span>
                        </div>
                </div>
                   
                <ul id=ul2>
                    <li>Color <div class="arrow"><img src="../html-css/Images/down-arrow.svg" alt="Menu Deroulant"
                                title="Menu Deroulant"></div>
                    </li>
                    <li>Taille <div class="arrow"><img src="../html-css/Images/down-arrow.svg" alt="Menu Deroulant"
                                title="Menu Deroulant"></div>
                    </li>
                    <li>Quantité <div class="arrow"><img src="../html-css/Images/down-arrow.svg" alt="Menu Deroulant"
                                title="Menu Deroulant"></div>
                    </li>
                </ul>
            </div>
    
        </div>
    </section>