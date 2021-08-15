
    <form class="flexContainer" id="search" action="/search-results.php">
        <button type="submit" class="flexContainer" id="loupe"><img src="../html-css/Images/Search.png" title="Recherche"></button>
        <div class="flexContainer" id="searchContainer">
           
            <input type="text" placeholder="living room" name="search">
            <div id="autoComp"></div>
           
            <div id="credit"><span>Powered by Algolia</span><img src="../html-css/Images/Sajari-Logo.png" alt="Sajari"
                    title="Sajari"></div>
        </div>
        <div class="flexContainer" id="sort">
            <div id="match">Best match</div>
            <div class="arrow"><img src="../html-css/Images/down-arrow.svg" alt="Menu Deroulant" title="Menu Deroulant"></div>
        </div>
    </form>