<section class="content-header">
		<h1>Venta</h1>
</section>
<section class="content">

<div class="row">
	<div class="col-md-12">
                                        
<!--	<a href="index.php?view=selln" class="btn btn-default btn-lg pull-right">Venta sin factura <i class="glyphicon glyphicon-chevron-right"></i></a> -->

	<p><b>Buscar producto por nombre o por codigo:</b></p>
		<form>
		<div class="row">
			<div class="col-md-6">
				<input type="hidden" name="view" value="sell">
				<input type="text" name="product" class="form-control">
			</div>
			<div class="col-md-3">
			<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			</div>
		</div>
		</form>


<?php if(isset($_GET["product"])):?>
	<?php
$products = ProductData::getActiveLike($_GET["product"]);
if(count($products)>0){
	?>
<h3>Resultados de la Busqueda</h3>
<table class="table table-bordered table-hover">
	<thead>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Unidad</th>
		<th>Precio unitario</th>
		<th>Cantidad</th>
		<th style="width:100px;"></th>
	</thead>
	<?php
$products_in_cero=0;
	 foreach($products as $product):
$q= ProductData::getAllActive();
	?>
	<?php 
	if($q>0):?>
		<form method="post" action="index.php?view=addtocart">
	<tr class="<?php if($q<=5){ echo "danger"; }?>">
		<td style="width:80px;"><?php echo $product->id; ?></td>
		<td><?php echo $product->name; ?></td>
		<td><?php echo $product->unit; ?></td>
		<td><b>$<?php echo $product->price_out; ?></b></td>
		<td>
		<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
		<input type="" class="form-control" required name="q" placeholder="Cantidad de producto ..."></td>
		<td style="width:183px;">
		<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Agregar a la venta</button>
		</td>
	</tr>
	</form>
<?php else:$products_in_cero++;
?>
<?php  endif; ?>
	<?php endforeach;?>
</table>
<?php if($products_in_cero>0){ echo "<p class='alert alert-warning'>Se omitieron <b>$products_in_cero productos</b> que no tienen existencias en el inventario. <a href='index.php?module=inventary'>Ir al Inventario</a>"; }?>

	<?php
}else { echo "<p class='alert alert-warning'>No hay resultados en la busqueda.</p>"; }
?>
<br><hr>
<hr><br>
<?php else:
?>

<?php endif; ?>

<?php if(isset($_SESSION["errors"])):?>
<h2>Errores</h2>
<p></p>
<table class="table table-bordered table-hover">
<tr class="danger">
	<th>Codigo</th>
	<th>Producto</th>
	<th>Mensaje</th>
</tr>
<?php foreach ($_SESSION["errors"]  as $error):
$product = ProductData::getById($error["product_id"]);
?>
<tr class="danger">
	<td><?php echo $product->id; ?></td>
	<td><?php echo $product->name; ?></td>
	<td><b><?php echo $error["message"]; ?></b></td>
</tr>

<?php endforeach; ?>
</table>
<?php
unset($_SESSION["errors"]);
 endif; ?>


<!--- Carrito de compras :) -->
<?php if(isset($_SESSION["cart"])):
$total = 0;
?>
<h2>Lista de venta</h2>

<form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">No. Mesa</label>
    <div class="col-lg-10">
	<select class="form-control" id="no_mesa">
			<option value=""> -- No. MESA -- </option>
		<?php for($i=1;$i<15;$i++):?>
			<option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
		<?php endfor; ?>
			</select>

    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword1" class="col-lg-2 control-label">Mesero</label>
    <div class="col-lg-10">
	<select class="form-control" id="mesero">
			<option value=""> -- SELECCIONE MESERO-- </option>
		<?php foreach (Userdata::getAllMeseros() as $mesero):?>
			<option value="<?php echo $mesero->id; ?>"> <?php echo $mesero->name." ".$mesero->lastname; ?> </option>
		<?php endforeach; ?>
			</select>
    </div>
  </div>
</form>

<div class="row">
	<div class="col-md-4">
	</div>
</div>
<br>
<div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
<table class="table table-bordered table-hover datatable">
<thead>
	<th style="width:30px;">Codigo</th>
	<th style="width:30px;">Cantidad</th>
	<th style="width:30px;">Unidad</th>
	<th>Producto</th>
	<th style="width:30px;">Precio Unitario</th>
	<th style="width:30px;">Precio Total</th>
	<th ></th>
</thead>
<?php foreach($_SESSION["cart"] as $p):
$product = ProductData::getById($p["product_id"]);
?>
<tr >
	<td><?php echo $product->id; ?></td>
	<td ><?php echo $p["q"]; ?></td>
	<td><?php echo $product->unit; ?></td>
	<td><?php echo $product->name; ?></td>
	<td><b>$ <?php echo number_format($product->price_out); ?></b></td>
	<td><b>$ <?php  $pt = $product->price_out*$p["q"]; $total +=$pt; echo number_format($pt); ?></b></td>
	<td style="width:30px;"><a href="index.php?view=clearcart&product_id=<?php echo $product->id; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a></td>
</tr>

<?php endforeach; ?>
</table>
</div>
</div>
<h2>Resumen</h2>
<div class="row">
<div class="col-md-6 col-md-offset-6">
<table class="table table-bordered">
<tr>
	<td><p>Subtotal</p></td>
	<td><p><b>$ <?php echo number_format($total*.84); ?></b></p></td>
</tr>
<tr>
	<td><p>IVA</p></td>
	<td><p><b>$ <?php echo number_format($total*.16); ?></b></p></td>
</tr>
<tr>
	<td><p>Total</p></td>
	<td><p><b>$ <?php echo number_format($total); ?></b></p></td>
</tr>

</table>
<form method="post" action="index.php?view=processsell" id="process">
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div class="checkbox">
        <label>
         <input type="hidden" name="mesero_id" id="mesero_id" value="0">
         <input type="hidden" name="mesa" id="mesa">
          <input name="is_oficial" type="hidden" value="1">
        </label>
      </div>
    </div>
  </div>

<script>
// cuando selecciono el mesero
// actualizo el cambo oculto mesero_id dentro del formulario de proceso
$(document).ready(function(){
$("#mesero").change(function(){
	$("#mesero_id").val($("#mesero").val());
});
$("#process").submit(function(e){
	if($("#mesero_id").val()=="0"){
		e.preventDefault();
		alert("Debes seleccionar un mesero");
	}
});
//////////////////////////////////////////////////////
$("#no_mesa").change(function(){
	$("#mesa").val($("#no_mesa").val());
});
$("#process").submit(function(e){
	if($("#mesa").val()==""){
		e.preventDefault();
		alert("Debes escribir un numero de mesa.");
	}
});

});
//////////////////////////////////////////////////////
</script>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div class="checkbox">
        <label>
		<a href="index.php?view=clearcart" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
        <button class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-usd"></i><i class="glyphicon glyphicon-usd"></i> Finalizar Venta</button>
        </label>
      </div>
    </div>
  </div>
</form>

</div>
</div>

<br><br><br><br><br>
<?php endif; ?>

</div>
	</div>
</section>