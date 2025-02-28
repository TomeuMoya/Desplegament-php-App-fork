<?php

/**
 * Clase Connexio
 *
 * Gestiona la conexión a la base de datos "la_meva_botiga".
 *
 * @author Tomeu Moya
 * @version 1.0.0
 */
class Connexio {
    
    /**
     * Host del servidor de la base de datos.
     * @var string
     */
    private $host = "localhost";

    /**
     * Usuario de la base de datos.
     * @var string
     */
    private $usuario = "root";

    /**
     * Contraseña del usuario de la base de datos.
     * @var string
     */
    private $contraseña = "";

    /**
     * Nombre de la base de datos.
     * @var string
     */
    private $baseDatos = "la_meva_botiga";

    /**
     * Establece una conexión a la base de datos.
     *
     * @return mysqli Objeto de conexión a la base de datos.
     * @throws Exception Si no se puede conectar a la base de datos.
     */
    public function obtenirConnexio() {
        $conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->baseDatos);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }
}

?>
