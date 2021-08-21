<?php

class Conexion {

    public static function ejecutaConsulta($sql) {
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn = "mysql:host=localhost;dbname=dwes";
        $usuario = 'dwes';
        $contrasena = 'dwes';

        try {
            $dwes = new PDO($dsn, $usuario, $contrasena, $opc);
            $resultado = null;
            if (isset($dwes))
                $resultado = $dwes->query($sql);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        return $resultado;
    }

    public static function ejecutaConsultaPlus($sql) {
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn = "mysql:host=localhost;dbname=videojuegos";
        $usuario = 'dwes';
        $contrasena = 'dwes';

        try {
            $dwes = new PDO($dsn, $usuario, $contrasena, $opc);
            $resultado = null;
            if (isset($dwes))
                $resultado = $dwes->query($sql);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        return $resultado;
    }

    public static function obtieneProductos() {
        $sql = "SELECT cod, nombre_corto, nombre, PVP FROM producto;";
        $resultado = self::ejecutaConsulta($sql);
        $productos = array();

        if ($resultado) {
            // Añadimos un elemento por cada producto obtenido
            $row = $resultado->fetch();
            while ($row != null) {
                $productos[] = new Producto($row);
                $row = $resultado->fetch();
            }
        }

        return $productos;
    }

    public static function obtieneProducto($codigo) {
        $sql = "SELECT cod, nombre_corto, nombre, PVP FROM producto";
        $sql .= " WHERE cod='" . $codigo . "'";
        $resultado = self::ejecutaConsulta($sql);
        $producto = null;

        if (isset($resultado)) {
            $row = $resultado->fetch();
            $producto = new Producto($row);
        }

        return $producto;
    }

    public static function verificaCliente($nombre, $contrasena) {
        $sql = "SELECT usuario FROM usuarios ";
        $sql .= "WHERE usuario='$nombre' ";
        $sql .= "AND contrasena='" . md5($contrasena) . "';";
        $resultado = self::ejecutaConsulta($sql);
        $verificado = false;

        if (isset($resultado)) {
            $fila = $resultado->fetch();
            if ($fila !== false)
                $verificado = true;
        }
        return $verificado;
    }

    public static function creaTablas() {
        $sql = "CREATE DATABASE IF NOT EXISTS VIDEOJUEGOS;USE VIDEOJUEGOS;"
                . "drop table if EXISTS juegos;drop table if exists estudios;drop table if EXISTS consolas;"
                . "Create table if not exists consolas(
                          Idcon int not null AUTO_INCREMENT,
                            nomconsola varchar(20) not null,
                            Primary Key (Idcon)
                            ); Create table if not exists estudios(
                            Idest int not null AUTO_INCREMENT,
                            Nomestudio varchar(20) not null,
                            Primary Key (Idest)
                            ); Create table if not exists juegos(
                            Idjuego int not null AUTO_INCREMENT ,
                            Idconsola int not null,
                            Idestudio int not null,
                            nomjuego varchar(40),
                            Primary Key (Idjuego),
                            CONSTRAINT fk_consola FOREIGN KEY (Idconsola) REFERENCES consolas (Idcon),
                            CONSTRAINT fk_estudio FOREIGN KEY (Idestudio) REFERENCES estudios (Idest));
                            INSERT INTO `consolas`(`nomconsola`) VALUES ('playstation'),('playstation 2'),('playstation 3'),('wii');
                            INSERT INTO `estudios`(`nomestudio`) VALUES ('naughty dog'),('nintendo'),('activision'),('ea');
                            INSERT INTO `juegos`(`Idconsola`, `Idestudio`, `nomjuego`) VALUES (1, 1, 'crash bandicoot'),(4,2,'super mario galaxy'),(3,4,'fifa 18'),(4,2,'donkey kong');";
        self::ejecutaConsulta($sql);
    }

    public static function eliminaTabla($tabla) {
        if ($tabla == "consolas") {
            $sql = "ALTER TABLE juegos DROP FOREIGN KEY fk_consola";
            self::ejecutaConsultaPlus($sql);
            $sql = "DROP TABLE consolas";
            self::ejecutaConsultaPlus($sql);
            echo "<script>alert('Tabla consolas borrada correctamente');</script>";
            header("refresh:0; url=eliminar.php");
        } else if ($tabla == "estudios") {
            $sql = "ALTER TABLE juegos DROP FOREIGN KEY fk_estudio";
            self::ejecutaConsultaPlus($sql);
            $sql = "DROP TABLE estudios";
            self::ejecutaConsultaPlus($sql);
            echo "<script>alert('Tabla estudios borrada correctamente');</script>";
            header("refresh:0; url=eliminar.php");
        } else if ($tabla == "juegos") {
            $sql = "DROP TABLE juegos";
            self::ejecutaConsultaPlus($sql);
            echo "<script>alert('Tabla juegos borrada correctamente');</script>";
            header("refresh:0; url=eliminar.php");
        }
    }

    public static function ConexionBasica() {
        $host = "localhost";
        $usuario = "dwes";
        $password = "dwes";
        $bd = "videojuegos";

        $conexion = mysqli_connect($host, $usuario, $password, $bd);

        if (!$conexion) {
            echo "No se ha podido realizar la conexión";
        }
        return $conexion;
    }

    public static function eliminarJuego($dato, $tabla) {
        if ($tabla == "consolas") {
            $sql = "ALTER TABLE JUEGOS DROP CONSTRAINT IF EXISTS FK_CONSOLA;DELETE FROM `consolas` WHERE `consolas`.`Idcon` = '{$dato}'";
            if (self::ejecutaConsultaPlus($sql)) {
                echo "<script>alert('Consola borrada correctamente');</script>";
                header("refresh:0; url=eliminardatos.php");
            } else {
                echo "<script>alert('Error al eliminar la consola');</script>";
            }
        } else if ($tabla == "estudios") {
            $sql = "ALTER TABLE JUEGOS DROP CONSTRAINT IF EXISTS FK_ESTUDIO;DELETE FROM `estudios` WHERE `estudios`.`Idest` = '{$dato}'";
            if (self::ejecutaConsultaPlus($sql)) {
                echo "<script>alert('Estudio borrado correctamente');</script>";
                header("refresh:0; url=eliminardatos.php");
            } else {
                echo "<script>alert('Error al eliminar el estudio');</script>";
            }
        } else if ($tabla == "juegos") {
            $sql = "DELETE FROM `juegos` WHERE `juegos`.`Idjuego` = '{$dato}'";
            if (self::ejecutaConsultaPlus($sql)) {
                echo "<script>alert('Juego borrado correctamente');</script>";
                header("refresh:0; url=eliminardatos.php");
            } else {
                echo "<script>alert('Error al eliminar el juego');</script>";
            }
        }
    }

    public static function insertarJuego($consola, $estudio, $nombre) {
        //Para hacer el insert necesito el idconsola y el idestudio
        $sql = "SELECT Idcon FROM `consolas` WHERE nomconsola = '$consola'";
        $resultado1 = self::ejecutaConsultaPlus($sql);
        //Guardamos el registro en la variable $fila
        $fila = $resultado1->fetch(PDO::FETCH_ASSOC);
        //El resultado de la consulta estará en Idcon, entonces:
        $resulconsola = $fila['Idcon'];

        $sql = "SELECT Idest FROM `estudios` WHERE nomestudio = '$estudio'";
        $resultado2 = self::ejecutaConsultaPlus($sql);
        //Guardamos el registro en la variable $fila
        $fila2 = $resultado2->fetch(PDO::FETCH_ASSOC);
        //El resultado de la consulta estará in Idest, entonces:
        $resulestudio = $fila2['Idest'];

        $sql = "INSERT INTO `juegos`(`Idjuego`, `Idconsola`, `Idestudio`, `nomjuego`) VALUES (null,$resulconsola,$resulestudio,'$nombre')";
        self::ejecutaConsultaPlus($sql);
        echo "<script>alert('Juego insertado correctamente');</script>";
        header("refresh:0; url=insertardatos.php");
    }

    public static function insertarUsuario($nombre, $password) {
        $sql = "USE DWES; INSERT INTO `usuarios`(`usuario`, `contrasena`) VALUES ('{$nombre}','" . md5($password) . "')";
        self::ejecutaConsultaPlus($sql);
        echo "<script>alert('Administrador insertado correctamente');</script>";
        header("refresh:0; url=insertarusuarios.php");
    }

    public static function eliminarDatoUsuario($datoeliminar, $tablaasig) {
        if ($tablaasig == "consolas") {
            $sql = "ALTER TABLE JUEGOS DROP CONSTRAINT IF EXISTS FK_CONSOLA;DELETE FROM `consolas` WHERE `consolas`.`Idcon` = '{$datoeliminar}'";
            Self::ejecutaConsulaPlus($sql);
            echo "<script>alert('Consola borrada correctamente');</script>";
            header("refresh:0; url=eliminarusuario.php");
        } else if ($tablaasig == "estudios") {
            $sql = "ALTER TABLE JUEGOS DROP CONSTRAINT IF EXISTS FK_ESTUDIO; DELETE FROM `estudios` WHERE `estudios`.`Idest` = '{$datoeliminar}'";
            self::ejecutaConsultaPlus($sql);
            echo "<script>alert('Estudio borrado correctamente');</script>";
            header("refresh:0; url=eliminarusuario.php");
        } else if ($tablaasig == "juegos") {
            $sql = "DELETE FROM `juegos` WHERE `juegos`.`Idjuego` = '{$datoeliminar}'";
            self::ejecutaConsultaPlus($sql);
            echo "<script>alert('Juego borrado correctamente');</script>";
            header("refresh:0; url=eliminarusuario.php");
        }
    }

    public static function insertarTablaUsuario($nombre, $tabla) {

        if ($tabla == "consolas") {
            $sql = "INSERT INTO `$tabla`(`Idcon`, `nomconsola`) VALUES (null,'$nombre')";
            self::ejecutaConsultaPlus($sql);
            echo "<script>alert('Consola insertada correctamente');</script>";
            header("refresh:0; url=insertarusuario.php");
        } else if ($tabla == "estudios") {
            $sql = "INSERT INTO `$tabla`(`Idest`, `nomestudio`) VALUES (null,'$nombre')";
            self::ejecutaConsultaPlus($sql);
            echo "<script>alert('Estudio insertado correctamente');</script>";
            header("refresh:0; url=insertarusuario.php");
        }
    }

    public static function insertarJuegoUsuario($consola, $estudio, $nombre) {
        //Para hacer el insert necesito el idconsola y el idestudio
        $sql = "SELECT Idcon FROM `consolas` WHERE nomconsola = '$consola'";
        $resultado1 = self::ejecutaConsultaPlus($sql);
        //Guardamos el registro en la variable $fila
        $fila = $resultado1->fetch(PDO::FETCH_ASSOC);
        //El resultado de la consulta estará en Idcon, entonces:
        $resulconsola = $fila['Idcon'];

        $sql = "SELECT Idest FROM `estudios` WHERE nomestudio = '$estudio'";
        $resultado2 = self::ejecutaConsultaPlus($sql);
        //Guardamos el registro en la variable $fila
        $fila2 = $resultado2->fetch(PDO::FETCH_ASSOC);
        //El resultado de la consulta estará in Idest, entonces:
        $resulestudio = $fila2['Idest'];

        $sql = "INSERT INTO `juegos`(`Idjuego`, `Idconsola`, `Idestudio`, `nomjuego`) VALUES (null,$resulconsola,$resulestudio,'$nombre')";
        self::ejecutaConsultaPlus($sql);
        echo "<script>alert('Juego insertado correctamente');</script>";
        header("refresh:0; url=insertarusuario.php");
    }

    public static function modificarDatoUsuario($datomodificar, $nuevonombre, $tablaasig) {
        if ($tablaasig == "consolas") {
            $sql = "UPDATE `consolas` SET `nomconsola`='$nuevonombre' WHERE idcon='$datomodificar'";
            self::ejecutaConsultaPlus($sql);
            echo "<script>alert('Consola modificada correctamente');</script>";
            header("refresh:0; url=modificarusuario.php");
        } else if ($tablaasig == "estudios") {
            $sql = "UPDATE `estudios` SET `nomestudio`='$nuevonombre' WHERE idest='$datomodificar'";
            self::ejecutaConsultaPlus($sql);
            echo "<script>alert('Estudio modificado correctamente');</script>";
            header("refresh:0; url=modificarusuario.php");
        } else if ($tablaasig == "juegos") {
            $sql = "UPDATE `juegos` SET `nomjuego`='$nuevonombre' WHERE idjuego='$datomodificar'";
            self::ejecutaConsultaPlus($sql);
            echo "<script>alert('Juego modificado correctamente');</script>";
            header("refresh:0; url=modificarusuario.php");
        }
    }

    public static function numeroJuegos($idcon) {
        $sql = "SELECT count(*) total FROM `juegos` WHERE Idconsola='{$idcon}'";
        $resultado = self::ejecutaConsultaPlus($sql);
        $numero = $resultado->fetch(PDO::FETCH_ASSOC);
        return $numero;
    }

    public static function consolaJuegos($idcon) {
        $sql = "SELECT nomconsola FROM `consolas` WHERE Idcon='{$idcon}'";
        $resultado2 = self::ejecutaConsultaPlus($sql);
        $numero2 = $resultado2->fetch(PDO::FETCH_ASSOC);
        return $numero2;
    }

    public static function juegosporLetra($letra) {
        $sql = "Select * from juegos where nomjuego like '{$letra}%'";
        $resultado = self::ejecutaConsultaPlus($sql);
        for ($set = array(); $row = $resultado->fetch(pdo::FETCH_ASSOC); $set[] = $row)
            ;
        return $set;
    }

}

?>
