<?php
    include_once "./controller/_controller.php";
    include_once "./controller/restaurants.php";
    include_once "./helper/MapHelper.php";
    
    class HomeController extends BaseController 
    {
        function defaultAction()
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
            include_once "./view/index.php";
        }

        function error404Action()
        {
            $this->getContext()->setTitle("Error 404");
            include_once "./view/error/404.php";
        }

        function error405Action()
        {
            $this->getContext()->setTitle("Error 405");
            include_once "./view/error/405.php";
        }

        function testDbAction() {
            $this->getContext()->setTitle("Test DB");
            include_once "./testdb.php";
        }
    }