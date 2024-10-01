<?php
include 'component_actions.php';

// Manejar agregacion componentes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_component'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    addComponent($name, $category, $description);
}

// Manejar la eliminación de componentes
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteComponent($id);
}

// Filtrar componentes según búsqueda
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $components = searchComponents($searchTerm);
} else {
    $components = getComponents();
}

closeConnection();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

        

    <title>Gestión de Componentes Informáticos</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Gestión de Componentes Informáticos</h1>

    <!-- Formulario para buscar los componentes -->
    <form action="index.php" method="GET">
        <label for="search">Buscar Componente:</label>
        <input type="text" id="search" name="search" placeholder="Nombre o Categoría" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button type="submit">Buscar</button>
    </form>

    <!-- Formulario paa agregar componentes -->
    <form action="index.php" method="POST">
        <input type="hidden" name="add_component" value="1">
        <label for="name">Nombre del Componente:</label>
        <input type="text" id="name" name="name" required>

        <label for="category">Categoría:</label>
        <select id="category" name="category" required>
            <option value="1">Procesadores</option>
            <option value="2">Fuentes</option>
            <option value="3">Memorias RAM</option>
            <option value="4">Placa madre</option>

            <!-- Añadir más categorías según sea necesario -->
        </select>
        
        <label for="description">Descripción:</label>
        <textarea id="description" name="description" required></textarea>
        
        <button type="submit">Agregar</button>
    </form>
    </form>

    <!-- La lista de componentes -->
    <h2>Lista de Componentes</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($components->num_rows > 0) {
                while ($row = $components->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "<td>
                        <a href='index.php?delete=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este componente?\")'>Eliminar</a>
                        <a href='edit_component.php?id=" . $row['id'] . "'>Editar</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron componentes</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
