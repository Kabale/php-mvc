<?php    
include_once "DbHelper.php";
include_once "model/article.php";
include_once "model/message.php";

class ArticlesController
{
    function createAction($filter = null)
    {        
        $article = new Article();
        $helper = new DbHelper();

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
        $article = new Article();
        $helper = new DbHelper();

        if($filter != null) {
            $id = $filter;
            $result = $helper->get("articles", $id);
            $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");

            if(count($articles) > 0)
                $article = $articles[0];
                
        } else {
            // REDIRECT USER TO LIST
            header('Location: /articles/list');
            die();
        }

        include_once "./view/articles/read.php";
    }

    function updateAction($filter = null)
    {  
        $article = new Article();
        $helper = new DbHelper();

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
            if($filter != "") {
                $helper->update("articles", $article, $filter);
            }
            else {
                $helper->add("articles", $article);
            }

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
        $helper = new DbHelper();

        if($filter != null) {
            $id = $filter;
            $helper->delete("articles", $id);
            //TODO: IF SUCCESSFULL DELETE
            $message = new Message("Delete", "Article deleted with success", MessageStatus::Success);
            $message->setMessage();
        } 

        // REDIRECT USER TO LIST
        header('Location: /articles/list');
        die();
    }

    function listAction($filter = null)
    {      
        session_start();
        $helper = new DbHelper();
        $message = empty($_SESSION['message']) ? null : $_SESSION['message'];
        if($message != null)        
            $message->consumeMessage();
        $result = $helper->get("articles");
        $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");
    
        include_once "./view/articles/list.php";
    }

    function defaultAction($filter = null)
    {
        $this->listAction($filter);
    }
}