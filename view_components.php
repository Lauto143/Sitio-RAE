<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$filter = "";
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $filter = "WHERE category = $category";
}

$sql = "SELECT * FROM components $filter ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Componentes</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Componentes Informáticos</h1>
    
    <form method="GET" action="view_components.php">
        <label for="category">Filtrar por Categoría:</label>
        <select id="category" name="category" onchange="this.form.submit()">
            <option value="">Todas</option>
            <option value="1">Procesadores</option>
            <option value="2">Fuentes</option>
            <option value="3">Memorias RAM</option>
            <option value="4">Placa madre</option>
            <!-- Añadir más categorías si es necesario -->
        </select>
    </form>
    
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay componentes disponibles</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="index.php">Volver al inicio</a>
</body>
</html>

<?php
$conn->close();
?>
