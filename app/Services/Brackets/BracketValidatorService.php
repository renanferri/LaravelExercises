<?php

namespace App\Services\Brackets;

class BracketValidatorService
{
    public function run(string $brackets) : bool
    {        
        $bracketCollection = collect(str_split($brackets));
        
        // ODD ELEMENT CAN NOT BE COMBINED
        if ($bracketCollection->count() % 2 !== 0)            
            return false;
        
        // COUNT THE TYPE OF EACH OPENNING AND CLOSING BRACKETS           
        $open1 = $bracketCollection->filter(function(string $item, int $key) {            
            return $item === '(';
        });

        $close1 = $bracketCollection->filter(function(string $item, int $key) {            
            return $item === ')';
        });

        $open2 = $bracketCollection->filter(function(string $item, int $key) {            
            return $item === '[';
        });

        $close2 = $bracketCollection->filter(function(string $item, int $key) {            
            return $item === ']';
        });

        $open3 = $bracketCollection->filter(function(string $item, int $key) {            
            return $item === '{';
        });

        $close3 = $bracketCollection->filter(function(string $item, int $key) {            
            return $item === '}';
        });

        // IF THE COUNT OF PAIR COMBINED IS VALIDATED
        if($open1->count() === $close1->count() && $open2->count() === $close2->count() && $open3->count() === $close3->count())
            return true;

        
        return false;
    }
  

}