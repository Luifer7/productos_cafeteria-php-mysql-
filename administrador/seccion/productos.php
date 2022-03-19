

<?php include("../template/cabecera.php");?>


<?php

//Variables deñl formulario
$txtID = (isset($_POST['txtID'])) ?$_POST['txtID'] :"";
$txtNombre = (isset($_POST['txtNombre'])) ?$_POST['txtNombre'] :"";
$txtReferencia = (isset($_POST['txtReferencia'])) ?$_POST['txtReferencia'] :"";
$txtPrecio = (isset($_POST['txtPrecio'])) ?$_POST['txtPrecio'] :"";
$txtPeso = (isset($_POST['txtPeso'])) ?$_POST['txtPeso'] :"";
$txtCategoria = (isset($_POST['txtCategoria'])) ?$_POST['txtCategoria'] :"";
$txtFecha = (isset($_POST['txtFecha'])) ?$_POST['txtFecha'] :"";
$txtStock = (isset($_POST['txtStock'])) ?$_POST['txtStock'] :"";

$accion = (isset($_POST['accion'])) ?$_POST['accion'] :"";


include("../config/bd.php");


switch ($accion) {
    
    case 'agregar':
       
        $sentenciaSQL= $conexion->prepare("INSERT INTO tienda (nombre, referencia, precio, peso, categoria, fecha, stock) VALUES (:nombre,:referencia,:precio,:peso,:categoria,:fecha,:stock);");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':referencia',$txtReferencia);
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->bindParam(':peso',$txtPeso);
        $sentenciaSQL->bindParam(':categoria',$txtCategoria);
        $sentenciaSQL->bindParam(':fecha',$txtFecha);
        $sentenciaSQL->bindParam(':stock',$txtStock);

        $sentenciaSQL->execute();
        header("Location:productos.php");
        break;

    case 'cancelar':
            header("Location:productos.php");
        break;

    case 'modificar':
        $sentenciaSQL= $conexion->prepare("UPDATE tienda SET nombre=:nombre, referencia=:referencia,  precio=:precio, peso=:peso, categoria=:categoria, fecha=:fecha, stock=:stock WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':referencia',$txtReferencia);
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->bindParam(':peso',$txtPeso);
        $sentenciaSQL->bindParam(':categoria',$txtCategoria);
        $sentenciaSQL->bindParam(':fecha',$txtFecha);
        $sentenciaSQL->bindParam(':stock',$txtStock);
        $sentenciaSQL->bindParam(':id',$txtID); 
        $sentenciaSQL->execute();
        header("Location:productos.php");
        break;
        
    case 'Editar':
        $sentenciaSQL= $conexion->prepare("SELECT * FROM tienda WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $Item = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre=$Item['nombre'];
        $txtReferencia=$Item['referencia'];
        $txtPrecio=$Item['precio'];
        $txtPeso=$Item['peso'];
        $txtCategoria=$Item['categoria'];
        $txtFecha=$Item['fecha'];
        $txtStock=$Item['stock'];
        
        break;
            
    case 'Borrar':

        $sentenciaSQL= $conexion->prepare("DELETE  FROM tienda  WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID); 
        $sentenciaSQL->execute();
        header("Location:productos.php");
        break; 
}


$sentenciaSQL= $conexion->prepare("SELECT * FROM tienda");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>



    <div class="col-md-4">

            <div class="card">

                <div class="card-header">
                    Daros del producto
                </div>

                <div class="card-body">

                            <form method="POST" enctype="multipart/form-data">
                                
                                <div class = "form-group">
                                    <label for="txtID" >ID</label>
                                    <input type="number" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID"  placeholder="ID">
                                </div>

                                <!-- NOMBRE del producto -->
                                <div class = "form-group">
                                    <label  for="txtNombre" >nombre</label>
                                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Ingrese nombre">
                                </div>

                                
                                <!-- REFERECIA del producto -->
                                <div class = "form-group">
                                    <label  for="txtReferencia" >Referencia</label>
                                    <input type="text" required class="form-control" value="<?php echo $txtReferencia; ?>" name="txtReferencia" id="txtReferencia" placeholder="Ingrese referencia">
                                </div>

                                <!-- PRECIO del producto -->
                                <div class = "form-group">
                                    <label  for="txtPrecio" >Precio</label>
                                    <input type="number" required class="form-control"  value="<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Ingrese precio">
                                </div>

                                <!-- PESO del producto -->
                                <div class = "form-group">
                                    <label  for="txtPeso" >Peso</label>
                                    <input type="number" required class="form-control" value="<?php echo $txtPeso; ?>" name="txtPeso" id="txtPeso" placeholder="Ingrese Peso">
                                </div>


                                <!-- CATEGORIA del producto -->
                                <div class = "form-group">
                                    <label  for="txtCategoria" >Categoria</label>
                                    <input type="text" required class="form-control" value="<?php echo $txtCategoria; ?>" name="txtCategoria" id="txtCategoria" placeholder="Ingrese Categoria">
                                </div>

                                <!-- FECHA del producto  -->
                                <div class = "form-group">
                                    <label  for="txtFecha" >Fecha</label>
                                    <input type="date" class="form-control" value="<?php echo $txtFecha; ?>" name="txtFecha" id="txtFecha">
                                </div>

                                <div class = "form-group">
                                    <label  for="txtStock" >Stock</label>
                                    <input type="number" required class="form-control" value="<?php echo $txtStock; ?>" name="txtStock" id="txtStock" placeholder="Ingrese Stock">
                                </div>


                                
                
                                <div class="btn-group" role="group">
                                    <button type="submit" name="accion" <?php echo ($accion=="Editar")?"disabled":""; ?> value="agregar" class="btn btn-success">Agregar</button>
                                    <button type="submit" name="accion" <?php echo ($accion!="Editar")?"disabled":""; ?>  value="modificar" class="btn btn-warning">Modificar</button>
                                    <button type="submit" name="accion" <?php echo ($accion!="Editar")?"disabled":""; ?> value="cancelar" class="btn btn-info">Cancelar</button>
                                </div>
        
                            </form>
                    
                </div>
                
            </div>

    </div>
    <!-- termina columna de formulario -->

                    
                   
    <!-- Columna de productos hechos -->
    <div class="col-md-8">
        
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Referenci</th>
                        <th>Precio</th>
                        <th>Peso</th>
                        <th>Categoria</th>
                        <th>Fecha</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Datos -->
                    <?php
                    foreach ($listaProductos as $producto) { ?>
                    <tr>
                        <td><?php echo $producto['id']; ?></td>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo $producto['referencia']; ?></td>
                        <td><?php echo $producto['precio']; ?></td>
                        <td><?php echo $producto['peso']; ?></td>
                        <td><?php echo $producto['categoria']; ?></td>
                        <td><?php echo $producto['fecha']; ?></td>
                        <td><?php echo $producto['stock']; ?></td>

                        <td>
                            <form method="post">
                                
                            <input type="hidden" name="txtID" id="txtID"  value="<?php echo $producto['id']; ?>"/>
                            
                            <input type="submit" name="accion" value="Editar" class="btn btn-primary" />
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />

                            </form>
                        
                        </td>
                    </tr>
                   <?php } ?>
                </tbody>
            </table>

    </div>


<?php include("../template/pie.php"); ?>

