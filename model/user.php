<?php
    namespace kab\model;

    class User 
    {
        private $id;
        private $username;
        private $password;
        private $creationDate;
        private $isEnabled = true;

        // GETTER
        function getId(): ?int
        {
            return $this->id;
        }
        function getUsername(): string
        {
            return $this->username;
        }
        function getPassword(): string
        {
            return $this->password;
        }
        function getCreationDate(): ?string
        {
            return $this->creationDate;
        }
        function getIsEnabled(): bool
        {
            return $this->isEnabled;
        }

        // SETTER
        function setId($id) : void
        {
            $this->id = $id;
        }
        function setUsername($username): void
        {
            $this->username = $username;
        }
        function setPassword($password): void
        {
            $this->password = $password;
        }
        function setCreationDate($creationDate): void
        {
            $this->creationDate = $creationDate;
        }
        function setIsEnabled($isEnabled): void
        {
            $this->isEnabled = $isEnabled;
        }        
    }