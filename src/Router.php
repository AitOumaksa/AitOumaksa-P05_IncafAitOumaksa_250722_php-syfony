<?php

namespace App;

use App\Controller\MainController;
use App\Routes\Request;

class router
{
    /**
     * Request path array
     *@var Array 
     */
    private static $request = [];

    /**
     * Route  get 
     *@return Mixed
     */

    public static function get($path, $action)
    {

        $routes = new Request($path, $action);
        self::$request['GET'][] = $routes;

        return $routes;
    }


    /**
     * Route delete
     *@return Mixed
     */

    public static function delete($path, $action)
    {

        $routes = new Request($path, $action);
        self::$request['GET'][] = $routes;

        return $routes;
    }

    /**
     * Route post
     *@return Mixed
     */

    public static function post($path, $action)
    {

        $routes = new Request($path, $action);
        self::$request['POST'][] = $routes;

        return $routes;
    }

    /**
     * Route put
     *@return Mixed
     */

    public static function put($path, $action)
    {

        $routes = new Request($path, $action);
        self::$request['POST'][] = $routes;

        return $routes;
    }
    /**
     * Run through array of the route and matching with a route sending by browser  
     * if route dosn't exist 
     * @return ErrorPage 
     */
    public static function run()
    {
        foreach (self::$request[$_SERVER['REQUEST_METHOD']] as $route) {

            if ($route->match(trim($_GET['url']), '/')) {

                $route->execute();
                return;
            }
        }
        $view = new MainController();
        return $view->view('pageError.twig');
    }
}
