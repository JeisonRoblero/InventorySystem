<?php
require_once 'models/Product.php';

class ProductController {
    public function handleRequest($method) {
        switch ($method) {
            case 'GET':
                $this->getProducts();
                break;
            case 'POST':
                $this->createProduct();
                break;
            case 'PUT':
                $this->updateProduct();
                break;
            case 'DELETE':
                $this->deleteProduct();
                break;
            default:
                echo json_encode(["message" => "Método no soportado"]);
        }
    }

    // Obtiene todos los productos
    public function getProducts() {
        $product = new Product();
        $products = $product->getAll();
        echo json_encode($products);
    }

    // Obtiene un producto por ID
    public function getById($id) {
        $product = new Product();
        $productResult = $product->getById($id);
        if ($productResult) {
            echo json_encode($productResult);
        } else {
            echo json_encode(array('message' => 'Product not found.'));
        }
    }

    // Busca productos por nombre
    public function searchByName($name) {
        $product = new Product();
        $products = $product->searchByName($name);
        echo json_encode($products);
    }

    // Crea un nuevo producto
    public function createProduct() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->name) && isset($data->price)) {
            $product = new Product();
            $product->name = $data->name;
            $product->description = $data->description ?? null;
            $product->picture = $data->picture ?? null;
            $product->price = $data->price;
            $product->stock = $data->stock ?? 0;

            if ($product->create()) {
                echo json_encode(["success" => "true"]);
            } else {
                echo json_encode(["message" => "Error al crear producto"]);
            }
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualiza un producto existente
    public function updateProduct() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id) && isset($data->name) && isset($data->price)) {
            $product = new Product();
            $product->id = $data->id;
            $product->name = $data->name;
            $product->description = $data->description ?? null;
            $product->picture = $data->picture ?? null;
            $product->price = $data->price;
            $product->stock = $data->stock ?? 0;

            if ($product->update()) {
                echo json_encode(["success" => "true"]);
            } else {
                echo json_encode(["message" => "Error al actualizar producto"]);
            }
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Elimina un producto
    public function deleteProduct() {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id)) {
            $product = new Product();
            $product->id = $data->id;

            if ($product->delete()) {
                echo json_encode(["success" => "true"]);
            } else {
                echo json_encode(["message" => "Error al eliminar producto"]);
            }
        } else {
            echo json_encode(["message" => "ID de producto no proporcionado"]);
        }
    }
}
?>
