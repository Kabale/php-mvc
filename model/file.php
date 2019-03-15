<?php
    include_once "./model/_model.php";

    class File extends BaseModel{
        private $id;
        private $content;
        private $type;

        
        /**
         * Get the value of id
         */ 
        public function getId() :?int
        {
            return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

        /**
         * Get the value of content
         */ 
        public function getContent()
        {
            return $this->content;
        }

        /**
         * Set the value of content
         *
         * @return  self
         */ 
        public function setContent($content)
        {
            $this->content = $content;

            return $this;
        }

        /**
         * Get the value of type
         */ 
        public function getType() :string
        {
            return $this->type;
        }

        /**
         * Set the value of type
         *
         * @return  self
         */ 
        public function setType($type)
        {
            $this->type = $type;

            return $this;
        }
    }