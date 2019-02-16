<?php

    class DefaultController
    {
        function defaultAction()
        {
            $title = "Welcome Page";
            include_once "./view/index.php";
        }

        function error404Action()
        {
            $title = "Error 404";
            include_once "./view/error/404.php";
        }

        function error405Action()
        {
            $title = "Error 405";
            include_once "./view/error/405.php";
        }
    }