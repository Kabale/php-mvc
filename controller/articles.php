<?php    

include_once "./helper/DbHelper.php";
include_once "./controller/_controller.php";
include_once "./model/article.php";
include_once "./model/core/context.php";

class ArticlesController extends BaseController
{
    function createAction()
    {
        $ctxt = $this->getContext();
        $ctxt->setAttribute("article", new Article());
        
        if(isset($_POST["article"]))
        {
            $article = new Article();
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
            $article->save();

            // REDIRECT USER TO LIST
            header('Location: /articles/list');
            die();
        }

        include_once "./view/articles/create.php";
    }

    function readAction()
    {   
        $ctxt = $this->getContext();
        $article = new Article();
        $helper = new DbHelper();

        if($ctxt->getFilter()->getId() != null) {
            $result = $helper->get("articles", $ctxt->getFilter()->getId());
            $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");

            if(count($articles) > 0)
                $article = $articles[0];
                
        } else {
            // REDIRECT USER TO LIST
            header('Location: /articles/list');
            die();
        }

        $ctxt->setAttribute("article", $article);
        include_once "./view/articles/read.php";
    }

    function updateAction()
    {  
        $ctxt = $this->getContext();
        $article = new Article();
        $db = new DbHelper();

        if(isset($_POST["article"]))
        {
            // CREATE OBJECT
            // TODO GET INT FROM FILTER AND CHECK IF EXISTING OBJECT
            if($ctxt->getFilter()->getId() != null)
                $article->setId($ctxt->getFilter()->getId());
            if(isset($_POST["title"]))
                $article->setTitle($_POST["title"]);
            if(isset($_POST["content"]))
                $article->setContent($_POST["content"]);
            if(isset($_POST["author"]))
                $article->setAuthor($_POST["author"]);
            if(isset($_POST["category"]))
                $article->setCategory($_POST["category"]);
            
            // SEND OBJECT TO DATABASE
            $article->save();

            // REDIRECT USER TO LIST
            header('Location: /articles/list');
            die();
        }

        if($ctxt->getFilter()->getId() != null)
        {
            $id = $ctxt->getFilter()->getId();
            $result = $db->get("articles", $id);
            $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");
            
            if(count($articles) > 0)
                $article = $articles[0];
        }

        $ctxt->setAttribute("article", $article);
        include_once "./view/articles/create.php";
    }

    function deleteAction()
    {
        $article = new Article();
        $article->setId($this->getContext()->getFilter()->getId());
        $article->delete();

        // REDIRECT USER TO LIST
        header('Location: /articles/list');
        die();
    }

    function listAction()
    {
        // helper
        $db = new DbHelper();
        $result = $db->get("articles");
        $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");

        $ctxt = $this->getContext();
        $ctxt->setAttribute("articles", $articles);

        /*
        session_start();
        $helper = new DbHelper();
        $message = empty($_SESSION['message']) ? null : $_SESSION['message'];
        if($message != null)        
            $message->consumeMessage();
        $controller = "articles";
        */

        include_once "./view/articles/list.php";
    }

    function defaultAction()
    {
        $this->listAction();
    }
}