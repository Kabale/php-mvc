<?php
    $request = ltrim($_SERVER['REQUEST_URI'], '/');
    $array = explode('/', $request, 3);
    
    $controllerFile = count($array) > 0 && $request != "" ? "./controller/".strtolower($array[0]).".php" : "./controller/home.php";
    $controllerClass = count($array) > 0 && $request != "" ? ucfirst(strtolower($array[0]))."Controller" : "HomeController";
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
            include_once "controller/home.php";
            $controller = new HomeController();
            if($request == "")
                $controller->defaultAction();
            else
                $controller->error404Action();
        }
    }
    else {
        include_once "controller/home.php";
        $controller = new HomeController();
        $controller->error404Action();
    }
?>