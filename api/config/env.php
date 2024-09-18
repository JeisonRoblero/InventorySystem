<?php
    require __DIR__ . '/../vendor/autoload.php'; // Incluye el archivo autoload.php generado por Composer.

    use Dotenv\Dotenv; // Importa la clase Dotenv del paquete vlucas/phpdotenv.
    
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Ruta a .env
    $dotenv->load();
?>