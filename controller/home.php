<?php
    include_once "./controller/_controller.php";
    include_once "./helper/MapHelper.php";
    
    class HomeController extends BaseController 
    {
        function defaultAction()
        {
            $location = urldecode($this->getContext()->getFilter()->getFilter("location"));
            if(ISSET($location) && $location!= "")
            {
                $mapHelper = new MapHelper();
                $oLocation = $mapHelper->geocodeAddress($location);
                if($oLocation == null)
                {
                    $this->getContext()->setMessage(new Message("", "Location Not Found !", MessageStatus::Error));
                }
                else 
                {
                    $this->getContext()->setAttribute("location", $oLocation);
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