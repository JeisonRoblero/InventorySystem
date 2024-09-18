<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING); // Ocultar advertencias y notificaciones para exponer los datos puros en formato json
    require_once 'models/User.php';
    require_once 'vendor/autoload.php'; // Cargamos el autoload de Composer para la API de Google
    
    class OAuthController {
        private $client;

        public function __construct() {
            $config = require 'config/oauth.php'; // Se carga la configuración de OAuth

            // Configuración del cliente de Google OAuth
            $this->client = new Google_Client();
            $this->client->setClientId($config['google']['client_id']);
            $this->client->setClientSecret($config['google']['client_secret']);
            $this->client->setRedirectUri($config['google']['redirect_uri']); // URL a la que Google redirigirá al usuario después de que haya iniciado sesión
            $this->client->addScope('email'); // Solicita permiso para acceder al correo electrónico
            $this->client->addScope('profile'); // Solicita permiso para acceder a la información básica del perfil
        }

        // Redirige al usuario a Google para autenticarse
        public function redirectToGoogle() {
            $auth_url = $this->client->createAuthUrl(); // URL de autenticación de Google
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL)); // Redirige a Google
        }

        // Maneja la respuesta de Google OAuth
        public function handleGoogleCallback() {
            if (isset($_GET['code'])) {
                $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
                $this->client->setAccessToken($token);

                // Obtiene datos del usuario desde Google
                $oauth2 = new Google_Service_Oauth2($this->client);
                $googleUser = $oauth2->userinfo->get();

                // Verifica si el usuario existe
                $user = new User();
                $existingUser = $user->findByGoogleId($googleUser->id);

                if ($existingUser) {

                    $token = bin2hex(random_bytes(16)); // Genera un token de login
                    $_SESSION['auth_token'] = $token;
                    $_SESSION['user_id'] = $existingUser['id'];

                    // Si el usuario ya existe, damos la bienvenida
                    header('Location: ../../../');
                    
                    echo json_encode([
                        "message" => "Login exitoso",
                        "token" => $token,
                        "user_id" => $existingUser->id,
                    ]);
                } else {
                    // Si el usuario no existe, lo registramos
                    $newUser = $user->createWithGoogle(
                        $googleUser->id,
                        $googleUser->email,
                        $googleUser->name,
                        $googleUser->picture
                    );

                    $token = bin2hex(random_bytes(16)); // Genera un token de login

                    // Guarda el token y user_id en la sesión
                    $_SESSION['auth_token'] = $token;
                    $_SESSION['user_id'] = $newUser;

                    header('Location: http://localhost/InventorySystem/');
                    
                    echo json_encode([
                        "message" => "Login exitoso",
                        "token" => $token,
                        "user_id" => $newUser,
                    ]);
                }
                
            } else {
                // Si hubo algún error en la autenticación
                echo json_encode(["message"=> "Error durante la autenticación"]);
            }
        }

        // Maneja el logout
        public function logout() {
            // Verifica si el cliente tiene un token de acceso
            if ($this->client->getAccessToken()) {
                // Si el token existe, lo revoca
                $this->client->revokeToken();

                // Redirige al usuario a la página de logout de Google
                $logoutUrl = $this->client->createAuthUrl() . '&logout';
                header('Location: ' . filter_var($logoutUrl, FILTER_SANITIZE_URL));
            }
        }
    }
?>