<?php
    $request = isset($_REQUEST["path"])? $_REQUEST["path"] : "";

    switch($request) {
        case '' :
            require __DIR__ . '/view/index.php';
            break;
        case 'articles' :
            require __DIR__ . '/view/articles/list.php';
            break;
        default: 
            require __DIR__ . '/view/error/404.php';
            break;
    }

?>