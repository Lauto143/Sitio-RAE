<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Componente</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Agregar Componente Informático</h1>
    <form action="add_component.php" method="POST">
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
</body>
</html>
