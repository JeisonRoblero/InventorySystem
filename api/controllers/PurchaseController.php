<?php
require_once 'models/Purchase.php';

class PurchaseController {
    public function handleRequest($method) {
        switch ($method) {
            case 'GET':
                $this->getPurchases();
                break;
            case 'POST':
                $this->createPurchase();
                break;
            case 'PUT':
                $this->updatePurchase();
                break;
            case 'DELETE':
                $this->deletePurchase();
                break;
            default:
                echo json_encode(["message" => "Método no soportado"]);
        }
    }

    // Obtiene todas las compras
    public function getPurchases() {
        $purchase = new Purchase();
        $purchases = $purchase->getAll();
        echo json_encode($purchases);
    }

    // Obtiene una compra por ID
    public function getById($id) {
        $purchase = new Purchase();
        $purchaseResult = $purchase->getById($id);
        if ($purchaseResult) {
            echo json_encode($purchaseResult);
        } else {
            echo json_encode(array('message' => 'Purchase not found.'));
        }
    }

    // Busca compras por ID de usuario
    public function getPurchaseByUserId() {
        $data = json_decode(file_get_contents("php://input"));
        $purchase = new Purchase();
        $purchase->user_id = $data->user_id;
        $purchases = $purchase->getByUserId();
        echo json_encode($purchases);
    }

    // Busca compras por ID de usuario o producto
    public function searchByUserIdOrProductId($id) {
        $purchase = new Purchase();
        $purchases = $purchase->searchByUserIdOrProductId($id);
        echo json_encode($purchases);
    }

    // Crea una nueva compra
    public function createPurchase() {
        $data = json_decode(file_get_contents("php://input"));

        $purchase = new Purchase();
        $purchase->user_id = $data->user_id;
        $purchase->product_id = $data->product_id;
        $purchase->quantity = $data->quantity;

        if ($purchase->create()) {
            echo json_encode(["success" => "true"]);
        } else {
            echo json_encode(["message" => "Error al crear la compra"]);
        }
    }

    // Actualiza una compra existente
    public function updatePurchase() {
        $data = json_decode(file_get_contents("php://input"));

        $purchase = new Purchase();
        $purchase->id = $data->id;
        $purchase->user_id = $data->user_id ?? null;
        $purchase->product_id = $data->product_id ?? null;
        $purchase->quantity = $data->quantity ?? null;
        $purchase->status = $data->status ?? null;

        if ($purchase->update()) {
            echo json_encode(["message" => "Compra actualizada exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al actualizar la compra"]);
        }
    }

    // Elimina una compra
    public function deletePurchase() {
        $data = json_decode(file_get_contents("php://input"));

        $purchase = new Purchase();
        $purchase->id = $data->id;

        if ($purchase->delete()) {
            echo json_encode(["message" => "Compra eliminada exitosamente"]);
        } else {
            echo json_encode(["message" => "Error al eliminar la compra"]);
        }
    }
}
?>