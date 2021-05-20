<?php 

class data{

    public $class_id, $class_name, $total_class_intrusion, $porc_intrusion;

    public function __get($var){
        return $this-> $var; 
    }
    
    public function __set($var,$value){
        $this -> $var = $value;
    }

    public function __construct($class_id = NULL, $class_name = NULL, $total_class_intrusion = NULL, $porc_intrusion = NULL){	
        $this -> class_id = $class_id;
        $this -> class_name = $class_name;
        $this -> total_class_intrusion = $total_class_intrusion;
        $this -> porc_intrusion = $porc_intrusion;

    }

}
