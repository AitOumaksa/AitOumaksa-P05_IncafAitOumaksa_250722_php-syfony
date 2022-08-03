<?php

namespace App\Routes;

class HttpRequest
{
    //recup les valeur de formulaire 
    public function ValueForm()
    {
        return $_POST;
    }
    //recup content of form
    public function nameInput($field)
    {
        return $_POST[$field];
    }
}
