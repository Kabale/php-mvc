<?php
    include_once "./model/core/context.php";

    class BaseController 
    {
        protected $context;

        function __construct($filter)
        {
            $this->context = new AppContext();
            $this->context->setFilter($filter);
        }

        function getContext()
        {
            return $this->context;
        }
    }