<?php

    include_once("model/article.php");
    include_once("DbHelper.php");

    $helper = new DbHelper();

     if(isset($_GET["article"])) {
        $id = $_GET["article"];
        $helper->delete("articles", $id);;
    } 
    
    header('Location: index.php');
    die();
?>