<?php    
include_once "./helper/DbHelper.php";
include_once "./model/article.php";
include_once "./model/core/message.php";
include_once "./controller/_controller.php";

class RestaurantsController extends BaseController
{
    function createAction()
    {        
        $this->getContext()->setAttribute("article", new Article());
        
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
            header('Location: /restaurants/list');
            die();
        }

        include_once "./view/restaurants/create.php";
    }

    function readAction()
    {   
        $article = new Article();
        $helper = new DbHelper();

        if($this->getContext()->getFilter()->getId() != null) {
            $result = $helper->get("articles", $this->getContext()->getFilter()->getId());
            $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");

            if(count($articles) > 0)
                $article = $articles[0];
                
        } else {
            // REDIRECT USER TO LIST
            header('Location: /restaurants/list');
            die();
        }

        $this->getContext()->setAttribute("article", $article);
        include_once "./view/restaurants/read.php";
    }

    function updateAction()
    {  
        $article = new Article();
        $db = new DbHelper();

        if(isset($_POST["article"]))
        {
            // CREATE OBJECT
            // TODO GET INT FROM FILTER AND CHECK IF EXISTING OBJECT
            if($this->getContext()->getFilter()->getId() != null)
                $article->setId($this->getContext()->getFilter()->getId());
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
            header('Location: /restaurants/list');
            die();
        }

        if($this->getContext()->getFilter()->getId() != null)
        {
            $id = $this->getContext()->getFilter()->getId();
            $result = $db->get("articles", $id);
            $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");
            
            if(count($articles) > 0)
                $article = $articles[0];
        }

        $this->getContext()->setAttribute("article", $article);
        include_once "./view/restaurants/create.php";
    }

    function deleteAction()
    {
        $article = new Article();
        $article->setId($this->getContext()->getFilter()->getId());
        $article->delete();

        // REDIRECT USER TO LIST
        header('Location: /restaurants/list');
        die();
    }

    function listAction()
    {
        // helper
        $db = new DbHelper();
        $result = $db->get("articles");
        $articles = $result->fetchAll(PDO::FETCH_CLASS, "Article");

        $this->getContext()->setAttribute("articles", $articles);

        include_once "./view/restaurants/list.php";
    }

    function defaultAction()
    {
        $this->listAction();
    }
}