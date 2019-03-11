<?php
    include_once "./model/core/message.php";
    include_once "./model/core/error.php";
    include_once "./model/core/filter.php";
    include_once "./model/user.php";

    class context
    {
        private $title = ""; 
        private $filter = null; 
        private $authentication = null; 
        private $message = null; 
        private $error = null; 
        private $attribute = [];

        function __construct()
        {
            if(!isset($_SESSION)){session_start();}
            $this->message = empty($_SESSION['message']) ? null : $_SESSION['message'];
            if($this->message != null)        
                $this->message->consumeMessage();
            
            $this->authentication = empty($_SESSION['authentication']) ? null : $_SESSION['authentication'];
            
            if(isset($_POST))
            {
                // VALIDATION MUST BE THERE
            }
        }

        // SETTER
        function setTitle($title)
        {
            $this->title = $title;
        }   

        function setFilter($filter)
        {
            $this->filter = $filter;

            if($title == "")
            {
                $this->title .= ($filter->getAction() != "" && $filter->getAction() != "default") ? ucfirst($filter->getAction())." " : "";
                $this->title .= ucfirst($filter->getController());
            }
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