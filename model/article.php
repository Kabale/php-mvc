<?php


    class Article 
    {
        private $id;
        private $title;
        private $content;
        private $author;
        private $creationDate;
        private $updateDate;
        private $category;
        
        /// GETTERS
        public function getId(): ?int
        {
            return $this->id;
        }
        public function getTitle(): string
        {
            if($this->title == null)
                return "";
            else
                return $this->title;
        }
        public function getContent(): string
        {
            if($this->content == null)
                return "";
            else
                return $this->content;
        }
        public function getAuthor(): string
        {
            if($this->author == null)
                return "";
            else
                return $this->author;
        }
        public function getCreationDate(): string
        {
            if($this->creationDate == null)
                return "";
            else
                return $this->creationDate;
        }
        public function getUpdateDate(): string
        {
            if($this->updateDate == null)
                return "";
            else
                return $this->updateDate;
        }
        public function getCategory(): string
        {
            if($this->category == null)
                return "";
            else
                return $this->category;
        }
        
        /// SETTERS
        public function setId(int $id): void
        {
            $this->id = $id;
        }
        public function setTitle(string $title): void
        {
            $this->title = $title;
        }
        public function setContent(string $content): void
        {
            $this->content = $content;
        }
        public function setAuthor(string $author): void
        {
            $this->author = $author;
        }
        public function setCategory(string $category): void
        {
            $this->category = $category;
        }

        // OTHER FUNTIONS
        public function __toString()
        {
            return $this->content;
        }
    }


