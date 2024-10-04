<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    protected $forbiddenWords;

    public function __construct($forbiddenWords ){
        $this->forbiddenWords = $forbiddenWords ;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
    //    if(in_array(strtolower($value) ,$this->forbiddenWords)){
    //     // $fail("The {$attribute} contains a forbidden word. Please choose another name.");
    //     $fail("The " . $attribute . " contains a forbidden word. Please choose another name.");
    //    }
    }
}
