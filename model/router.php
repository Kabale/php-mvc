<?php 
    include_once 'model/filter.php';

    class Router 
    {

        function __construct($url)
        {
            $request = ltrim($_SERVER['REQUEST_URI'], '/');
            $filter = new Filter($request);
            
            
            $controllerFile = "./controller/".$filter->getController().".php";
            $controllerClass = ucfirst($filter->getController())."Controller";
            $controllerAction = strtolower($filter->getAction())."Action";
        
            if(file_exists($controllerFile)) {

                include_once $controllerFile;

                $controller = new $controllerClass();
                if(method_exists($controller, $controllerAction))
                {

                    $controller->$controllerAction($filter);
                }
                else
                {
                   routeError404($filter);
                }
            }
            else {
               routeError404($filter);
            }
        }

        private function routeError404($filter)
        {
            include_once "controller/home.php";
            $controller = new HomeController();
            $controller->error404Action($filter);
        }
    }