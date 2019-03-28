<?php
    namespace kab\controller;
    
    include_once "./controller/_controller.php";
    include_once "./controller/restaurants.php";
    include_once "./helper/MapHelper.php";

    use \kab\helper as Helper;
    use \kab\model as Model;

    class HomeController extends BaseController 
    {
        function defaultAction()
        {
            $dbHelper = new Helper\DbHelper();
            $mapHelper = new Helper\MapHelper();

            $location = $this->getContext()->getFilter()->getFilter("location");
            $number = ($this->getContext()->getFilter()->getFilter("number") != null) ? $this->getContext()->getFilter()->getFilter("number") : 3;

            if($location == null || $location == "") 
                $location = "Arlon, Belgique";

            if(ISSET($location) && $location!= "")
            {
                
                $oLocation = $mapHelper->geocodeAddress($location);
                if($oLocation == null)
                {
                    $this->getContext()->setMessage(new Core\Message("", "Location Not Found !", Core\MessageStatus::Error));
                }
                else 
                {
                    $this->getContext()->setAttribute("location", $oLocation);
                    $restaurants = $dbHelper->callRestaurants($oLocation, $number);
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
    }