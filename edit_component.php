<?php
include 'component_actions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $component = getComponentById($id);

    if (!$component) {
        echo "Componente no encontrado";
        exit();
    }
}

// Manejar la actualización de componentes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_component'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    updateComponent($id, $name, $category, $description);
    header("Location: index.php");
    exit();
}

closeConnection();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Componente</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Editar Componente Informático</h1>

    <form action="edit_component.php" method="POST">
        <input type="hidden" name="edit_component" value="1">
        <input type="hidden" name="id" value="<?php echo $component['id']; ?>">

        <label for="name">Nombre del Componente:</label>
        <input type="text" id="name" name="name" value="<?php echo $component['name']; ?>" required>

        <label for="category">Categoría:</label>
        <select id="category" name="category" required>
            <option value="1" <?php if ($component['category'] == 1) echo 'selected'; ?>>Procesadores</option>
            <option value="2" <?php if ($component['category'] == 2) echo 'selected'; ?>>Fuentes</option>
            <option value="3" <?php if ($component['category'] == 3) echo 'selected'; ?>>Memorias RAM</option>
            <option value="4" <?php if ($component['category'] == 3) echo 'selected'; ?>>Placa madre</option>
            <!-- Aca podemos seguir poniendo categorias -->
        </select>

        <label for="description">Descripción:</label>
        <textarea id="description" name="description" required><?php echo $component['description']; ?></textarea>

        <button type="submit">Actualizar</button>
    </form>

    <button><a href="index.php">Volver</a></button>
</body>
</html>
