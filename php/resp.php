<?php
class resp{
    public $code;
    public $desc;
    public $idst;
    public $color;

    function set($code,$desc,$idst,$color){
        $this->code=$code;
        $this->desc=$desc;
        $this->idst=$idst;
        $this->color=$color;
    }
}
