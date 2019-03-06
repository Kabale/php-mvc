<?php
    include_once "model/message.php";
    include_once "model/error.php";
    include_once "model/filter.php";
    include_once "model/user.php";

    class context
    {
        
        private $title = "";
        private $filter = null;
        private $authentication = null;
        private $message = null;
        private $error = null;
        private $attribute = [];

        // SETTER
        function setTitle($title)
        {
            $this->title = $title;
        }   

        function setFilter($filter)
        {
            $this->filter = $filter;
        }

        function setAttribute($key, $value)
        {
            $attribute[$key] = $value;
        }

        

        // GETTER
        function getTitle() : string
        {
            return $this->title;
        }

        function getAuthentication() : User
        {

            return $this->authentication;
        }

        function getMessage(): Message
        {

        }

        function getAttribute($key) : object
        {
            return $this->attribute[$key];
        }

        function getFilter() : Filter
        {
            return $this->filter;
        }
    }