<?php
    require 'app.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de clientes</title>
</head>
<body>
    <div>
        <h1>Estos son nuestros clientes</h1>
        <div>
            <table>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha de Nacimiento</th>
                </tr>
                <?php while ($usuario = mysqli_fetch_assoc($resultado)) : ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['cedula']) ?></td>
                        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                        <td><?= htmlspecialchars($usuario['fechaDeNacimiento']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            <a href="index.php">
                <button>Insertar cliente</button>
            </a>
        </div>
    </div>
</body>
</html>
