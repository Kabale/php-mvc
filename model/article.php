<?php

    Class Article {

        private $id;
        private $title = "";
        private $content = "";
        private $author = "";
        private $creationDate = "";
        private $updateDate = "";
        private $category = "";
        
        /// GETTERS
        public function getId(): ?int
        {
            return $this->id;
        }
        public function getTitle(): string
        {
            return $this->title;
        }
        public function getContent(): string
        {
            return $this->content;
        }
        public function getAuthor(): string
        {
            return $this->author;
        }
        public function getCreationDate(): string
        {
            return $this->creationDate;
        }
        
        /// SETTERS
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
        public function getUpdateDate(): string
        {
            return $this->updateDate;
        }
        public function getCategory(): string
        {
            return $this->category;
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


