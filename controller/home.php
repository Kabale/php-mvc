<?php
    include_once "./controller/_controller.php";
    
    class HomeController extends BaseController 
    {
        function defaultAction()
        {
            $ctxt = $this->getContext();
            include_once "./view/index.php";
        }

        function error404Action()
        {
            $ctxt = $this->getContext();
            $ctxt->setTitle("Error 404");
            include_once "./view/error/404.php";
        }

        function error405Action()
        {
            $ctxt = $this->getContext();
            $ctxt->setTitle("Error 405");
            include_once "./view/error/405.php";
        }

        function testDbAction() {
            $ctxt = $this->getContext();
            $ctxt->setTitle("Test DB");
            include_once "./testdb.php";
        }
    }