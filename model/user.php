<?php

class User 
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    //GETTER
    function getId() {
        return $this->id;
    }
    function getFirstname() {
        return $this->firstname;
    }
    function getLastname() {
        return $this->lastname;
    }
    function getEmail() {
        return $this->email;
    }
    function getPassword() {
        return $this->password;
    }

    //SETTER
    function setId($id) {
        $this->id = $id;
    }
    function setFirstname($firstname) {
        $this->firstname = $firstname;
    }
    function setLastname($lastname) {
        $this->lastname = $lastname;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function setPassword($password) {
        $this->password = $password;
    }

}