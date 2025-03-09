<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../routes/routes.php'; 
echo "Ruta: " . $_SERVER['REQUEST_URI'];
echo "Método: " . $_SERVER['REQUEST_METHOD'];
?>
