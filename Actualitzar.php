<?php

/**
 * Archivo para actualizar productos en la base de datos.
 *
 * Este script gestiona la actualización de productos en la base de datos.
 * Utiliza la clase `Connexio` para la conexión a la base de datos.
 *
 * @author Tomeu Moya
 * @version 1.0.0
 */

require_once('Connexio.php');

/**
 * Clase Actualitzar
 *
 * Permite actualizar un producto en la base de datos.
 */
class Actualitzar {
    
    /**
     * Método para actualizar un producto en la base de datos.
     *
     * @param int    $id          ID del producto a actualizar.
     * @param string $nom         Nuevo nombre del producto.
     * @param string $descripcio  Nueva descripción del producto.
     * @param float  $preu        Nuevo precio del producto.
     * @param int    $categoria   ID de la nueva categoría del producto.
     * @return void
     */
    public function actualizar($id, $nom, $descripcio, $preu, $categoria) {
        // Verifica si todos los campos requeridos están presentes
        if (!isset($id) || !isset($nom) || !isset($descripcio) || !isset($preu) || !isset($categoria)) {
            echo '<p>Se requieren todos los campos para actualizar el producto.</p>';
            return;
        }

        // Crea una instancia de la clase de conexión
        $conexionObj = new Connexio();
        // Obtiene la conexión a la base de datos
        $conexion = $conexionObj->obtenirConnexio();

        // Escapa las variables para prevenir SQL injection
        $id = $conexion->real_escape_string($id);
        $nom = $conexion->real_escape_string($nom);
        $descripcio = $conexion->real_escape_string($descripcio);
        $preu = $conexion->real_escape_string($preu);
        $categoria = $conexion->real_escape_string($categoria);

        // Construye la consulta SQL de actualización
        $consulta = "UPDATE productes
                     SET nom = '$nom', descripció = '$descripcio', preu = '$preu', categoria_id = '$categoria'
                     WHERE id = '$id'";

        // Ejecuta la consulta y redirige a la página principal si tiene éxito
        if ($conexion->query($consulta) === TRUE) {
            header('Location: Principal.php');
            exit();
        } else {
            // Muestra un mensaje de error si la consulta falla
            echo '<p>Error al actualizar el producto: ' . $conexion->error . '</p>';
        }

        // Cierra la conexión a la base de datos
        $conexion->close();
    }
}

// Obtiene los valores del formulario (si existen)

/**
 * ID del producto recibido desde el formulario.
 * 
 * @var int|null
 */
$id = isset($_POST['id']) ? $_POST['id'] : null;

/**
 * Nombre del producto recibido desde el formulario.
 * 
 * @var string|null
 */
$nom = isset($_POST['nom']) ? $_POST['nom'] : null;

/**
 * Descripción del producto recibida desde el formulario.
 * 
 * @var string|null
 */
$descripcio = isset($_POST['descripcio']) ? $_POST['descripcio'] : null;

/**
 * Precio del producto recibido desde el formulario.
 * 
 * @var float|null
 */
$preu = isset($_POST['preu']) ? $_POST['preu'] : null;

/**
 * ID de la categoría del producto recibido desde el formulario.
 * 
 * @var int|null
 */
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;

// Crea una instancia de la clase Actualitzar y llama al método actualizar
$actualizarProducto = new Actualitzar();
$actualizarProducto->actualizar($id, $nom, $descripcio, $preu, $categoria);

?>
