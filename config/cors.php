<?php


return [
    'paths' => ['*'], // Autorise tous les chemins
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173','https://backmusee.h-tsoft.com','https://portailsalama.h-tsoft.com'], // Spécifiez explicitement votre origine frontend
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];




