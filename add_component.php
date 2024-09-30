<?php
$servername = "localhost";
$username = "root"; // cambiar si es necesario
$password = ""; // cambiar si es necesario
$dbname = "final";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $sql = "INSERT INTO components (name, category, description) VALUES ('$name', '$category', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo componente agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<a href="index.php">Volver al inicio</a>
