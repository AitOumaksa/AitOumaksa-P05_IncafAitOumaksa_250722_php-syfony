<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;




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
        return $this->view('home.twig');
    }


    public function verifyInputEmail($email)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email not valid.');
            return false;
        } else {
            return true;
        }
    }

    public function verifyInputName($name)
    {
        if (!preg_match("/^([a-zA-Z' ]+)$/", $name)) {
            throw new \Exception('Name format not valide or empty.');
            return false;
        } else {
            return true;
        }
    }
    public function verifyInputMessage($message)
    {
        if (empty(htmlspecialchars($message))) {
            throw new \Exception('input empty or format not valid');
            return false;
        } else {
            return true;
        }
    }

    public function verifAuth()
    {

        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(array("error" => 'Token not found in request'));
            exit;
        }

        // var_dump($_SERVER);
        if (!preg_match('/Bearer\s+(.+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(array("error" => 'Token not found in request'));
            exit;
        }

        $jwt = $matches[1];
        if (!$jwt) {
            // Aucun jeton n'a pu être extrait de l'en-tête d'autorisation.
            header('HTTP/1.0 400 Bad Request');
            exit;
        }

        $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
        try {
            $token = JWT::decode($jwt, new Key($secretKey, 'HS512'));
        } catch (\Exception $e) {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(array("error" => $e->getMessage()));
            exit;
        }


        return $token;
    }
}
