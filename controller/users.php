<?php    
include_once "DbHelper.php";
include_once "model/user.php";
include_once "model/message.php";

class UsersController
{
    function createAction($filter = null)
    {        
        $user = new User();
        $helper = new DbHelper();

        if(isset($_POST["user"]))
        {
            // CREATE OBJECT
            if(isset($_POST["firstname"]))
                $user->setFirstname($_POST["firstname"]);
            if(isset($_POST["lastname"]))
                $user->setLastname($_POST["lastname"]);
            if(isset($_POST["password"]))
                $user->setPassword($_POST["password"]);
            if(isset($_POST["email"]))
                $user->setEmail($_POST["email"]);
            
            // SEND OBJECT TO DATABASE
            if(isset($_POST["id"]) && $_POST["id"] != "")
                $helper->update("users", $user, $_POST["id"]);
            else
                $helper->add("users", $user);

            // REDIRECT USER TO LIST
            header('Location: /users/list');
            die();
        }
        $controller = "users";
        $title = "Create User";
        include_once "./view/users/create.php";
    }

    function readAction($filter = null)
    {   
        $user = new User();
        $helper = new DbHelper();

        if($filter != null) {
            $id = $filter;
            $result = $helper->get("users", $id);
            $users = $result->fetchAll(PDO::FETCH_CLASS, "User");

            if(count($users) > 0)
                $user = $users[0];
                
        } else {
            // REDIRECT USER TO LIST
            header('Location: /users/list');
            die();
        }

        include_once "./view/users/read.php";
    }

    function updateAction($filter = null)
    {  
        $user = new User();
        $helper = new DbHelper();

        if(isset($_POST["user"]))
        {
            // CREATE OBJECT
            if(isset($_POST["firstname"]))
                $user->setFirstname($_POST["firstname"]);
            if(isset($_POST["lastname"]))
                $user->setLastname($_POST["lastname"]);
            if(isset($_POST["password"]))
                $user->setPassword($_POST["password"]);
            if(isset($_POST["email"]))
                $user->setEmail($_POST["email"]);
            
            // SEND OBJECT TO DATABASE
            if($filter != "") {
                $helper->update("users", $user, $filter);
            }
            else {
                $helper->add("users", $user);
            }

            // REDIRECT USER TO LIST
            header('Location: /users/list');
            die();
        }

        if(isset($filter))
        {
            $id = $filter;
            $result = $helper->get("users", $id);
            $users = $result->fetchAll(PDO::FETCH_CLASS, "User");
            
            if(count($users) > 0)
                $user = $users[0];
        }
        $controller = "users";
        $title = "Update User";
        include_once "./view/users/create.php";
    }

    function deleteAction($filter = null)
    {
        $helper = new DbHelper();

        if($filter != null) {
            $id = $filter;
            $helper->delete("users", $id);
            //TODO: IF SUCCESSFULL DELETE
            $message = new Message("Delete", "User deleted with success", MessageStatus::Success);
            $message->setMessage();
        } 

        // REDIRECT USER TO LIST
        header('Location: /users/list');
        die();
    }

    function listAction($filter = null)
    {      
        session_start();
        $helper = new DbHelper();
        $message = empty($_SESSION['message']) ? null : $_SESSION['message'];
        if($message != null)        
            $message->consumeMessage();
        $result = $helper->get("users");
        $users = $result->fetchAll(PDO::FETCH_CLASS, "User");
        $controller = "users";
        include_once "./view/users/list.php";
    }

    function defaultAction($filter = null)
    {
        $this->listAction($filter);
    }
}