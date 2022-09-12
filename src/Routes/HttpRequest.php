<?php

namespace App\Routes;

class HttpRequest
{
    /**
     * Received value from the form
     * @return Array $_POST
     */
    public function ValueForm()
    {
        return $_POST;
    }
    /**
     * Received value input from the form
     * @return Array $_POST
     */
    public function nameInput($field)
    {
        return $_POST[$field];
    }
}
