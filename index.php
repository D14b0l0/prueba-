<?php
    include('menu.php');
    // incluimos el archivo de la clase
    include('clases/producto.php');
    // creamos una variable que representara a la clase
    $producto = New Producto();

    // mandamos a llamar la funcion para mostrar los productos
    $datos = $producto->mostrarNuevos();
    // tiene que llamarse la funcion exactamente con el mismo nombre, arroja la lista de registros en la bd
?>

<style type="text/css">
    .caja_producto{
        display: inline-block;
        width: 20%;
        border: black 2px solid;
        margin: 10px;
        padding: 20px 30px;     
    }

    .a_producto{
        text-decoration: none;
        color: black;
    }
</style>
<div>
    <h2>Lo mas nuevo</h2>

    <?php
    while ($fila=mysqli_fetch_array($datos)){
        $foto=mysqli_fetch_assoc($producto->obtenerPortada($fila['idproducto']));
        $archivo='';

        if($foto!=null){
            $archivo=$foto['ruta'];
            } else {
                $archivo='no.jpg';
            }
        
    ?>
    
    <a class='a_producto' href="detalle_producto.php?producto=<?=$fila['idproducto']?>">
        <div class="caja_producto">
            <img width="200px" src="img/<?=$archivo?>">
            <h3> <?=$fila['nombre']?> </h3>
            <b> <?=$fila['precio']?> </b>
        </div>
    </a>

    <?php

        }

    ?>

</div>

<?php
    include('footer.php')
?>