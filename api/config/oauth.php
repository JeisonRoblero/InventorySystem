<?php
    require_once 'env.php';
    return [
        'google' => [
            'client_id' => $_ENV['GOOGLE_OAUTH_CLIENT_ID'],
            'client_secret' => $_ENV['GOOGLE_OAUTH_CLIENT_SECRET'],
            'redirect_uri' => 'http://localhost/InventorySystem/api/oauth/google/callback',
        ],
    ];
?>