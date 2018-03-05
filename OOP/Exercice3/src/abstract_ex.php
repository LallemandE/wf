<?php

// an Abstract class LighterFactory

abstract class AbstractLighterFactory
{
    protected $resources;
    public function addRessources ($type, $quantity)
    
    {   // si il n'existe pas encore de type correspondant dans le tableau, j'en crée un vide
        // que je vais incrémenter juste après.
    
        if (! isset($this->resources[$type])) $this->resources[$type] = 0;
        
        $this->resources[$type] += $quantity;
    }
    
    protected function useRessources ($type, $quantity)
    {
        $this->resources[$type] -= $quantity;
    }
    abstract public function buildLighter();
}

// Manual Lighter Factory
class ManualLighterFactory extends AbstractLighterFactory
{
    public function buildLighter(){
        if (isset($this->resources['fuel']) && $this->ressouces['fuel'] > 0) {
            $this->useRessources('fuel', 1);
            return "manual lighter";
        } else 
            return 'no fuel available';
            
    }
}


// 

class ElectricLightFactory extends AbstractLighterFactory
{
    public function buildLighter(){
        if (isset($this->resources['Electricity']) && $this->resources['Electricity'] > 0) {
            $this->useRessources('Electricity', 1);
            return "Electric lighter";
        } else
            return 'no electricity available';
            
    }
}


$factory = new ElectricLightFactory();
$factory->addRessources("Electricity", 20);
echo $factory->buildLighter();
