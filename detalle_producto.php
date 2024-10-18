<?php 
    include('menu.php');
    include('clases/producto.php');
    $producto = new Producto();

    // recibo el id que le envie desde el index
    $idproducto = $_GET['producto'];

    // mando el id a una funcion para que me arroje los datos de ese producto en especifico
    $datos=mysqli_fetch_assoc($producto->mostrarPorId($idproducto));
?>
<script src="js/jquery.js" type="text/javascript"></script>

<style type="text/css">
    .cuadro{
        display: inline-block;
        width: 40%;
        padding: 30px;
    }
</style>
    <div>
        <div class="cuadro">
            <img src="img/<?=$datos['ruta']?>" width="400px">
        </div>

        <div class="cuadro">
            <h2> <?=$datos['nombre']?> </h2>
            <h4> <?=$datos['precio']?> </h4>
            <p> <?=$datos['descripcion']?> </p>

            <form id="formulario" method="POST">
            <input type="hidden" name="fkproducto" value="<?=$datos["idproducto"]?>">
            <input type="number" name="cantidad" value="1">
            
            <input type="submit" value="Agregar al carrito">

            </form>
                <div id="respuesta"></div>

        </div>
    </div>

<script type="text/javascript">
    
    $('#formulario').on('submit', function(e){
        e.preventDefault()
        $.ajax({
            type:'POST',
            url:'controladores/agregar_carrito.php',
            data: $('#formulario').serialize(),
            dataType: 'html',
            error: function(){
                alert("Error");
            },
            success: function(resultado){
                $('#respuesta').html(resultado);
            }
        })
    })

</script>

<?php
    include('footer.php');
?>
<tr>
    <th colspan="3">Total:</th>
    <th><?=$total?></th>
</tr>