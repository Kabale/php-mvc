<?php
    class DbHelper
    {
        private $db;

        public function __construct(){
            $SERVERNAME = "localhost";
            $USERNAME = "iepsa_user";
            $PASSWORD = "ZHeg5X0Ti12244Fk";
            $DATABASE = "iepsa_arlon";

            try {
                $this->db = new PDO("mysql:host=$SERVERNAME;dbname=$DATABASE", $USERNAME, $PASSWORD);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        public function __destruct(){
            $this->db = null;
        }
        
        /**
         * @param string table = name of the SQL table
         * @param int id = id of the requested object, if none return all the objects
         * @return object PDOStatement
         */
        public function get($table, $id = null)
        {
            $sql = "SELECT * FROM $table";
            if($id) {
                $sql = $sql. " WHERE id = $id";
            }
            try {
                return $this->db->query($sql);
            } 
            catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
            return false;
        }

        /**
         * @param string table = name of the SQL table
         * @param object object to be updated in the database
         * @return int id of the created object
         */
        public function add($table, $object)
        {
            $keys = [];
            $val = [];
            $reflectionClass = new ReflectionClass(get_class($object));
            $properties = $reflectionClass->getProperties();
            for($i=0; $i < count($properties); $i++)
            {
                $method = "get".ucfirst($properties[$i]->name);
                if(method_exists($object, $method)) { 
                    $v = $object->$method();
                    if($v){
                        $v = str_replace("'","\'",$v);
                        array_push($keys, $properties[$i]->name);
                        array_push($val, (gettype($v) == "string") ? "'$v'" : "$v");
                    }
                }
            }

            $columns = implode(",",$keys);
            $values = implode(",", $val);
            $sql = "INSERT INTO $table($columns) VALUES($values);";

            try {
                $this->db->query($sql);
            }
            catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
            return $this->db->lastInsertId();
        }

        /**
         * @param string table = name of the SQL table
         * @param object object to be updated in the database
         * @param int id = id of the modified object
         */
        public function update($table, $object, $id)
        {
            $val = [];
            $reflectionClass = new ReflectionClass(get_class($object));
            $properties = $reflectionClass->getProperties();
            for($i=0; $i < count($properties); $i++)
            {
                $method = "get".ucfirst($properties[$i]->name);
                if(method_exists($object, $method)) { 
                    $v = $object->$method();
                    if($v){
                        $v = str_replace("'","\'",$v);
                        array_push($val, $properties[$i]->name."=".((gettype($v) == "string") ? "'$v'" : "$v"));
                    }
                }
            }

            $values = implode(",", $val);
            $sql = "UPDATE $table SET $values WHERE id=$id;";
            
            try {
                $this->db->query($sql);
            }
            catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }

        /**
         * @param string table = name of the SQL table
         * @param int id = id of the deleted object
         */
        public function delete($table, $id)
        {
            try
            {
                $sql = "DELETE FROM $table WHERE id=$id";
                $this->db->query($sql);
            }
            catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }

        /**
         * @param string table = name of the SQL table
         */
        public function getFieldInformation($table)
        {
            try
            {
                $sql = "SELECT IS_NULLABLE, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, COLUMN_NAME, COLUMN_DEFAULT, EXTRA FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$table'";
                return $this->db->query($sql);
            } 
            catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }

        /**
         * @param string username 
         * @param string password 
         */
        public function isValidUser($username, $password) : bool
        {
            $sql ="SELECT COUNT(id) as count FROM users WHERE LOWER(username) = LOWER('$username') AND password = SHA2('$password', 256)";
            $result = $this->db->query($sql);
            $rows = $result->fetchAll();
            if(((int)$rows[0]["count"]) > 0)
            {
                return true;
            }
            else {
                return false;
            }
        }
    }
?>
