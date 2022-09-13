<?php

namespace App\Routes;

class Request
{
    /**
     * Request path
     * @var String
     */

    private $path;

    /**
     * Request  action (controller)
     * @var String
     */

    private $action;

    /**
     * Request  params
     * @var Array
     */

    private $params = [];

    /**
     * Request Methode POST
     * @var Array
     */

    private $requestForPost;

    /**
     * Route constructor ,received $path and $action
     * @param String $path
     * @param String $action
     */

    public function __construct(string $path, string $action)
    {
        $this->requestForPost = new HttpRequest();
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    /**
     * Route matching
     * @param String $url
     * @return BOOL
     */

    public function match(string $url)
    {
        $path = preg_replace('#({[\w]+})#', '([^/]+)', $this->path);

        $pathToMatch = "#^$path$#";

        if (preg_match($pathToMatch, $url, $results)) {
            array_shift($results);
            $this->params = $results;


            return true;
        } else {
            return false;
        }
    }


    /**
     * If matching OK Excuting
     * @return $_GET or $_POST
     */

    public function execute()
    {
        $action = explode('@', $this->action);
        $controller = $action[0];
        $controllerPath = 'App\\Controller\\' . $controller;
        $controller = new $controllerPath();
        $methode = $action[1];

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return isset($this->params) ? $controller->$methode(implode($this->params)) : $controller->$methode;
        } else {
            return isset($this->params) ? $controller->$methode($this->requestForPost, implode($this->params)) :
                $controller->$methode($this->requestForPost);
        }
    }
}
