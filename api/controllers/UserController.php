<?php
require_once 'models/User.php';

class UserController {
    public function handleRequest($method) {
        switch ($method) {
            case 'GET':
                $this->getUsers();
                break;
            case 'POST':
                $this->createUser();
                break;
            case 'PUT':
                $this->updateUser();
                break;
            case 'DELETE':
                $this->deleteUser();
                break;
            default:
                echo json_encode(["message" => "Método no soportado"]);
        }
    }

    // Obtiene todos los usuarios
    public function getUsers() {
        $user = new User();
        $users = $user->getAll();
        echo json_encode($users);
    }

    // Obtiene un usuario por ID
    public function getById($id) {
        $user = new User();
        $userResult = $user->getById($id);
        if ($userResult) {
            echo json_encode($userResult);
        } else {
            echo json_encode(array('message' => 'User not found.'));
        }
    }

    // Busca usuarios por nombre
    public function searchByName($name) {
        $user = new User();
        $users = $user->searchByName($name);
        echo json_encode($users);
    }

    public function getSessionData() {
        session_start();
        if (isset($_SESSION['auth_token']) && isset($_SESSION['user_id'])) {
            echo json_encode([
                "token" => $_SESSION['auth_token'],
                "user_id" => $_SESSION['user_id']
            ]);
        } else {
            echo json_encode(["message" => "No autenticado"]);
        }
    }

    // Método de login
    public function loginUser() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->email) && isset($data->password)) {
            $user = new User();
            $userResult = $user->getByEmail($data->email);
            
            if ($userResult && password_verify($data->password, $userResult['password'])) {
                
                $token = bin2hex(random_bytes(16)); 
                
                // Guarda el token y user_id en la sesión
                $_SESSION['auth_token'] = $token;
                $_SESSION['user_id'] = $userResult['id'];

                echo json_encode([
                    "message" => "Login exitoso",
                    "token" => $token,
                    "user_id" => $userResult['id']
                ]);
            } else {
                echo json_encode(["message" => "Credenciales incorrectas"]);
            }
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Método de login
    public function logoutUser() {
        require_once 'controllers/OAuthController.php';
        $oauth_controller = new OAuthController();
        $oauth_controller->logout();
        session_unset(); // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión del usuario
        echo json_encode(["logouted"=> "true"]);
    }

    // Crea un nuevo usuario
    public function createUser() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->username) && isset($data->email) && isset($data->password)) {
            $user = new User();
            $user->username = $data->username;
            $user->email = $data->email;
            $user->password = isset($data->password) ? password_hash($data->password, PASSWORD_BCRYPT) : null;

            if ($user->create()) {
                $this->loginUser();
            } else {
                echo json_encode(["message" => "Error al crear usuario"]);
            }
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualiza un usuario existente
    public function updateUser() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id) && isset($data->username)) {
            $user = new User();
            $user->id = $data->id;
            $user->username = $data->username;
            $user->email = $data->email ?? null;
            $user->password = isset($data->password) ? password_hash($data->password, PASSWORD_BCRYPT) : null;

            if ($user->update()) {
                echo json_encode(["message" => "Usuario actualizado exitosamente"]);
            } else {
                echo json_encode(["message" => "Error al actualizar usuario"]);
            }
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Elimina un usuario
    public function deleteUser() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id)) {
            $user = new User();
            $user->id = $data->id;

            if ($user->delete()) {
                echo json_encode(["message" => "Usuario eliminado exitosamente"]);
            } else {
                echo json_encode(["message" => "Error al eliminar usuario"]);
            }
        } else {
            echo json_encode(["message" => "ID de usuario no proporcionado"]);
        }
    }
}
?>
