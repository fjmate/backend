<?php
require_once('producto.php');
require_once('usuario.php');

class DB {
    protected static function ejecutaConsulta($sql) {
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn = "mysql:host=localhost;dbname=javiburguermb";
        $usuario = 'dwes';
        $contrasena = 'dwes';
        
		try {
			$dwes = new PDO($dsn, $usuario, $contrasena, $opc);
			$resultado = null;
			if (isset($dwes)) $resultado = $dwes->query($sql);
		}catch (PDOException $e) {
            die("Error: " . $e->getMessage());
		}
        return $resultado;
    }

    public static function obtieneProductos() {
        $sql = "SELECT codigo, nombre, precio, imagen FROM productos;";
        $resultado = self::ejecutaConsulta ($sql);
        $productos = array();

	if($resultado) {
            // Añadimos un elemento por cada producto obtenido
            $row = $resultado->fetch();
            while ($row != null) {
                $productos[] = new Producto($row);
                $row = $resultado->fetch();
            }
	}
        
        return $productos;
    }
    
    public static function obtieneUsuarios() {
        $sql = "SELECT usuario, calle, numero, cp, localidad, provincia FROM usuarios;";
        $resultado = self::ejecutaConsulta ($sql);
        $usuarios = array();

	if($resultado) {
            // Añadimos un elemento por cada usuario obtenido
            $row = $resultado->fetch();
            while ($row != null) {
                $usuarios[] = new Usuario($row);
                $row = $resultado->fetch();
            }
	}
        
        return $usuarios;
    }

    
    public static function obtieneProducto($nombre) {
        $sql = "SELECT codigo, nombre, precio, imagen FROM productos";
        $sql .= " WHERE nombre='" . $nombre . "'";
        $resultado = self::ejecutaConsulta ($sql);
        $producto = null;

	if(isset($resultado)) {
            $row = $resultado->fetch();
            $producto = new Producto($row);
	}
        
        return $producto;    
    }
    
        public static function obtieneUsuario($nombre) {
        $sql = "SELECT usuario, calle, numero, cp, localidad, provincia FROM usuarios";
        $sql .= " WHERE usuario='" . $nombre . "'";
        $resultado = self::ejecutaConsulta ($sql);
        $usuario = null;

	if(isset($resultado)) {
            $row = $resultado->fetch();
            $usuario = new Usuario($row);
	}
        
        return $usuario;    
    }
}

?>
