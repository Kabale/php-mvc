<?php
    require_once "./model/core/message.php";

    class DbHelper
    {
        public $db;
        private $DEBUGMODE = true;

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
                if($this->DEBUGMODE == true)
                    $message = new Message("SQL ERROR", "__construct() : " . $e->getMessage(), MessageStatus::Error);
                else
                    $message = new Message("SQL ERROR", "Cannot connect to the sql database!", MessageStatus::Error);
                $message->setMessage();
            }
        }

        public function __destruct(){
            $this->db = null;
        }
        
        /**
         * @param string table = name of the SQL table
         * @param int id = id of the requested object, if none return all the objects
         * @param string objectName = name of the object returned by request
         * @return object objectName object or null
         */
        public function retrieve($table, $id, $objectName = null)
        {
            $objectName = ($objectName == null) ? rtrim($table, 's') : $objectName;
            include_once "./model/" . $objectName . ".php";

            $result = null;
            $sql = "SELECT * FROM $table";
            $sql = $sql. " WHERE id = $id";
            try {
                $query = $this->db->query($sql);
                $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, ucfirst($objectName));
                $result = $query->fetch();
            } 
            catch(PDOException $e)
            {
                if($this->DEBUGMODE == true)
                    $message = new Message("SQL ERROR", "Retrieve(" . $table . ", " . $id . ", " . $objectName . ") : " . $e->getMessage(), MessageStatus::Error);
                else
                    $message = new Message("SQL ERROR", "Cannot retrieve " . $table . "!", MessageStatus::Error);
                $message->setMessage();
            }
            return $result;
        }

        /**
         * @param string table = name of SQL table
         * @param string objectName = name of the object returned by request
         * @return array[object] objectName object or empty array
         */
        public function retrieveMultiple($table, $objectName = null) : array
        {
            $objectName = ($objectName == null) ? rtrim($table, 's') : $objectName;
            include_once "./model/" . $objectName . ".php";
            
            $result = [];
            try
            {
                $sql = "SELECT * FROM $table";
                $query = $this->db->query($sql);
                $query->setFetchMode(PDO::FETCH_CLASS, ucfirst($objectName));
                $result = $query->fetchAll();
            }
            catch(PDOException $e)
            {
                if($this->DEBUGMODE == true)
                    $message = new Message("SQL ERROR", "RetrieveMultiple(" . $table . ", " . $objectName . ") : " . $e->getMessage(), MessageStatus::Error);
                else
                    $message = new Message("SQL ERROR", "Cannot retrieve " . $table . "!", MessageStatus::Error);
                $message->setMessage();
            }
            return $result;
        }


        /**
         * @param string table = name of the SQL table
         * @param object object to be updated in the database
         * @return int id of the created object
         */
        public function add($object, $table = null)
        {
            $table = ($table == null) ? get_class($object) . "s" : $table;
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
                if($this->DEBUGMODE == true)
                    $message = new Message("SQL ERROR", "RetrieveMultiple(" . $table . ", " . $objectName . ") : " . $e->getMessage(), MessageStatus::Error);
                else
                    $message = new Message("SQL ERROR", "Cannot retrieve " . $table . "!", MessageStatus::Error);
                $message->setMessage();
            }
            return $this->db->lastInsertId();
        }

        /**
         * @param string table = name of the SQL table
         * @param object object to be updated in the database
         * @param int id = id of the modified object
         */
        public function update($object, $id, $table = null)
        {
            $table = ($table == null) ? get_class($object) . "s" : $table;
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
                if($this->DEBUGMODE == true)
                    $message = new Message("SQL ERROR", "Update(" . $object . ", " . $id . ", " . $table .") : " . $e->getMessage(), MessageStatus::Error);
                else
                    $message = new Message("SQL ERROR", "Cannot update " . $table . "!", MessageStatus::Error);
                $message->setMessage();
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
                if($this->DEBUGMODE == true)
                    $message = new Message("SQL ERROR", "delete(" . $table . ", " . $id . ") : " . $e->getMessage(), MessageStatus::Error);
                else
                    $message = new Message("SQL ERROR", "Cannot delete " . $table . "!", MessageStatus::Error);
                $message->setMessage();
            }
        }

        /**
         * @param string table = name of the SQL table
         * @return object PDO 
         */
        public function getFieldInformation($table)
        {
            try
            {
                $sql = "SELECT IS_NULLABLE, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, COLUMN_NAME, COLUMN_DEFAULT, EXTRA FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$table'";
                return $this->db->query($sql);
            } 
            catch(PDOException $e) {
                if($this->DEBUGMODE == true)
                    $message = new Message("SQL ERROR", "getFieldInformation(" . $table . ") : " . $e->getMessage(), MessageStatus::Error);
                else
                    $message = new Message("SQL ERROR", "Cannot get field information for the " . $table . "!", MessageStatus::Error);
                $message->setMessage();
            }
        }

        /**
         * @param string username 
         * @param string password 
         * @return bool
         */
        public function isValidUser($username, $password) : bool
        {
            $result = false;
            try
            {
                $sql ="SELECT COUNT(id) as count FROM users WHERE LOWER(username) = LOWER('$username') AND password = SHA2('$password', 256)";
                $result = $this->db->query($sql);
                $rows = $result->fetchAll();
                if(((int)$rows[0]["count"]) > 0)
                {
                    $result = true;
                }
            }
            catch(PDOException $e) {
                if($this->DEBUGMODE == true)
                    $message = new Message("SQL ERROR", "isValidUser(" . $username . ") : " . $e->getMessage(), MessageStatus::Error);
                else
                    $message = new Message("SQL ERROR", "Error on user validation!", MessageStatus::Error);
                $message->setMessage();
            }

            return $result;
            
        }

        public function insertFile($file)
        {
            $sql = "INSERT INTO files(content, type) VALUES('file_get_contents($file->getContent)', '$file->getType')";
            $query = $dbHelper->db->query($sql);
            $query->setFetchMode(PDO::FETCH_CLASS, 'File');
            $query->fetch();
        }
    }
?>
