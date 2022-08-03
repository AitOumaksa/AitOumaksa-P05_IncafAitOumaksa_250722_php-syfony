<?php

namespace App\Controller;

class MainController
{
    public function getUrlParams(string $param)
    {
        return filter_input(INPUT_GET, $param);
    }
}
