<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class MainController
{

    public function view($path, $datas = [])
    {
        //prametrer le dossier contenent les templates html 
        $loader = new FilesystemLoader('src/View');
        //l'enverenement twig 
        $twig = new Environment($loader, [
            'cache' => false,
        ]);
        echo $twig->render($path, $datas);
    }
    public function afficheHome()
    {
        return $this->view('discription.twig');
    }
}
