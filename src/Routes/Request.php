<?php

namespace App\Routes;


class Request
{
    private $path;
    private $action;
    private $params = []; //tableau vide 
    private $requestForPost;

    public function __construct(string $path, string $action)
    {
        $this->requestForPost = new HttpRequest();
        $this->path = trim($path, '/');
        $this->action = $action;
    }
    // la methode qui va matcher les route 
    public function match($url)
    {
        //en les cractere spéciaux avec  les alpha numerique  et on mets dans this->$path
        $path = preg_replace('#({[\w]+})#', '([^/])', $this->path);
        //Remplace tt la chaines 
        $pathToMatch = "#^$path$#";
        //comparer le path et lurl envoyer 
        if (preg_match($pathToMatch, $url, $results)) {
            //recupere le tableau d'url puis ecrase la premiere parti du tableau , et  recup param 
            array_shift($results);
            //stocker les resltat dans le var param 
            $this->params = $results;
            var_dump($results);
            return true;
        } else {
            return false;
        }
    }


    //si sa matche on aura lla methode excute 
    public function execute()
    {
        //recuperer le controller
        $action = explode('@', $this->action);
        $controller = $action[0];
        $controllerPath = 'App\\Controller\\' . $controller;
        $controller = new $controllerPath();
        $methode = $action[1];

        //recup req methode 
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            //Si La methode GET on recu le param puis le controller et la methode a excuter 
            return isset($this->params) ? $controller->$methode(implode($this->params)) : $controller->$methode;
        } else {
            //si la methode et POST et que il n'ya pas de paramn on inject le request 
            return isset($this->params) ? $controller->$methode($this->resquestForPost, implode($this->params)) : $controller->$methode($this->requestForPost);
        }
    }
}
