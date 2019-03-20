<?php    
include_once "./helper/DbHelper.php";
include_once "./controller/_controller.php";
include_once "./model/article.php";
include_once "./model/core/context.php";

class ArticlesController extends BaseController
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
            $dbHelper = new dbHelper();
            $dbHelper->add($article);          

            // REDIRECT USER TO LIST
            header('Location: /articles/list');
            die();
        }

        include_once "./view/articles/create.php";
    }

    function readAction()
    {   
        $article = new Article();
        $helper = new DbHelper();

        if($this->getContext()->getFilter()->getId() != null) {
            $article = $helper->retrieve("articles", $this->getContext()->getFilter()->getId());
                
        } else {
            // REDIRECT USER TO LIST
            header('Location: /articles/list');
            die();
        }

        $this->getContext()->setAttribute("article", $article);
        include_once "./view/articles/read.php";
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
            if($article->getId() == null)
            {
                $db->add($article);
            }
            else 
            {
                $db->update($article, $article->getId());
            }

            // REDIRECT USER TO LIST
            header('Location: /articles/list');
            die();
        }

        if($this->getContext()->getFilter()->getId() != null)
        {
            $id = $this->getContext()->getFilter()->getId();
            $article = $db->retrieve("articles", $id);
        }

        $this->getContext()->setAttribute("article", $article);
        include_once "./view/articles/create.php";
    }

    function deleteAction()
    {
        $db = new DbHelper();
        $db->delete("articles", $this->getContext()->getFilter()->getId());
                
        // REDIRECT USER TO LIST
        header('Location: /articles/list');
        die();
    }

    function listAction()
    {
        // helper
        $db = new DbHelper();
        $articles = $db->retrieveMultiple("articles");
        $this->getContext()->setAttribute("articles", $articles);

        include_once "./view/articles/list.php";
    }

    function defaultAction()
    {
        $this->listAction();
    }
}