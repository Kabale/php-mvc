<?php
    include_once "./model/user.php";
    include_once "./model/message.php";

    class AuthenticationController {

        function defaultAction() {
            header('Location: /home');
            die();
        }

        function resetAction($filter) {
            $new_password  = "";
            $confirm_password = "";
            $new_password_err  = "";
            $confirm_password_err = "";
            include_once "./view/authentication/reset.php";
        }

        function logupAction($filter) {
            $controller = "authentication";
            $title = "Logup";
            $password_err = "";
            $username_err = "";
            $confirm_password_err = "";
            $username = "";
            $password = "";
            $confirm_password = "";
            include_once "./view/authentication/logup.php";
        }

        function loginAction($filter) {
            if(!isset($_SESSION)){session_start();}

            $message = empty($_SESSION['message']) ? null : $_SESSION['message'];
            if($message != null)        
                $message->consumeMessage();

            $controller = "authentication";
            // Open login form 
            
            // Retrieve $lastUrl parameter
            $lastUrl = "";

            $title = "Login";
            $username ="";
            $password_err = "";
            $username_err = "";
            
            if(isset($_POST["username"]) && $_POST["username"] != "" && isset($_POST["password"]) && $_POST["password"] != "")
            {
                $user = new User();
                $user->setUsername($_POST["username"]);
                $user->setPassword($_POST["password"]);

                $isValid = $user->isValid();
                if($isValid) {
                    $message = new Message("", "You are successfuled authenticated", MessageStatus::Success);
                    $message->setMessage();

                    $_SESSION["authentication"] = true;
                    header('Location: /home');
                    die();
                }
                else
                {
                    $message = new Message("", "Invalid username or password", MessageStatus::Error);
                    $message->setMessage();
                }
            }
            else if (isset($_POST["username"]) && isset($_POST["password"]))
            {
                if($_POST["username"] == null || $_POST["username"] == "")
                {
                    $username_err = "Username cannot be null or empty.";
                }
                if($_POST["password"] == null || $_POST["username"] == "")
                {
                    $password_err = "Password cannot be null or empty.";
                }
            }

            include_once "./view/authentication/login.php";
        }
        
        function logoutAction($filter) {
            $message = new Message("", "You have been logged out successfully.", MessageStatus::Success);
            $message->setMessage();

            if(!isset($_SESSION)){session_start();}
            if(isset($_SESSION["authentication"])) {
                $_SESSION["authentication"] = null;
            }
            header('Location: /home');
            die();
        }
    }