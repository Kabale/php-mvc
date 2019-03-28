<?php
    namespace kab\controller;

    include_once "./model/core/context.php";
    use \kab\model\core as Core;

    class BaseController 
    {
        protected $context;

        function __construct($filter)
        {
            $this->context = new Core\AppContext();
            $this->context->setFilter($filter);
        }

        function getContext()
        {
            return $this->context;
        }
    }