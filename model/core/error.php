<?php
    namespace kab\model\core;
    
    class AppError
    {
        private $field;
        private $errorMessage;
        private $isValid;

        function __construct($field, $errorMessage = "", $isValid = true)
        {
            $this->field = $field;
            $this->errorMessage = $errorMessage;
            $this->isValid = $isValid; 
        }

        // GETTER
        function getField(): string
        {
            if($this->field == null)
                return "";
            else
                return $this->field;
        }
        function getErrorMessage(): string
        {
            return $this->errorMessage;
        }
        function getIsValid(): bool
        {
            return $this->isValid;
        }
        

        //SETTER
        function setField($field): void
        {
           $this->field = $field;
        }
        function setErrorMessage($errorMessage): void
        {
           $this->errorMessage = $errorMessage;
        }
        function setIsValid($isValid): void
        {
            $this->isValid = $isValid;
        }
        
    }