<?php
    include_once "./model/_model.php";

    class User extends BaseModel
    {
        private $id;
        private $username;
        private $password;
        private $creationDate;
        private $isEnabled = false;

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

        function save(): boolean
        {
            try
            {
                if($this->getId() == null)
                {
                    // CREATE USER
                    $sql = "CREATE users SET $username, $password WHERE $this->getUsername(), $this->getPassword();";
                    $this->db->query($sql);
                }
                else 
                {
                    // UPDATE USER
                    $sql = "UPDATE users SET $password = $this->getPassword(); WHERE id=$this->getId();";
                    $this->db->query($sql);

                }
                return true;
            }
            catch (PDOException $e)
            {
                return false;
            }

        } 
        
    }