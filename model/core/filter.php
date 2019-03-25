<?php
    class Filter
    {
        private $controller = "home";
        private $action = "default";
        private $id = null;
        private $filter = [];

        function __construct($url)
        {
            // localhost/article/update/1?page=10&article=20
            // localhost/article/list?page=10&article=10
            $attribute = explode('?', $url, 2);
            $array = explode('/', $attribute[0], 3);
            if(count($array) > 0 && $array[0] != "") 
                $this->controller = $array[0];
            if(count($array) > 1 && $array[1] != "")
                $this->action = $array[1];
            if(count($array) > 2 && $array[2] != "")
            {
                $pattern = '/^[0-9]*/';
                if(preg_match($pattern, $array[2])) 
                {
                    $this->id = (int)$array[2];
                }
            }   

            if(count($attribute) > 1 && $attribute[1] != "")
            {
                $attributes = explode('&', $attribute[1]);
                foreach($attributes as $a)
                {
                    $array = explode('=', $a);
                    if(count($array) == 2)
                    {
                        $this->filter[$array[0]] = $array[1];
                    }
                }
            }

        }

       
        // GETTER
        function getController() : string
        {
            return $this->controller;
        }

        function getAction() : string
        {
            return $this->action;
        }

        function getId() : ?int
        {
            return $this->id;
        }

        function getFilter($key) : ?string
        {
            if(ISSET($this->filter[$key]))
                return  urldecode($this->filter[$key]);
            else
                return null;
        }

    }