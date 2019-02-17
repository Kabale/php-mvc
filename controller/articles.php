<?php    

class ArticlesController
{
    function createAction($filter = null)
    {        
        include_once "model/article.php";
        include_once "DbHelper.php";
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
            header('Location: /articles/list');
            die();
        }

        $title = "Create Article";
        include_once "./view/articles/create.php";
    }

    function readAction($filter = null)
    {
        include_once "DbHelper.php";
        include_once "model/article.php";
    
        $helper = new DbHelper();
        if($filter != null) {
            $id = $filter;
            $result = $helper->get("articles", $id);
            $rows = $result->fetchAll();
        } else {
            header('Location: /articles/list');
            die();
        }

        include_once "./view/articles/read.php";
    }

    function updateAction($filter = null)
    {  
        include_once "model/article.php";
        include_once "DbHelper.php";

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
            header('Location: /articles/list');
            die();
        }

        if(isset($filter))
        {
            $id = $filter;
            $result = $helper->get("articles", $id);
            $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");
            
            if(count($articles) > 0)
                $article = $articles[0];
        }

        $title = "Update Article";
        include_once "./view/articles/create.php";
    }

    function deleteAction($filter = null)
    {
        include_once("model/article.php");
        include_once("DbHelper.php");

        $helper = new DbHelper();

        if($filter != null) {
            $id = $filter;
            //TODO return true if success / false if danger
            $helper->delete("articles", $id);
        } 
    
        session_start();
        $_SESSION['message'] = 'Articles successfull delete';
        $_SESSION['message_status'] = 'alert-success';
        header("Location: /articles/list");
    }

    function listAction($filter = null)
    {
        include_once "DbHelper.php";
        include_once "model/article.php";
        
        session_start();
        $message = empty($_SESSION['message']) ? "" : $_SESSION['message'];
        $messageStatus = empty($_SESSION['message_status']) ? "alert-info": $_SESSION['message_status'];

        $helper = new DbHelper();
        $result = $helper->get("articles");
        $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");
    
        include_once "./view/articles/list.php";
    }

    function defaultAction($filter = null)
    {
        $this->listAction($filter);
    }
}