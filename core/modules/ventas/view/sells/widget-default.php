<section class="content-header">
			<h1><i class='glyphicon glyphicon-shopping-cart'></i> Lista de Ventas</h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="clearfix"></div>
<br>
<div class="btn-group">
<a class="btn btn-default" href="index.php?view=sells&t=0"> <?php if(isset($_GET["t"]) && $_GET["t"]=="0" ):?><i class="glyphicon glyphicon-ok-sign"></i> <?php endif; ?> Pendientes</a>
<a class="btn btn-default" href="index.php?view=sells&t=1"> <?php if(isset($_GET["t"]) && $_GET["t"]=="1" ):?><i class="glyphicon glyphicon-ok-sign"></i> <?php endif; ?> Finalizados</a>
<a class="btn btn-default" href="index.php?view=sells"> <?php if(!isset($_GET["t"])):?><i class="glyphicon glyphicon-ok-sign"></i> <?php endif; ?>Todos</a>
</div>

<br><br>

<?php
$page = 1;
if(isset($_GET["page"])){
	$page=$_GET["page"];
}
$limit=10;
if(isset($_GET["limit"]) && $_GET["limit"]!="" && $_GET["limit"]!=$limit){
	$limit=$_GET["limit"];
}
$products=null;
if(!isset($_GET["t"])){
$products = SellData::getAll();
}else  if(isset($_GET["t"]) && $_GET["t"]=="0" ){
$products = SellData::getAllUnApplied();
}
else  if(isset($_GET["t"]) && $_GET["t"]=="1" ){
$products = SellData::getAllApplied();
}
if(count($products)>0){


	?>

<div class="clearfix"></div>
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
		<th></th>
		<th>Mesa</th>
		<th>Mesero</th>
		<th>Productos</th>
		<th>Total</th>
		<th>Status</th>
		<th>Fecha</th>
	</thead>
	<?php foreach($products as $sell):?>

	<tr>
		<td><a href="index.php?view=onesell&id=<?php echo $sell->id; ?>" class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>
	<td>#<?php echo $sell->mesa;?></td>
		<td>

<?php
$mesero = UserData::getById($sell->mesero_id);
echo $mesero->name." ".$mesero->lastname;
?>
</td>
		<td>

<?php
$operations = OperationData::getAllProductsBySellId($sell->id);
	$rx = 0;
	foreach($operations as $operation){
		$rx += $operation->q;
	}
echo $rx;
?></td>
		<td>

<?php
$total=0;
	foreach($operations as $operation){
		$product  = $operation->getProduct();
		$total += $operation->q*$product->price_out;
	}
		echo "<b>$ ".number_format($total)."</b>";

?>			

		</td>
		<td><center><?php  
		if($sell->is_applied) { echo "<p class='label label-primary'><i class='glyphicon glyphicon-ok'></i> Finalizado</p>"; }
		else { echo "<p class='label label-warning'><i class='glyphicon glyphicon-time'></i> Pendiente</p>"; }
		 ?>
		 </center></td>
		<td><?php echo $sell->created_at; ?></td>
	</tr>

<?php endforeach; ?>

</table>
</div>
</div>
<div class="btn-group pull-right">
</div>

<div class="clearfix"></div>

	<?php
}else{
	?>
	<div class="jumbotron">
		<h2>No hay ventas</h2>
		<p>No se han agregado ventas.</p>
	</div>
	<?php
}

?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>
</section>