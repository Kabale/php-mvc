<?php
    class Filter
    {
        private $controller = "home";
        private $attribute = "default";
        private $id = 0;
        private $filter = [];

        // SETTER
        function setController($controller)
        {
            $this->controller = $controller;
        }

        function setAttribute($attribute)
        {
            $this->attribute = $attribute;
        }

        function setId($id)
        {
            $this->id = $id;
        }

        function setFilter($key, $value)
        {
            $this->filter[$key] = $value;
        }

        // GETTER
        function getController() : string
        {
            return $this->controller;
        }

        function getAttribute() : string
        {
            return $this->attribute;
        }

        function getId() : ?int
        {
            return $this->id;
        }

        function getFilter($key) : ?string
        {
            if(ISSET($this->filter[$key]))
                return $this->filter[$key];
            else
                return null;
        }

    }