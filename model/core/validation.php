<?php
    namespace kab\model\core;
    
    include_once "./helper/DbHelper.php";
    include_once "./model/core/error.php";

    use \kab\Helper as Helper;

    class validation
    {
        private $listError;
        private $isValid = false;
                
        function __constructor($modelName, $object)
        {
            $dbHelper = new Helper\DbHelper();
            $rows = $dbHelper->getFieldInformation($modelName);
            $rows->fetchAll();

            foreach($rows as $row)
            {
                // Retrieve Variable To Test
                $error = null;
                $value = null;
            
                $field = strtolower($error['COLUMN_NAME']);
                $maxLength = $error['CHARACTER_MAXIMUM_LENGTH'];
                $method = "get".ucfirst($field);

                if(method_exists($object, $method)) { 
                    $pass = false;
                    $value = $object->$method();
                    
                    if(!$pass && ($row['COLUMN_DEFAULT']!="" || $row['EXTRA']!="") && $value == null) {
                        // Column default and extra generate value in database (autoincrement, update date)
                        $error = new Error($field);
                        $pass = true;
                    }

                    if(!$pass && ($row['IS_NULLABLE'] == "NO" && $value == null)) {
                        $error = new Error($field, "The field ".$field." can not be null", false);
                        $pass = true;
                    }
                    
                    if(!$pass) {
                        switch($row['DATA_TYPE'])
                        {
                            case 'int':
                                if (is_int($value)) {
                                    $error = new Error($field);
                                    $pass = true;
                                } else {
                                    $error = new Error($field, "The field ".$field." must be a number between -2 147 483 648 and 2 147 483 647.");
                                    $pass = true;
                                }
                                break;
                            case 'varchar':
                                if(is_string($value) && strlen($value) <= $maxLength) {
                                    $error = new Error($field);
                                    $pass = true;
                                } else {
                                    $error = new Error($field, "The field ".$field." must be a string with max ".$maxLength." characters.");
                                    $pass = true;
                                }
                                break;
                            case 'datetime':
                                break;
                            default:
                                $error = new Error($field);
                                break;
                        }   
                    }
                    
                    if($this->isValid == true) {
                        $this->isValid = $error->getIsValid();
                    }
                    array_push($listError, $error);
                }
            }
        }

        function getIsValid(){
            return $this->isValid;
        }

        function getErrors() {
            return $this->errors;
        }
    }
?>