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
            $restaurant->save();
            */

            if(isset($_FILES["image"]))
            {
                $image = $_FILES["image"];
                $file = new File();
                $file->setType($image["type"]);
                $file->setContent(addslashes(file_get_contents($image["tmp_name"])));
                
                $dbHelper = new DbHelper();
                $sql = "INSERT INTO files(content, type) VALUES('file_get_contents($file->getContent)', '$file->getType')";
                $query = $dbHelper->db->query($sql);
                $query->setFetchMode(PDO::FETCH_CLASS, 'File');
                $file = $query->fetch();
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
            $result = $helper->get("restaurants", $this->getContext()->getFilter()->getId());
            $restaurants = $result->fetchAll(PDO::FETCH_CLASS, "Restaurant");

            if(count($restaurants) > 0)
                $restaurant = $restaurants[0];
                
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
        $result = $db->get("restaurants");
        $restaurants = $result->fetchAll(PDO::FETCH_CLASS, "Restaurant");

        $this->getContext()->setAttribute("restaurants", $restaurants);

        include_once "./view/restaurants/list.php";
    }

    function defaultAction()
    {
        $this->listAction();
    }
}