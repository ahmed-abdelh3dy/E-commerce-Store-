<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class invalidOrder extends Exception
{
    public function render(Request $request){
        return Redirect::route('home')
        ->withInput()
        ->withErrors([
            'messages' => $this->getMessage(),
        ])->with('info' , $this->getMessage());
    }
}
