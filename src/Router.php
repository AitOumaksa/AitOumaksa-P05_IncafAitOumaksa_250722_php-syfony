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

    public static function post($path, $action)
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
    //matching urlname 
    /* public static function urlName($name, $params = [])
    {
        // mes route sont stocker dans var $request 
        //je parcoure en fonction de clés soit get ou post et par apport al la valeur stocker, recup cles et valeur 
        foreach (self::$request  as $key => $value) {
            //puiis je parcours en utilisant la clés $key (soit get ou post)
            foreach (self::$request[$key] as $routes) {
                //on verifie si la clés existe dans la methods name crééer dans la class request on retourne la cles 
                if (array_key_exists($name, $routes->name())) {
                    $route = $routes->name();
                    //tableau du path  en le trduit en chaine de caracter
                    $path = implode($route[$name]);
                    // on verifie si le tablau de params et n'est pas vide je vais le parcourire
                    if (!empty($params)) {
                        //parcourir le tableau de params puis retourner le key
                        foreach ($params as $key => $value) {
                            //remplacer le cl"s envoyer entre {{id}} avec sa valeur dans le path 
                            $url = str_replace("{{$key}}", $value, $path);
                            //return path concatenée avec $url
                            return '/' . $url;
                        }
                    } else {
                        //returner le $path imploder
                        return '/' . $path;
                    }
                }
            }
        }
    }*/
}
