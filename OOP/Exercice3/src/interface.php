<?php
// I want an interface that is a child of Countable and ArrayAccess

// I want a class implementing this interfaces


interface ArrayInterface extends Countable, ArrayAccess
{
    
}

class ArrayElement implements ArrayInterface {
    
    private $array;
    
    public function count(){
        return count($this->array);  
    }
    
    public function offsetExists ($offset){
        return isset($this->array[$offset]);        
    }
    
    public function  offsetGet ($offset){
        return $this->array[$offset];
    }
    
    public function  offsetSet ($offset ,$value){
        $this->array[$offset] = $value;
    }
    
    public function offsetUnset ($offset){
        unset($this->array[$offset]);
    }
}

$array = new ArrayElement(); 
$array->offsetSet(1,2);
echo count ($array);