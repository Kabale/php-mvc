<?php
    include_once "./model/message.php";
    
    class HomeController
    {
        function defaultAction()
        {
            if(!isset($_SESSION)){session_start();}
            $message = empty($_SESSION['message']) ? null : $_SESSION['message'];
            if($message != null)        
                $message->consumeMessage();
                
            $title = "Welcome Page";
            $controller = "home";
            include_once "./view/index.php";
        }

        function error404Action()
        {
            $title = "Error 404";
            $controller = "home";
            include_once "./view/error/404.php";
        }

        function error405Action()
        {
            $title = "Error 405";
            $controller = "home";
            include_once "./view/error/405.php";
        }

        function testDbAction() {
            $title = "Test DB";
            $controller = "home";
            include_once "./testdb.php";
        }
    }