<?php 
    namespace kab\model\core;

    include_once './model/core/filter.php';
    
    use \kab\controller as Controller;

    class Router 
    {

        function __construct($url)
        {
            $request = ltrim($_SERVER['REQUEST_URI'], '/');
            $filter = new Filter($request);
            
            
            $controllerFile = "./controller/".$filter->getController().".php";
            $controllerClass = "kab\\controller\\".ucfirst($filter->getController())."Controller";
            $controllerAction = strtolower($filter->getAction())."Action";
        
            if(file_exists($controllerFile)) {

                include_once $controllerFile;

                $controller = new $controllerClass($filter);
                if(method_exists($controller, $controllerAction))
                {
                    $controller->$controllerAction();
                }
                else
                {
                   $this->routeError404($filter);
                }
            }
            else {
               $this->routeError404($filter);
            }
        }

        private function routeError404($filter)
        {
            include_once "controller/home.php";
            $controller = new Controller\HomeController($filter);
            $controller->error404Action();
        }
    }