<?php

namespace App\Services\Brackets;

use function PHPUnit\Framework\isEmpty;

class BracketValidatorService
{
    public function run(string $brackets) : bool
    {        
        $sequenceCollection = collect(str_split($brackets));
        
        // ODD ELEMENT CAN NOT BE COMBINED
        if ($sequenceCollection->count() % 2 !== 0)            
            return false;

  
        $stack = collect();

        $referenceElements = collect([
            ')' => '(',
            ']' => '[',
            '}' => '{'
        ]);
        
        $sequenceCollection->each(function(string $item) use ($referenceElements, $stack) {            
            if ($referenceElements->contains($item)){                
                // FIND OPENNING AND STACK UP THE ELEMENT
                $stack->push($item);
            } else if ($stack->isEmpty() || $referenceElements->get($item) !== $stack->pop()) {       
                // IF EMPTY NOT MATCHING OR
                // IF ITEM KEY CORRESPONDENT OF CLOSING ELEMENT NOT MATCH WITH ELEMENT UNSTACKED
                return false;
            }
        });

        // SOME DIRT
        if (!$stack->isEmpty()) 
            return false;

        // WHEN STACK IS EMPTY IT IS OK
        return true;
    }
}