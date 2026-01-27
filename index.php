<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>App sencillita PHP</title>
    </head>
    <body>
        <h1>Hola de nuevo estimado cliente</h1>
        <div>
            <h3>Ingrese sus datos:</h3>
            <form action="app.php" method="POST">

                <input type="number" name="cedula" placeholder="Cedula" required></br>

                <input type="text" name="nombre" 
                placeholder="Nombre" required></br>

                <input type="text" name="apellidos" placeholder="Apellidos" required></br>

                <input type="date" name="fechaDeNacimiento" placeholder="Fecha de nacimiento"></br>

                <button type="submit">Enviar</button>
            </form>
            <a href="listaUsuarios.php">
                <button>Ver clientes</button>
            </a>
        </div>
    </body>
</html>