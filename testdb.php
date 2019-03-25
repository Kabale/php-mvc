<?php
    include_once './helper/DbHelper.php';
    include_once './model/Article.php';
    include_once './model/file.php';

    ob_start();

    // TEST DATABASE HELPER
    $dbHelper = new DbHelper();

    // TEST LIST ARTICLES
    echo "SHOW LIST ARTICLES<br>";
    $articles = $dbHelper->retrieveMultiple("articles");
    
    foreach ($articles as $article)
        echo $article->getid()." ".$article->getTitle()."<br>";
    
    // TEST ADD ARTICLE 
    echo "<br><br>ADD ARTICLE TOTO<br>";
    $article = new Article();
    $article->setTitle("Toto");
    $article->setContent("Contenu de l'article Toto");

    $id = $dbHelper->add($article);
    echo "L'id du dernier article est : $id<br>";

    // SHOW LAST ARTICLE
    echo "<br><br>SHOW ARTICLE WITH ID $id<br>";
    $article = $dbHelper->retrieve("articles", $id);
    
    echo "Title : ".$article->getTitle()."<br>";
    echo "Content : ".$article->getContent()."<br>";
    echo "Category : ".$article->getCategory()."<br>";
    echo "CreationDate : ".$article->getCreationDate()."<br>";
    echo "UpdateDate : ".$article->getUpdateDate()."<br>";

    // UPDATE LAST ARTICLE
    echo "<br><br>UPDATE ARTICLE<br>";
    $article->setCategory("Test");
    $dbHelper->update($article, $id);

    // SHOW LAST ARTICLE
    echo "<br><br>SHOW ARTICLE WITH ID $id<br>";
    $article = $dbHelper->retrieve("articles", $id);
    echo "Title : ".$article->getTitle()."<br>";
    echo "Content : ".$article->getContent()."<br>";
    echo "Category : ".$article->getCategory()."<br>";
    echo "CreationDate : ".$article->getCreationDate()."<br>";
    echo "UpdateDate : ".$article->getUpdateDate()."<br>";

    // REMOVE LAST ARTICLE
    echo "<br><br>REMOVE LAST ARTICLE";
    $dbHelper->delete("articles", $id);

    /*
    //SHOW ARTICLES INFO
    echo "<br><br>SHOW ARTICLES INFO";
    $result = $dbHelper->getFieldInformation("articles");
    $rows = $result->fetchAll();

    echo "<table style='border 1 px solid black'><tr><th>Column Name</th><th>Nullable</th><th>data type</th><th>Max length</th><th>Default</th><th>Extra</th></tr>";
    foreach($rows as $row)
    {
        echo "<tr><td>".$row['COLUMN_NAME']."</td>";
        echo "<td>".$row['IS_NULLABLE']."</td>";
        echo "<td>".$row['DATA_TYPE']."</td>";
        echo "<td>".$row['CHARACTER_MAXIMUM_LENGTH']."</td>";
        echo "<td>".$row['COLUMN_DEFAULT']."</td>";
        echo "<td>".$row['EXTRA']."</td></tr>";
    }
    echo "</table>";

    //TEST FILTER
    echo "<br><br>TEST FILTER SET<br>";
    include_once "./model/filter.php";

    echo "<br><br>article/update/1?page=10&article=20";
    $filter = new Filter("article/update/1?page=10&article=20");
    echo "<br>controller : ";
    echo $filter->getController();
    echo "<br>action : ";
    echo $filter->getAction();
    echo "<br>id : ";
    echo $filter->getId();
    echo "<br>filter[page] : ";
    echo $filter->getFilter("page");

    echo "<br><br>article/list?page=10&article=10";
    $filter = new Filter("article/list?page=10&article=10");
    echo "<br>controller : ";
    echo $filter->getController();
    echo "<br>action : ";
    echo $filter->getAction();
    echo "<br>id : ";
    echo $filter->getId();
    echo "<br>filter[page] : ";
    echo $filter->getFilter("page");

    echo "<br>empty<br>";
    $filter = new Filter("");
    echo "<br>controller : ";
    echo $filter->getController();
    echo "<br>action : ";
    echo $filter->getAction();
    echo "<br>id : ";
    echo $filter->getId();
    echo "<br>filter[page] : ";
    echo $filter->getFilter("page");
*/
    // TEST MAP HELPER FUNCTION
    echo "<br><br>TEST MAP HELPER FUNCTION <br>";
    include_once "./helper/MapHelper.php";
    $mapHelper = new MapHelper();
    // Arlon lat 49.6833, lon 5.8167
    // Martelange lat lon 49.83333, 5.7333
    $result = $mapHelper->calculateDistance(49.6833, 5.8167, 49.8333, 5.7333);
    echo "<br>distance between Arlon and Martelange : ". $result ."km<br>";
    $test = "Rue des Potiers 300, Attert, Belgique";
    $result = $mapHelper->geocodeAddress($test);
    echo "<br>$test : ";
    echo "<br>lat = $result->lat<br>lon = $result->lon<br>";
    //print_r($mapHelper->geocodeAddress($test));

    // TEST CALL TO STORE PROC  
    echo "<br><br>TEST CALL TO STORE PROC<br>";
    $sql = "CALL getRestaurantNearby($result->lat, $result->lon, 3)";
    $restaurants = $dbHelper->db->query($sql);
    $rows = $restaurants->fetchAll();
    foreach($rows as $row)
    {
        echo "<br>".$row['name']." ".$row['distance']."km";
    }

    //TEST IMAGE
    echo "<br><br>TEST CALL TO STORE PROC<br>";
    $db = new DbHelper();
    $file = $db->retrieve("files", 13);
    if($file != null)
    {
       echo "File ID = ".$file->getId();
       echo '<img src="data:'.$file->getType().';base64,'.base64_encode($file->getContent()) .'" />';
    }

    $content = ob_get_clean(); 
    include_once "./view/template.php";