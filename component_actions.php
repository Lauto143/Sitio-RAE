<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "final";

// Crear la conexxión con la bs
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Para buscar componentes segun nombre y/p categoria
function searchComponents($term) {
    global $conn;
    $term = $conn->real_escape_string($term);
    $sql = "SELECT * FROM components WHERE name LIKE '%$term%' OR category LIKE '%$term%' ORDER BY created_at DESC";
    return $conn->query($sql);
}


// Agregar componentess
function addComponent($name, $category, $description) {
    global $conn;
    $sql = "INSERT INTO components (name, category, description) VALUES ('$name', '$category', '$description')";
    return $conn->query($sql);
}

// Borrar algun componente
function deleteComponent($id) {
    global $conn;
    $sql = "DELETE FROM components WHERE id = $id";
    return $conn->query($sql);
}

// Editar componente
function updateComponent($id, $name, $category, $description) {
    global $conn;
    $sql = "UPDATE components SET name='$name', category='$category', description='$description' WHERE id=$id";
    return $conn->query($sql);
}

// Obtener todos los componentes
function getComponents() {
    global $conn;
    $sql = "SELECT * FROM components ORDER BY created_at DESC";
    return $conn->query($sql);
}

// Obtener un componente por el ID
function getComponentById($id) {
    global $conn;
    $sql = "SELECT * FROM components WHERE id = $id";
    return $conn->query($sql)->fetch_assoc();
}

// Cerrar conexión
function closeConnection() {
    global $conn;
    $conn->close();
}
?>
