<?php

  class User {
    private $user_id,$username,$lastname,$name,$email,$date,$type;

    public function __construct($user_id,$username,$lastname,$name,$email,$date,$type){
      $this->user_id = $user_id;
      $this->username = $username;
      $this->lastname = $lastname;
      $this->name = $name;
      $this->email = $email;
      $this->date = new Date($date);
      $this->type = $type;
    }

    public function getId(){
      return $this->user_id;
    }
    public function getUsername(){
      return $this->username;
    }
    public function getLastname(){
      return $this->lastname;
    }
    public function getName(){
      return $this->name;
    }
    public function getEmail(){
      return $this->email;
    }
    public function getDate(){
      return $this->date;
    }
    public function getType(){
      return $this->type;
    }

    public function setId($data){
      if(is_numeric($data)){
        $this->user_id=$data;
      }
    }
    public function setUsername($data){
      if(is_string($data)){
        $this->username=$data;
      }
    }
    public function setLastname($data){
      if(is_string($data)){
        $this->lastname=$data;
      }
    }
    public function setName($data){
      if(is_string($data)){
        $this->name=$data;
      }
    }
    public function setEmail($data){
      if(is_string($data)){
        $this->email=$data;
      }
    }
    public function setDate($data){
      if(is_object($data)&&(get_class($data)=="Date")){
        $this->date=$data;
      }
    }
    public function setType($data){
      if(is_numeric($data)){
        $this->type=$data;
      }
    }
  }

?>
