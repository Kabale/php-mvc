<?php    
include_once "./helper/DbHelper.php";
include_once "./helper/MapHelper.php";
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
            
            $file = new File();
            $restaurant = new Restaurant();
            
            // CREATE OBJECT    
            $restaurant->setCreatedById($this->getContext()->getAuthentication()->getId());
            if(isset($_POST["name"]))
                $restaurant->setName($_POST["name"]);
            if(isset($_POST["city"]))
                $restaurant->setCity($_POST["city"]);
            if(isset($_POST["country"]))
                $restaurant->setCountry($_POST["country"]);
            if(isset($_POST["line"]))
                $restaurant->setLine($_POST["line"]);
            if(isset($_POST["number"]))
                $restaurant->setNumber($_POST["number"]);
            
            // CALL MAP HELPER TO FIND LAT & LON
            //  Rue de Diekirch 41, Arlon, Belgique
            $location = $restaurant->getLine() . " " . $restaurant->getNumber() . ", " . $restaurant->getCity() . ", " . $restaurant->getCountry();
            $mapHelper = new MapHelper();
            $result = $mapHelper->geocodeAddress($location);
            $restaurant->setLocation($location);
            if(isset($result))
            {
                $restaurant->setLat($result->lat);
                $restaurant->setLon($result->lon);
            }
            else 
            {
                $message = new Message("Create Restaurant", "Location not found!", MessageStatus::Warning);
            }
                        
            if(isset($_FILES["image"]) && $_FILES["image"]["tmp_name"] != null)
            {
                $image = $_FILES["image"];
                $file = new File();
                $file->setType($image["type"]);
                $file->setContent(file_get_contents($image["tmp_name"]));
                                
                $db = new DbHelper();
                $fileId = $db->insertFile($file);  
                if($fileId != 0)
                    $restaurant->setImageId($fileId);
            }

            // SEND OBJECT TO DATABASE
            $db->saveRestaurant($restaurant);

            // REDIRECT USER TO LIST
            header('Location: /restaurants/list');
            die();
        }

        include_once "./view/restaurants/create.php";
    }

    function readAction()
    {   
        $restaurant = new Restaurant();
        $db = new DbHelper();

        if($this->getContext()->getFilter()->getId() != null) {
            $restaurant = $db->retrieve("restaurants", $this->getContext()->getFilter()->getId());                
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
        $restaurant = new Restaurant();
        $db = new DbHelper();

        if(isset($_POST["restaurant"]))
        {
            // CREATE OBJECT
            // TODO GET INT FROM FILTER AND CHECK IF EXISTING OBJECT
            $restaurant = $db->retrieve('restaurants', $this->getContext()->getFilter()->getId());
            if(isset($_POST["name"]))
                $restaurant->setName($_POST["name"]);
            if(isset($_POST["city"]))
                $restaurant->setCity($_POST["city"]);
            if(isset($_POST["country"]))
                $restaurant->setCountry($_POST["country"]);
            if(isset($_POST["line"]))
                $restaurant->setLine($_POST["line"]);
            if(isset($_POST["number"]))
                $restaurant->setNumber($_POST["number"]);
            
            if(isset($_FILES["image"]) && $_FILES["image"]["tmp_name"] != null)
            {
                $image = $_FILES["image"];
                $file = new File();
                $file->setType($image["type"]);
                $file->setContent(file_get_contents($image["tmp_name"]));
                                
                $db = new DbHelper();
                $fileId = $db->insertFile($file);  
                $oldFileId = $restaurant->getImageId();
                if($fileId != 0)
                {
                    $restaurant->setImageId($fileId);
                }
            }

            // SEND OBJECT TO DATABASE
            $db->saveRestaurant($restaurant, $restaurant->getId());

            // REMOVE OLD FILE
            if($fileId != 0 && $oldFileId != null)
            {
                $db->delete('files', $oldFileId);
            }
            // REDIRECT USER TO LIST
            header('Location: /restaurants/list');
            die();
        }

        if($this->getContext()->getFilter()->getId() != null)
        {
            $id = $this->getContext()->getFilter()->getId();
            $restaurant = $db->retrieve("restaurants", $id);
        }

        $this->getContext()->setAttribute("restaurant", $restaurant);
        include_once "./view/restaurants/create.php";
    }

    function deleteAction()
    {
        $db = new DbHelper();
        $restaurant = $db->retrieve("restaurants", $this->getContext()->getFilter()->getId());
        $db->delete("restaurants", $this->getContext()->getFilter()->getId());
        if($restaurant->getImage() != null)
            $db->delete("files", $restaurant->getImage()->getId());
        
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

    function viewAction()
    {
        $dbHelper = new DbHelper();
        $mapHelper = new MapHelper();

        $location = $this->getContext()->getFilter()->getFilter("location");
        $number = ($this->getContext()->getFilter()->getFilter("number") != null) ? $this->getContext()->getFilter()->getFilter("number") : 3;


        if($location == null || $location == "") 
            $location = "Arlon, Belgique";

        if(ISSET($location) && $location!= "")
        {
            
            $oLocation = $mapHelper->geocodeAddress($location);
            if($oLocation == null)
            {
                $this->getContext()->setMessage(new Message("", "Location Not Found !", MessageStatus::Error));
            }
            else 
            {
                $this->getContext()->setAttribute("location", $oLocation);
                $sql = "CALL getRestaurantNearby($oLocation->lat, $oLocation->lon, $number)";
                $query = $dbHelper->db->query($sql);
                $query->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');
                $restaurants = $query->fetchAll();
                $this->getContext()->setAttribute("restaurants", $restaurants);
            }
        }
        include_once "./view/restaurants/view.php";
    }

    function defaultAction()
    {
        $this->listAction();
    }
}