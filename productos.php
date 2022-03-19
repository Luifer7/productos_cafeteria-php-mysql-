



<!-- inclucion de template cabecera -->
<?php include("template/cabecera.php"); ?>



<?php 
    include ("administrador/config/bd.php");
    $sentenciaSQL= $conexion->prepare("SELECT * FROM tienda");
    $sentenciaSQL->execute();
    $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>



<?php

    foreach ($listaProductos as $producto) { ?>
        
        <div class="col-md-3">
    <div class="card">

        <div class="card-header">
        <h4 class="card-title"> <?php echo $producto['nombre']; ?> </h4>
        </div>

        
        <div class="card-body">
        <h4 class="card-title"><?php echo "$".$producto['precio']; ?></h4>
            <p class="card-text"> <?php echo $producto['referencia']; ?> </p>
           
                <button type="button" value="comprar" name="comprar" id="comprar" class="btn btn-primary">Comprar</button>
        
        </div>

    </div>
    <div class="card">

    
        <div class="card-body">
        <?php if (isset($producto['stock'])) { ?>
                    <div id="stock" class="alert alert-success" role="alert">
                        <?php echo "Unidades disponibles: ".$producto['stock']; ?>
                    </div>
                   
                    <?php }?>
                    <div id="stockDos" role="alert" >
                       
                    </div>
            
        </div>

    </div>  
</div>

<?php } ?>





<!-- inclucion de template pie -->
<?php include("template/pie.php"); ?>

<script>
   

      /*     

    let btnComprar = document.getElementById("comprar");
    console.log(btnComprar)

    btnComprar.addEventListener('click', restarStock)

    let num = 9;

    
    function restarStock () {
        let datoStockDos = document.getElementById("stockDos");
            let datoStock = document.getElementById("stock").innerHTML = `Unidades disponibles: ${num}`;
               num--
               
               if (num === -1) {
                datoStockDos.classList.add('alert');
                
                datoStockDos.classList.add('alert-danger');
                
                datoStockDos.innerHTML = "No hay unidades disponibles";
               }
            }  */

    
</script>