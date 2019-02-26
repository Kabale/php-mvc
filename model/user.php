<?php

class User 
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $isEnabled = true;

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
    function getIsEnabled() {
        return $this->isEnabled;
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
    function setIsEnabled($isEnabled){
        $this->isEnabled = $isEnabled;
    }

}