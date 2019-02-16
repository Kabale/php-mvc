<?php    

class ArticlesController
{
    function createAction($filter = null)
    {
        $title = "Create Article";
        
        include_once("model/article.php");
        include_once("DbHelper.php");

        $helper = new DbHelper();
        $article = new Article();

        if(isset($_POST["article"]))
        {
            // CREATE OBJECT
            if(isset($_POST["title"]))
                $article->setTitle($_POST["title"]);
            if(isset($_POST["content"]))
                $article->setContent($_POST["content"]);
            if(isset($_POST["author"]))
                $article->setAuthor($_POST["author"]);
            if(isset($_POST["category"]))
                $article->setCategory($_POST["category"]);
            
            // SEND OBJECT TO DATABASE
            if(isset($_POST["id"]) && $_POST["id"] != "")
                $helper->update("articles", $article, $_POST["id"]);
            else
                $helper->add("articles", $article);

            // REDIRECT USER TO LIST
            header('Location: index.php');
            die();
        }

        if(isset($_GET["article"]))
        {
            $id = $_GET["article"];
            $result = $helper->get("articles", $id);
            $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");
            
            if(count($articles) > 0)
                $article = $articles[0];
        }

        include_once "./view/articles/create.php";
    }

    function readAction($filter = null)
    {
        $title = "Read Article";
        include_once "./view/error/503.php";
    }

    function updateAction($filter = null)
    {  
        $title = "Update Article";
        include_once "./view/error/503.php";
    }

    function deleteAction($filter = null)
    {
        $title = "Delete Article";
        include_once "./view/error/503.php";
    }

    function listAction($filter = null)
    {
        $title = "List Article";
        include_once "./view/error/503.php";
    }

    function defaultAction($filter = null)
    {
        listAction($filter);
    }
}