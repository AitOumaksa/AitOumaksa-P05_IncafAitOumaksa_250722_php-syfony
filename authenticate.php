<?php

declare(strict_types=1);
require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$hasValidCredentials = true;
if ($hasValidCredentials) {

    $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
    $issuedAt   = new DateTimeImmutable();
    $expire     = $issuedAt->modify('+24 days')->getTimestamp();      // Ajoute 60 secondes
    // Récupéré à partir des données POST filtré

    $data = [
        'iat'  => $issuedAt->getTimestamp(),         // Issued at:  : heure à laquelle le jeton a été généré
        'exp'  => $expire,                           // Expiration
        'id_user' => 1,                   // Nom d'utilisateur
    ];

    // Encoder le tableau en une chaîne JWT.
    $jwt = JWT::encode($data, $secretKey, 'HS512');
    print_r($jwt);
    echo '</br>';
    // Décoder une chaîne JWT.
    $decoded = JWT::decode($jwt, new Key($secretKey, 'HS512'));
    print_r($decoded);
}
