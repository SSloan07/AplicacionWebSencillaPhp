<?php 

# Datos para hacer la conexión con la base de datos
$baseDeDatos = getenv('BASEDEDATOS');
$tabla = getenv('TABLA');
$usuario = getenv('USUARIO');
$contraseña = getenv('CLAVE');

# Conexión base de datos 
$mysqli = new mysqli("localhost", $usuario, $contraseña, $baseDeDatos);

if (!$mysqli) {
    die("Error de conexión: " . mysqli_connect_error());
}


# Clase Usuario 
class Usuario {
    public $cedula = 0; 
    public $nombre = ""; 
    public $apellidos = ""; 
    public $fechaDeNacimiento = '1918-11-11'; 
    public function __construct($cedula,$nombre,$apellidos){
        $this->cedula = $cedula;
        $this->nombre = $nombre; 
        $this->apellidos = $apellidos;
    }
    # Nombre

    public function getNombre (){
        return $this->nombre; 
    }
    public function setNombre ($nombre){
        $this->nombre = $nombre; 
    }

    # Apellidos 
    
    public function setApellidos ($apellidos){
        $this->apellidos = $apellidos; 
    }
    public function getApellidos (){
        return $this->apellidos; 
    }
}


function insertarUsuario ($usuario){
    $nombre = strtolower($usuario->nombre);
    $apellidos = strtolower($usuario->apellidos);

    $usuario->setNombre($nombre);
    $usuario->setApellidos($apellidos);

    $query = "
        INSERT INTO usuario (cedula, nombre, apellidos, fechaDeNacimiento)
        VALUES (
            {$usuario->cedula},
            '{$usuario->nombre}',
            '{$usuario->apellidos}',
            '{$usuario->fechaDeNacimiento}'
        )
    ";

    $ejecucion = mysqli_query($mysqli,$query);

    if (!mysqli_query($mysqli, $query)) {
        die("Error SQL: " . mysqli_error($mysqli));
    }
};