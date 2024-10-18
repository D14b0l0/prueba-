<?php
    class Producto{
        function __construct()
        {
            require_once('conexion.php');
            $this->conexion=new Conexion();
        }

        function mostrar(){
            $sql="SELECT * FROM producto";
            $respuesta=$this->conexion->query($sql);
            return $respuesta;
        }

        function mostrarPorCat($fkcategoria){
            $sql="SELECT * FROM producto WHERE fkcategoria='{$fkcategoria}'";
            $respuesta=$this->conexion->query($sql);
            return $respuesta;
        }

        function mostrarPorId($idproducto){
            $sql="SELECT * FROM producto p LEFT JOIN foto f ON f.fkproducto=p.idproducto WHERE idproducto='{$idproducto}'";
            $respuesta=$this->conexion->query($sql);
            return $respuesta;
        }

        function mostrarNuevos(){
            $sql="SELECT * FROM producto ORDER BY fecha DESC LIMIT 9";
            $respuesta=$this->conexion->query($sql);
            return $respuesta;
        }

        function obtenerPortada($idproducto){
            $sql="SELECT * FROM foto WHERE fkproducto='{$idproducto}' AND portada=1";
            $respuesta=$this->conexion->query($sql);
            return $respuesta;
        }

        function agregarCarrito($fkventa, $fkproducto, $cantidad, $subtotal){
        	$sql="INSERT INTO detalle_venta (iddetalle, fkventa, fkproducto, cantidad, subtotal, estatus) VALUES (NULL, '{$fkventa}', '{$fkproducto}', '{$cantidad}', '{$subtotal}', 0)";
        	$respuesta=$this->conexion->query($sql);
        	return $this->conexion->insert_id;
        }
    }
?>