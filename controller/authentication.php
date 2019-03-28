<?php
    namespace kab\controller;
    
    include_once "./helper/DbHelper.php";
    include_once "./controller/_controller.php";
    include_once "./model/user.php";
    include_once "./model/core/message.php";
    
    use \kab\helper as Helper;
    use \kab\model as Model;
    use \kab\model\core as Core;

    class AuthenticationController extends BaseController 
    {

        function defaultAction() {

            header('Location: /home');
            die();
        }

        function resetAction() {
            $new_password  = "";
            $confirm_password = "";
            $new_password_err  = "";
            $confirm_password_err = "";
            include_once "./view/authentication/reset.php";
        }

        function logupAction() {

            $db = new Helper\DbHelper();

            $password_err = "";
            $username_err = "";
            $confirm_password_err = "";
            $username = "";
            $password = "";
            $confirm_password = "";

            if (isset($_POST["username"]) &&  isset($_POST["confirm_password"]) && isset($_POST["password"]))
            {
                if($_POST["username"] == null || $_POST["username"] == "")
                {
                    $username_err = "Username cannot be null or empty!";
                }
                if($_POST["password"] == null || $_POST["password"] == "")
                {
                    $password_err = "Password cannot be null or empty!";
                }
                if($_POST["confirm_password"] == null || $_POST["confirm_password"] == "")
                {
                    $confirm_password_err = "Password cannot be null or empty!";
                }
                if($_POST["confirm_password"] != null && $_POST["password"] != null && $_POST["confirm_password"] != $_POST["password"])
                {
                    $confirm_password_err = "Confirm password must have the same value as Password !";
                }

                if($password_err == "" && $username_err == "" && $confirm_password_err == "")
                {
                    $user = new Model\User();
                    $user->setUsername($_POST["username"]);
                    $user->setPassword($_POST["password"]);
                    if($db->isExistingUser($user))
                    {
                        $db->add($user);
                        $message = new Core\Message("", "User ".$_POST["username"]." successfully created!", Core\MessageStatus::Success);
                        $message->setMessage();
                        header('Location: /authentication/login');
                        die();
                    }
                    else 
                    {   
                        $message = new Core\Message("", "User with name ".$_POST["username"]." already exist!", Core\MessageStatus::Error);
                        $message->setMessage();
                        header('Location: /authentication/logup');
                        die();
                    }
                }

            }
            
            include_once "./view/authentication/logup.php";
        }

        function loginAction() {
          
            $db = new Helper\DbHelper();
            $lastUrl = "";
            $username ="";
            $password_err = "";
            $username_err = "";
            
            if(isset($_POST["username"]) && $_POST["username"] != "" && isset($_POST["password"]) && $_POST["password"] != "")
            {
                $user = $db->isValidUser($_POST["username"], $_POST["password"]);
                if($user != null) {
                    $message = new Core\Message("", "You are successfuled authenticated", Core\MessageStatus::Success);
                    $message->setMessage();

                    $_SESSION["authentication"] = $user;
                    header('Location: /home');
                    die();
                }
                else
                {
                    $message = new Core\Message("", "Invalid username or password", Core\MessageStatus::Error);
                    $message->setMessage();
                    header('Location: /authentication/login');
                    die();
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
        
        function logoutAction() {
            $message = new Core\Message("", "You have been logged out successfully.", Core\MessageStatus::Success);
            $message->setMessage();

            if(!isset($_SESSION)){session_start();}
            if(isset($_SESSION["authentication"])) {
                $_SESSION["authentication"] = null;
            }
            header('Location: /home');
            die();
        }
    }