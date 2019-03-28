<?php
    namespace kab\model\core;
    
    include_once "./model/enum/messageStatus.php";

    class Message 
    {
        private $status;
        private $name;
        private $description;

        function __construct($name, $desciption, $status = null)
        {
            $this->status = ($status != null && MessageStatus::isValidValue($status)) ?  $status : MessageStatus::Info;
            $this->name = $name;
            $this->description = $desciption;
        }

        // GETTER
        public function getName(): string
        {
            return $this->name;
        }

        public function getDescription(): string
        {
            return $this->description;
        }

        public function getStatus(): string
        {
            return $this->status;
        }

        // FUNCTIONS
        function setMessage()
        {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['message'] = $this;
        }

        function consumeMessage()
        {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['message'] = null;
        }

    }

    
?>