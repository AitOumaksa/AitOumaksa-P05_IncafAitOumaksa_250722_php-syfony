<?php

namespace App\FunctionHelp;

use App\router;
class FunctionHelp 
{  
//function recupere le route et les action 
public static function  routeName($name, $params = [])
{
    $path = Router::urlName($name, $params);
    echo $path;
}


public static function redirect($name, $params = [])
{
    $path = Router::urlName($name, $params);
    header(('location' . $path));
}

}
