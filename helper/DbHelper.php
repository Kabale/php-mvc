<?php
    namespace kab\helper;
    
    require_once "./model/core/message.php";
    
    use \PDO as PDO;
    use \kab\model as Model;
    use \kab\model\core as Core;

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
                    $message = new Core\Message("SQL ERROR", "__construct() : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Cannot connect to the sql database!", Core\MessageStatus::Error);
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
                $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "kab\\model\\".ucfirst($objectName));
                $result = $query->fetch();
            } 
            catch(PDOException $e)
            {
                if($this->DEBUGMODE == true)
                    $message = new Core\Message("SQL ERROR", "Retrieve(" . $table . ", " . $id . ", " . $objectName . ") : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Cannot retrieve " . $table . "!", Core\MessageStatus::Error);
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
                $query->setFetchMode(PDO::FETCH_CLASS, "kab\\model\\".ucfirst($objectName));
                $result = $query->fetchAll();
            }
            catch(PDOException $e)
            {
                if($this->DEBUGMODE == true)
                    $message = new Core\Message("SQL ERROR", "RetrieveMultiple(" . $table . ", " . $objectName . ") : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Cannot retrieve " . $table . "!", Core\MessageStatus::Error);
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
            $class = explode("\\",get_class($object));
            $table = ($table == null) ? $class[count($class) - 1] . "s" : $table;
            $keys = [];
            $val = [];
            $reflectionClass = new \ReflectionClass(get_class($object));
            $properties = $reflectionClass->getProperties();
            for($i=0; $i < count($properties); $i++)
            {
                $method = "get".ucfirst($properties[$i]->name);
                if(method_exists($object, $method)) { 
                    $v = $object->$method();
                    if($v && gettype($v) != "object"){
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
                    $message = new Core\Message("SQL ERROR", "RetrieveMultiple(" . $table . ", " . $objectName . ") : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Cannot retrieve " . $table . "!", Core\MessageStatus::Error);
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
            $class = split(get_class($object), "\\");
            $table = ($table == null) ? $class[count($class) - 1] . "s" : $table;
            
            $val = [];
            $reflectionClass = new \ReflectionClass(get_class($object));
            $properties = $reflectionClass->getProperties();
            for($i=0; $i < count($properties); $i++)
            {
                $method = "get".ucfirst($properties[$i]->name);
                if(method_exists($object, $method)) { 
                    $v = $object->$method();
                    if($v && gettype($v) != "object"){
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
                    $message = new Core\Message("SQL ERROR", "Update(" . $id . ", " . $table .") : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Cannot update " . $table . "!", Core\MessageStatus::Error);
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
                    $message = new Core\Message("SQL ERROR", "delete(" . $table . ", " . $id . ") : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Cannot delete " . $table . "!", Core\MessageStatus::Error);
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
                    $message = new Core\Message("SQL ERROR", "getFieldInformation(" . $table . ") : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Cannot get field information for the " . $table . "!", Core\MessageStatus::Error);
                $message->setMessage();
            }
        }

        ///
        /// RETURN true if a user with the same username already exists in database 
        ///
        function isExistingUser($user): bool
        {
            $result = null;
            try
            {
                $username = $user->getUserName();
                $sql = "SELECT username FROM users WHERE username = '$username'";
                $result = $this->db->query($sql);
                $query->setFetchMode(PDO::FETCH_CLASS, "\\kab\\model\\User");
                $result = $query->fetch();
            }
            catch(PDOException $e)
            {
                if($this->DEBUGMODE == true)
                    $message = new Core\Message("SQL ERROR", "isExistingUser : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Error on user existing!", Core\MessageStatus::Error);
                $message->setMessage();
            }

            return $result;
        }

        function saveUser($user)
        {
            try
            { 
                if($user->getId() == null)
                {
                    // CREATE USER
                    $sql = "INSERT INTO users(username, password) VALUES('$user->getUserName()',SHA2('$user->getPassword()', 256))";
                    $this->db->query($sql);
                }
                else 
                {
                    // UPDATE USER
                    $sql = "UPDATE users SET password = SHA2('$user->getPassword()', 256) WHERE id=$user->getId();";
                    $this->db->query($sql);
                }
            }
            catch(PDOException $e)
            {
                if($this->DEBUGMODE == true)
                    $message = new Core\Message("SQL ERROR", "saveUser : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Error on user existing!", Core\MessageStatus::Error);
                $message->setMessage();
            }

        } 

        /**
         * @param string username 
         * @param string password 
         * @return bool
         */
        public function isValidUser($username, $password) : ? Model\User
        {
            $result = null;
            try
            {
                $sql ="SELECT * FROM users WHERE LOWER(username) = LOWER('$username') AND password = SHA2('$password', 256)";
                $query = $this->db->query($sql);
                $query->setFetchMode(PDO::FETCH_CLASS, "\\kab\\model\\User");
                $result = $query->fetch();
                if($result == false)
                    $result = null;

            }
            catch(PDOException $e) {
                if($this->DEBUGMODE == true)
                    $message = new Core\Message("SQL ERROR", "isValidUser(" . $username . ") : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Error on user validation!", Core\MessageStatus::Error);
                $message->setMessage();
            }

            return $result;
            
        }

        public function insertFile($file) : ? int
        {
            $result = 0;
            try
            {
                $content = $file->getContent();
                $type = $file->getType();
                $sql = "INSERT INTO files(content, type) VALUES(:content,:type)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':content', $content, PDO::PARAM_LOB);
                $stmt->bindParam(':type', $type, PDO::PARAM_STR, 50);
                $stmt->execute();

                $result = $this->db->lastInsertId();
            }
            catch(PDOException $e) {
                if($this->DEBUGMODE == true)
                    $message = new Core\Message("SQL ERROR", "insertFile : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Error on insert image!", Core\MessageStatus::Error);
                $message->setMessage();
            }
            return $result;
        }

        /**
         * @param object object to be updated in the database
         * @return int id of the created object
         */
        public function saveRestaurant($object)
        {
            $result = 0;
            try
            {
                $id = $object->getId();
                $name = $object->getName();
                $country = $object->getCountry();
                $city = $object->getCity();
                $number = $object->getNumber();
                $line = $object->getLine();
                $location = $object->getLocation();
                $lat = $object->getLat();
                $lon = $object->getLon();
                $createdById = $object->getCreatedById();
                $imageId = $object->getImageId();

                if($id == null)
                {
                    // CREATE
                    $sql = "INSERT INTO restaurants(name, country, city, number, line, location, lat, lon, createdById, imageId) VALUES(:name, :country, :city, :number, :line, :location, :lat, :lon, :createdById, :imageId)";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':name', $name, PDO::PARAM_STR, 250);
                    $stmt->bindParam(':country', $country, PDO::PARAM_STR, 50);
                    $stmt->bindParam(':city', $city, PDO::PARAM_STR, 50);
                    $stmt->bindParam(':number', $number, PDO::PARAM_STR, 10);
                    $stmt->bindParam(':line', $line, PDO::PARAM_STR, 100);
                    $stmt->bindParam(':location', $location, PDO::PARAM_STR, 1000);
                    $stmt->bindParam(':lat', $lat, PDO::PARAM_STR, 50);
                    $stmt->bindParam(':lon', $lon, PDO::PARAM_STR, 50);
                    $stmt->bindParam(':createdById', $createdById, PDO::PARAM_INT);
                    $stmt->bindParam(':imageId', $imageId, PDO::PARAM_INT);
                }
                else
                {
                    // UPDATE
                    $sql = "UPDATE restaurants SET name=:name, country=:country , city=:city, number=:number, line=:line, location=:location, lat=:lat, lon=:lon, imageId=:imageId WHERE id = :id";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':name', $name, PDO::PARAM_STR, 250);
                    $stmt->bindParam(':country', $country, PDO::PARAM_STR, 50);
                    $stmt->bindParam(':city', $city, PDO::PARAM_STR, 50);
                    $stmt->bindParam(':number', $number, PDO::PARAM_STR, 10);
                    $stmt->bindParam(':line', $line, PDO::PARAM_STR, 100);
                    $stmt->bindParam(':location', $location, PDO::PARAM_STR, 1000);
                    $stmt->bindParam(':lat', $lat, PDO::PARAM_STR, 50);
                    $stmt->bindParam(':lon', $lon, PDO::PARAM_STR, 50);
                    $stmt->bindParam(':imageId', $imageId, PDO::PARAM_INT);

                }
                $stmt->execute();
                $result = $this->db->lastInsertId();
            }
            catch(PDOException $e) {
                if($this->DEBUGMODE == true)
                    $message = new Core\Message("SQL ERROR", "saveRestaurant(" . $object->getName() . ") : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Error on save restaurant!", Core\MessageStatus::Error);
                $message->setMessage();
            }
            return $result;
        }

        public function callRestaurants($oLocation, $number)
        {
            $result = null;
            
            try
            {
                $sql = "CALL getRestaurantNearby($oLocation->lat, $oLocation->lon, $number)";
                $query = $this->db->query($sql);
                $query->setFetchMode(PDO::FETCH_CLASS, '\\kab\\model\\Restaurant');
                $result = $query->fetchAll();
            }
            catch(PDOException $e) {
                if($this->DEBUGMODE == true)
                    $message = new Core\Message("SQL ERROR", "getRestaurantNearby(" . $oLocation->lat . ", " . $oLocation->lon . ", " . $number . ") : " . $e->getMessage(), Core\MessageStatus::Error);
                else
                    $message = new Core\Message("SQL ERROR", "Error on save restaurant!", Core\MessageStatus::Error);
                $message->setMessage();
            }
            return $result;
        }
    }
?>
