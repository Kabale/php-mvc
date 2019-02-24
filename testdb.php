<?php
    include 'DbHelper.php';
    include 'model/Article.php';

    // TEST DATABASE HELPER
    $helper = new DbHelper();

    // TEST LIST ARTICLES
    echo "SHOW LIST ARTICLES<br>";
    $result = $helper->get("articles");
    $rows = $result->fetchAll();
    foreach($rows as $row)
        echo $row['id']." ".$row['title']."<br>";

    // TEST ADD ARTICLE 
    echo "<br><br>ADD ARTICLE TOTO<br>";
    $article = new Article();
    $article->setTitle("Toto");
    $article->setContent("Contenu de l'article Toto");

    $id = $helper->add("articles", $article);
    echo "L'id du dernier article est : $id<br>";

    // SHOW LAST ARTICLE
    echo "<br><br>SHOW ARTICLE WITH ID $id<br>";
    $result = $helper->get("articles", $id);
    echo "Type : ".gettype($result). " ".get_class($result)."<br>";
    $rows = $result->fetchAll();
    foreach($rows as $row)
        echo "Title : ".$row['title']."<br>";
        echo "Content : ".$row['content']."<br>";
        echo "Category : ".$row['category']."<br>";
        echo "CreationDate : ".$row['creationDate']."<br>";
        echo "UpdateDate : ".$row['updateDate']."<br>";

    // UPDATE LAST ARTICLE
    echo "<br><br>UPDATE ARTICLE<br>";
    $article->setCategory("Test");
    $helper->update("articles", $article, $id);

    // SHOW LAST ARTICLE
    echo "<br><br>SHOW ARTICLE WITH ID $id<br>";
    $result = $helper->get("articles", $id);
    $rows = $result->fetchAll();
    foreach($rows as $row)
        echo "Title : ".$row['title']."<br>";
        echo "Content : ".$row['content']."<br>";
        echo "Category : ".$row['category']."<br>";
        echo "CreationDate : ".$row['creationDate']."<br>";
        echo "UpdateDate : ".$row['updateDate']."<br>";

    // REMOVE LAST ARTICLE
    echo "<br><br>REMOVE LAST ARTICLE";
    $helper->delete("articles", $id);

    //SHOW ARTICLES INFO
    echo "<br><br>SHOW ARTICLES INFO";
    $result = $helper->getFieldInformation("articles");
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
?>