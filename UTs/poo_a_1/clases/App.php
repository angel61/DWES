<?php


class App
{
    public function printHead(){
        echo "A <br>";
    }
    public function printBody(){
        echo "B <br>";
    }
    public function printFoot(){
        echo "C <br>";
    }
    public function run($p=null){
        $this->printHead();
        $this->printBody();
        $this->printFoot();
    }
}