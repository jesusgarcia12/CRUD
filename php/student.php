<?php

class student {
    public $id;
    public $studentsname;
    public $lastname;
    public $email;
    
    function set($id,$studentsname,$lastname,$age,$email)
    {
    $this ->id =$id;
    $this ->studentsname =$studentsname;
    $this->lastname=$lastname;
    $this->age=$age;
    $this->email=$email;
    
    }
    
    }