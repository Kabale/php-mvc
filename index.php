<?php
    namespace kab;
    
    include_once "model/core/router.php";
    $router = new model\core\Router($_SERVER['REQUEST_URI']);