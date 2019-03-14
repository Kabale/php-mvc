<?php
    include_once "./model/_model.php";
    include_once "./helper/DbHelper.php";

    class User extends BaseModel
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
        function getCreationDate(): date
        {
            return $this->creationDate;
        }
        function getIsEnabled(): boolean
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

        function isValid(): bool
        {
            $dbHelper = new DbHelper();
            if($this->username != null && $this->username != "" && $this->password != null && $this->password != "")
                return $dbHelper->isValidUser($this->username, $this->password);
            else
                return false;
        }

        function isExisting(): bool
        {
            try
            {
                $isExisting = false;
                $dbHelper = new DbHelper();
                $sql = "SELECT username FROM users WHERE username = '$this->username'";
                $result = $dbHelper->db->query($sql);
                $users = $result->fetchAll(PDO::FETCH_CLASS, "User");
                if(count($users) > 0)
                    $isExisting = true;
            }
            catch(PDOException $e)
            {
                $isExisting = true;
            }

            return $isExisting;
        }

        function save(): bool
        {
            $dbHelper = new DbHelper();
            try
            { 
                if($this->getId() == null)
                {
                    // CREATE USER
                    $sql = "INSERT INTO users(username, password) VALUES('$this->username',SHA2('$this->password', 256))";
                    $dbHelper->db->query($sql);
                }
                else 
                {
                    // UPDATE USER
                    $sql = "UPDATE users SET password = SHA2('$this->password', 256) WHERE id=$this->id;";
                    $dbHelper->db->query($sql);
                }
                return true;
            }
            catch (PDOException $e)
            {
                return false;
            }

        } 
        
    }