<?php

namespace App;


use App\Routes\Request;

class router
{
    //tableau qui stock les route 
    private static $request = [];

    public static function get($path, $action)
    {
        //contient traitement des match 
        $routes = new Request($path, $action);
        //stocker mes route dans la variable requeste  avec la clés 'GET'
        self::$request['GET'][] = $routes;
        //retun la routes pour faire l'enchainage 

        return $routes;
    }

    public static function delete($path, $action)
    {
        //contient traitement des match 
        $routes = new Request($path, $action);
        //stocker mes route dans la variable requeste  avec la clés 'GET'
        self::$request['GET'][] = $routes;
        //retun la routes pour faire l'enchainage 

        return $routes;
    }

    public static function post($path, $action)
    {
        $routes = new Request($path, $action);
        //stocker mes route dans la variable requeste  avec la clés 'GET'
        self::$request['POST'][] = $routes;
        //retun la routes pour faire l'enchainage 

        return $routes;
    }
    public static function put($path, $action)
    {
        $routes = new Request($path, $action);
        //stocker mes route dans la variable requeste  avec la clés 'GET'
        self::$request['POST'][] = $routes;
        //retun la routes pour faire l'enchainage 

        return $routes;
    }
    //methode parcourir le tables des routes puis matcher avec la route envoyer par le navigateur 
    public static function run()
    {

        //PARCURIR LE TABLEAU  $request puis recuperer la method avec $_SERVER 
        foreach (self::$request[$_SERVER['REQUEST_METHOD']] as $route) {

            //methode match prend en parametre url passer dans .htaccess ,en enleve les / en debut et fin 
            if ($route->match(trim($_GET['url']), '/')) {

                $route->execute();
            }
        }
    }
}
