<?php    
include_once "./helper/DbHelper.php";
include_once "./model/article.php";
include_once "./model/restaurant.php";
include_once "./model/file.php";
include_once "./controller/_controller.php";

class RestaurantsController extends BaseController
{
    function createAction()
    {        
        $this->getContext()->setAttribute("restaurant", new Restaurant());
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $db = new DbHelper();
            /*
            $file = new File();
            $restaurant = new Restaurant();
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
            $db->add($restaurant);
            */
            
            if(isset($_FILES["image"]))
            {
                $image = $_FILES["image"];
                $file = new File();
                $file->setType($image["type"]);
                $file->setContent(addslashes(file_get_contents($image["tmp_name"])));
                                
                $db = new DbHelper();
                $db->add($file);  
            }


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
            $restaurant = $helper->retrieve("restaurants", $this->getContext()->getFilter()->getId());                
        } else {
            // REDIRECT USER TO LIST
            header('Location: /restaurants/list');
            die();
        }

        $this->getContext()->setAttribute("restaurant", $restaurant);
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
            if($article->getId() ==null)
            {
                $db->add($article);
            }
            else
            {
                $db->update($article, $article->getId());
            }

            // REDIRECT USER TO LIST
            header('Location: /restaurants/list');
            die();
        }

        if($this->getContext()->getFilter()->getId() != null)
        {
            $id = $this->getContext()->getFilter()->getId();
            $article = $db->retrieve("articles", $id);
        }

        $this->getContext()->setAttribute("article", $article);
        include_once "./view/restaurants/create.php";
    }

    function deleteAction()
    {
        $db = new DbHelper();
        $db->delete("articles", $this->getContext()->getFilter()->getId());
        
        // REDIRECT USER TO LIST
        header('Location: /restaurants/list');
        die();
    }

    function listAction()
    {
        // helper
        $db = new DbHelper();
        $restaurants = $db->retrieveMultiple("restaurants");
       
        $this->getContext()->setAttribute("restaurants", $restaurants);

        include_once "./view/restaurants/list.php";
    }

    function defaultAction()
    {
        $this->listAction();
    }
}