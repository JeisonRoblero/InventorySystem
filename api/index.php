<?php
    // Se obtiene la URI de la solicitud sin parámetros de consulta
    $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Se divide la URI para obtener el recurso y la acción
    $request_parts = explode('/', trim($request, '/'));

    // Define el nombre del sistema base
    $base_system = 'api';

    // Busca el índice donde empieza el sistema base en la URI
    $base_index = array_search($base_system, $request_parts);

    // Se obtiene el recurso (usuarios, productos, compras)
    $resource = isset($request_parts[$base_index + 1]) ? $request_parts[$base_index + 1] : '';

    // Se obtiene el método HTTP
    $method = $_SERVER['REQUEST_METHOD'];

    // Define las rutas y controla la solicitud
    switch ($resource) {
        case 'oauth':
            require_once 'controllers/OAuthController.php';
            $controller = new OAuthController();
            
            if ($request_parts[$base_index + 2] === 'google' && $request_parts[$base_index + 3] === 'redirect') {
                $controller->redirectToGoogle();
            } else if ($request_parts[$base_index + 2] === 'google' && $request_parts[$base_index + 3] === 'callback') {
                $controller->handleGoogleCallback();
            } else if ($request_parts[$base_index + 2] === 'google' && $request_parts[$base_index + 3] === 'logout') {
                $controller->logout();
            } else {
                echo json_encode(["message" => "Ruta OAuth no encontrada"]);
            }

            break;

        case 'check-auth':
            require_once 'controllers/UserController.php';
            $controller = new UserController();
            
            $controller->getSessionData();
            break;

        case 'login':
            require_once 'controllers/UserController.php';
            $controller = new UserController();
        
            $controller->loginUser();
            break;
    
        case 'logout':
            require_once 'controllers/UserController.php';
            $controller = new UserController();
            
            $controller->logoutUser();
            break;
            
        case 'users':
            require_once 'controllers/UserController.php';
            $controller = new UserController();

            if (isset($request_parts[$base_index + 2]) && isset($request_parts[$base_index + 3])) {
                // Maneja otros parámetros pasados por url si están disponibles

                if ($request_parts[$base_index + 2] === 'id') {
                    $controller->getById($request_parts[$base_index + 3]);
                } else if ($request_parts[$base_index + 2] === 'name') {
                    $controller->searchByName($request_parts[$base_index + 3]);
                } else {
                    echo json_encode(["message" => "Ruta no encontrada"]);
                }

            } else {
                $controller->handleRequest($method);
            }

            break;
        case 'products':
            require_once 'controllers/ProductController.php';
            $controller = new ProductController();
            
            if (isset($request_parts[$base_index + 2]) && isset($request_parts[$base_index + 3])) {
                // Maneja otros parámetros pasados por url si están disponibles

                if ($request_parts[$base_index + 2] === 'id') {
                    $controller->getById($request_parts[$base_index + 3]);
                } else if ($request_parts[$base_index + 2] === 'name') {
                    $controller->searchByName($request_parts[$base_index + 3]);
                } else {
                    echo json_encode(["message" => "Ruta no encontrada"]);
                }

            } else {
                $controller->handleRequest($method);
            }

            break;
        case 'purchases':
            require_once 'controllers/PurchaseController.php';
            $controller = new PurchaseController();

            if (isset($request_parts[$base_index + 2]) && !isset($request_parts[$base_index + 3])) {
                if ($request_parts[$base_index + 2] === 'user' && $method === 'POST') {
                    $controller->getPurchaseByUserId();
                } else {
                    echo json_encode(["message" => "Ruta no encontrada"]);
                }
            } else if (isset($request_parts[$base_index + 2]) && isset($request_parts[$base_index + 3])) {
                // Maneja otros parámetros pasados por url si están disponibles

                if ($request_parts[$base_index + 2] === 'id') {
                    $controller->getById($request_parts[$base_index + 3]);
                } else if ($request_parts[$base_index + 2] === 'userorproductid') {
                    $controller->searchByUserIdOrProductId($request_parts[$base_index + 3]);
                } else {
                    echo json_encode(["message" => "Ruta no encontrada"]);
                }

            } else {
                $controller->handleRequest($method);
            }

            break;
        default:
            echo json_encode(["message" => "Recurso no encontrado"]);
            break;
    }

?>