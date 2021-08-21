<?php
class BD {
    //Conectamos a la BD
    public static function conectar() {
        $servidor = 'localhost';
        $usuario = 'dwes';
        $password = 'dwes';
        $BD = 'centrodia';

        $conexion = new mysqli();
        $conexion->connect($servidor, $usuario, $password, $BD);

        $error = $conexion->connect_errno;

        if ($error != null) {
            echo "<p>Error $error en la conexión: $conexion->connect_error</p>";
            exit();
        }
        return $conexion;
    }

    private static function conectarServidor() {
        $servidor = 'localhost';
        $usuario = 'dwes';
        $password = 'dwes';

        $conexion = new mysqli($servidor, $usuario, $password);
        return $conexion;
    }

    public static function desconectar($conexion) {

        if (!$conexion->close()) {
            echo "Error al desconectar de la BD.";
            exit();
        }
    }

    public static function ejecutarConsulta($sql) {
        $conexion = self::conectar();
        $conexion->autocommit(false);

        if (isset($conexion)) {
            $resultado = $conexion->query($sql);
        }

        if (!$resultado) {
            echo($conexion->error);
        }

        $conexion->commit();
        self::desconectar($conexion);
        return $resultado;
    }

    public static function borrarDatos($accion, $datos) {

        $dato = $datos->getDato();

        switch ($accion) {
            case 'usuario':
                $sql = "DELETE FROM usuarios WHERE idUsuario = '" . $dato[0] . "'";
                break;
            case 'informacion':
                $sql = "DELETE FROM informacion WHERE nombre = '" . $dato[0] . "'";
                break;
            default:
                break;
        }

        $resultado = self::ejecutarConsulta($sql);

        if ($resultado) {
            echo "<script type='text/javascript'>alert('Datos borrados de la BD');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error al borrar datos');</script>";
        }
    }

    public static function modificarDatos($accion, $datos) {

        $dato = $datos->getDato();

        switch ($accion) {
            case "direccion":
                $sql = "UPDATE usuarios SET direccion = '" . $dato[1] .
                        "' WHERE idUsuario = '" . $dato[0] . "'";
                break;
            case "direccionC":
                $sql = "UPDATE informacion SET direccion = '" . $dato[1] .  
                    "' WHERE nombre = '" . $dato[0] . "'";
                break;
            default:
                break;
        }

        $resultado = self::ejecutarConsulta($sql);

        if ($resultado) {
            echo "<script type='text/javascript'>alert('Datos modificados de la BD');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error al modificar los datos');</script>";
        }
    }

    public static function insertarDatos($accion, $datos) {
        $dato = $datos->getDato();
        switch ($accion) {
            case 'usuario':
                $sql = "INSERT INTO `usuarios` (`nombre`, `apellidos`, `telefono`, `direccion`) "
                        . "VALUES ('" . $dato[0] . "', '" . $dato[1] . "', '" . $dato[2] . "', '" . $dato[3] . "')";
                break;
            case 'informacion':
                $sql = "INSERT INTO `informacion` (`nombre`, `direccion`) "
                        . "VALUES ('" . $dato[0] . "', '" . $dato[1] . "')";
                break;
        }
        $resultado = self::ejecutarConsulta($sql);

        if ($resultado) {
            echo "<script type='text/javascript'>alert('Datos insertados en la BD');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error al insertar los datos');</script>";
        }
    }

}
