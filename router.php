<?php
    $request = ltrim($_SERVER['REQUEST_URI'], '/');
    $array = explode('/', $request, 3);
    
    $controllerFile = count($array) > 0 ? "./controller/". strtolower($array[0]).".php" : "/controller/default.php";
    $controllerClass = count($array) > 0 ? ucfirst(strtolower($array[0]))."Controller" : "DefaultController";
    $controllerAction = count($array) > 1 ? strtolower($array[1])."Action" : "defaultAction";
    $controllerFilter = count($array) > 2 ? strtolower($array[2]) : "";

    if(file_exists($controllerFile)) {

        include_once $controllerFile;

        $controller = new $controllerClass();
        if(method_exists($controller, $controllerAction))
        {
            $controller->$controllerAction($controllerFilter);
        }
        else
        {
            include_once "controller/default.php";
            $controller = new DefaultController();
            $controller->error404Action();
        }
    }
    else {
        include_once "controller/default.php";
        $controller = new DefaultController();
        $controller->error404Action();
    }


?>