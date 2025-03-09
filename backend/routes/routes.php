<?php
require_once "../controllers/UserController.php";

$user = new UserController();
$requestMethod = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($path) {
    case '/users': // GET usuarios
        if ($requestMethod === 'GET') {
            echo json_encode($user->getUsers());
        }
        break;

    case '/user': // GET usuario por ID
        if ($requestMethod === 'GET' && isset($_GET['id'])) {
            echo json_encode($user->getUserById($_GET['id']));
        }
        break;

    case '/user/create': // POST usuario
        if ($requestMethod === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($user->createUser($data));
        }
        break;

    case '/user/update': // UPDATE usuario
        if ($requestMethod === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($user->updateUser($data));
        }
        break;

    case '/user/delete': // DELETE usuario
        if ($requestMethod === 'DELETE') {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($user->deleteUser($data['id']));
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Ruta no encontrada"]);
        break;
}
?>
