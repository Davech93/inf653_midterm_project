<?php
header('Access-Control-Allow-Origin : dpg-cg8eukqk728pus4qm5q0-a.oregon-postgres.render.com');
header('Access-Control-Allow-Credentials : true');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}
?>