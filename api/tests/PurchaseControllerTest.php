<?php
use PHPUnit\Framework\TestCase;

class PurchaseControllerTest extends TestCase {
    protected $controller; // Almacena la instancia del controlador
    protected $mocked = false; // Indica si se ha simulado la entrada

    // Se ejecuta antes de cada prueba para preparar el entorno
    protected function setUp(): void {
        require_once './controllers/PurchaseController.php'; // Incluye el archivo del controlador de compras
        $this->controller = new PurchaseController(); // Crea una nueva instancia del controlador
    }

    // Prueba para manejar solicitudes GET y obtener todas las compras
    public function testHandleRequestGetPurchases() {
        ob_start(); // Comienza a capturar la salida
        $this->controller->handleRequest('GET'); // Llama al método para procesar solicitudes GET
        $output = ob_get_clean(); // Captura la salida generada

        // Verifica que la salida sea un JSON válido
        $this->assertJson($output); // Comprueba que la salida sea un JSON (estas aserciones las incluyen la biblioteca de PHPUnit)
        $purchases = json_decode($output, true); // Decodifica el JSON para convertirlo en un array de clave valor
        $this->assertIsArray($purchases); // Asegura que la salida sea un array
    }

    // Prueba para crear una nueva compra
    public function testCreatePurchase() {
        $_SERVER['REQUEST_METHOD'] = 'POST'; // Establece el método de la solicitud a POST

        $data = json_encode([ // Crea un conjunto de datos para una nueva compra
            "user_id" => 1, // ID del usuario
            "product_id" => 2, // ID del producto
            "quantity" => 3 // Cantidad del producto
        ]);

        // Simula la entrada de datos como si vinieran de php://input
        $this->mockPhpInput($data); // Configura los datos de entrada simulados

        ob_start(); // Comienza a capturar la salida
        $this->controller->handleRequest('POST'); // Llama al método para procesar solicitudes POST
        $output = ob_get_clean(); // Captura la salida generada

        // Verifica que la salida sea un JSON y contenga la clave 'success'
        $this->assertJson($output); // Comprueba que la salida sea un JSON válido
        $response = json_decode($output, true); // Decodifica el JSON para convertirlo en un array
        $this->assertArrayHasKey('success', $response); // Verifica que la respuesta incluya la clave 'success'
    }

    // Prueba para actualizar una compra existente
    public function testUpdatePurchase() {
        $_SERVER['REQUEST_METHOD'] = 'PUT'; // Establece el método de la solicitud a PUT

        $data = json_encode([ // Crea un conjunto de datos para actualizar una compra
            "id" => 1, // ID de la compra a actualizar
            "user_id" => 1, // ID del usuario
            "product_id" => 2, // ID del producto
            "quantity" => 5, // Nueva cantidad del producto
            "status" => "completed" // Nuevo estado de la compra
        ]);

        $this->mockPhpInput($data); // Configura los datos de entrada simulados

        ob_start(); // Comienza a capturar la salida
        $this->controller->handleRequest('PUT'); // Llama al método para procesar solicitudes PUT
        $output = ob_get_clean(); // Captura la salida generada

        // Verifica que la salida sea un JSON y que contenga el mensaje de éxito correcto
        $this->assertJson($output); // Comprueba que la salida sea un JSON válido
        $response = json_decode($output, true); // Decodifica el JSON para convertirlo en un array
        $this->assertEquals("Compra actualizada exitosamente", $response['message']); // Verifica que el mensaje sea el esperado
    }

    // Prueba para eliminar una compra
    public function testDeletePurchase() {
        $_SERVER['REQUEST_METHOD'] = 'DELETE'; // Establece el método de la solicitud a DELETE

        $data = json_encode([ // Crea un conjunto de datos para eliminar una compra
            "id" => 1 // ID de la compra a eliminar
        ]);

        $this->mockPhpInput($data); // Configura los datos de entrada simulados

        ob_start(); // Comienza a capturar la salida
        $this->controller->handleRequest('DELETE'); // Llama al método para procesar solicitudes DELETE
        $output = ob_get_clean(); // Captura la salida generada

        // Verifica que la salida sea un JSON y que contenga el mensaje de éxito correcto
        $this->assertJson($output); // Comprueba que la salida sea un JSON válido
        $response = json_decode($output, true); // Decodifica el JSON para convertirlo en un array
        $this->assertEquals("Compra eliminada exitosamente", $response['message']); // Verifica que el mensaje sea el esperado
    }

    // Método para simular la entrada php://input (Mocks es algo que incluye la biblioteca de PHPUnit)
    private function mockPhpInput($data) {
        // Solo registra si no se ha hecho antes
        if (!$this->mocked) {
            stream_wrapper_unregister("php"); // Desregistra la entrada original de PHP
            stream_wrapper_register("php", "MockPhpStream"); // Registra la entrada simulada
            $this->mocked = true; // Marca que se ha registrado la simulación
        }
        MockPhpStream::$data = $data; // Asigna los datos a la clase simulada
    }

    protected function tearDown(): void {
        // Restaura la entrada original de PHP después de cada prueba
        if ($this->mocked) {
            stream_wrapper_restore("php"); // Restaura la entrada original
            $this->mocked = false; // Marca que se ha desregistrado la simulación
        }
    }
}

// Clase que simula la entrada de php://input
class MockPhpStream {
    public static $data; // Almacena los datos simulados
    private $index; // Almacena la posición actual de lectura

    public function stream_open() {
        $this->index = 0; // Inicializa la posición de lectura
        return true; // Indica que la simulación se abrió correctamente
    }

    public function stream_read($count) {
        // Lee los datos simulados del flujo
        $data = substr(self::$data, $this->index, $count); // Obtiene los bytes especificados
        $this->index += strlen($data); // Actualiza la posición de lectura
        return $data; // Devuelve los datos leídos
    }

    public function stream_eof() {
        // Verifica si se ha llegado al final de los datos simulados
        return $this->index >= strlen(self::$data); // Retorna true si se ha leído todo
    }

    public function stream_stat() {
        // Esta función devuelve estadísticas sobre el flujo.
        // En este caso, no se necesita información específica, por lo que devuelve un array vacío.
        // Un array vacío indica que no hay estadísticas disponibles para este flujo que es simulado.
        return [];
    }
}
?>
