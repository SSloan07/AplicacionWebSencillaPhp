<?php 

# Para el debug 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$variablesDeEntorno = parse_ini_file(".env");

# Datos para hacer la conexión con la base de datos
$baseDeDatos = $variablesDeEntorno['BASEDEDATOS'];
$tabla = $variablesDeEntorno['TABLA'];
$usuario = $variablesDeEntorno['USUARIO'];
$contraseña = $variablesDeEntorno['CLAVE'];





# Conexión base de datos 
$conexion = new mysqli("localhost", $usuario, $contraseña, $baseDeDatos);


# Clase Usuario 
class Usuario {

    private $cedula = 0; 
    private $nombre = ""; 
    private $apellidos = ""; 
    private $fechaDeNacimiento = null; 


    public function __construct($cedula,$nombre,$apellidos, $fechaDeNacimiento){
        $this->cedula = $cedula;
        $this->nombre = $nombre; 
        $this->apellidos = $apellidos;
        $this->fechaDeNacimiento = $fechaDeNacimiento ?? '1918-11-11';
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


    function insertarUsuario ($conexion, $tabla){
        $nombre = strtolower($this->nombre);
        $apellidos = strtolower($this->apellidos);

        $this->setNombre($nombre);
        $this->setApellidos($apellidos);

        

        $query = "
            INSERT INTO $tabla (cedula, nombre, apellidos, fechaDeNacimiento)
            VALUES (
                {$this->cedula},
                '{$this->nombre}',
                '{$this->apellidos}',
                '{$this->fechaDeNacimiento}'
            )"
        ;


        $ejecucion = mysqli_query($conexion,$query);
        if (!$ejecucion) {
            die("Error SQL: " . mysqli_error($conexion));
        }

    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $cedula = htmlspecialchars($_POST['cedula']); 

    $nombre = htmlspecialchars($_POST['nombre']); 

    $apellidos = htmlspecialchars($_POST['apellidos']);

    $fechaDeNacimiento = htmlspecialchars($_POST['fechaDeNacimiento']);

    $usuario = new Usuario($cedula, $nombre, $apellidos, $fechaDeNacimiento); 

    $usuario->insertarUsuario($conexion, $tabla);    
};

# Para traer todos los clientes
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $query = "SELECT * FROM $tabla";
    $resultado  = mysqli_query($conexion, $query);
    if (!$resultado) {
        die("Error SQL: " . mysqli_error($conexion));
    }
};
?>




