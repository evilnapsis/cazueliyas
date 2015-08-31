<?php
date_default_timezone_set("America/Hermosillo");
$user = UserData::getById(Session::getUID());
$operations=null;
$category = null;
if(!isset($_GET["cat_id"])){
$operations = OperationData::getAllByDate(date("Y-m-d",time()));
$spents = SpentData::getAllByDate(date("Y-m-d",time()));
}else{
$operations = OperationData::getAllByDateAndCategoryId(date("Y-m-d",time()),$_GET["cat_id"]);
$spents = SpentData::getAllByDateAndCategoryId(date("Y-m-d",time()),$_GET["cat_id"]);
$category = CategoryData::getById($_GET["cat_id"]);
}
$sell = 0;
$spent = 0;
$money = 0;
 foreach($operations as $career){ $sell += $career->q*$career->price; }
 foreach($spents as $career){ $spent += $career->price; }
 $money = $sell - $spent;
 ?>



                <section class="content-header">
                       		<h1>Administracion Las Cazuelitas</h1>
                    
                </section>

<div class="content">
<div class="row">
	<div class="col-md-12">


		<div class="clearfix"></div>
<?php if(count($operations)>0 || count($spents)>0):?>

<div class="row">
                        <div class="col-lg-3 col-lg-offset-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <b>$ <?php echo number_format($money,2,".",","); ?></b>
                                    </h3>
                                    <p>
                                        Ganancia
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="index.php?view=resume" class="small-box-footer">
                                    Ver Resumen <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <b>$ <?php echo number_format($sell,2,".",","); ?></b>
                                    </h3>
                                    <p>
                                        Ventas
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="index.php?view=dayli" class="small-box-footer">
                                    Ver Ventas <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <b>$ <?php echo number_format($spent,2,".",","); ?></b>
                                    </h3>
                                    <p>
                                        Gastos
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="index.php?view=spents" class="small-box-footer">
                                    Ver Gastos <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
                    <div class="row">
<section class="col-lg-6">
                            <!-- Map box -->
                            <div class="box box-primary">
                                <div class="box-header">
                                

                                    <i class="fa fa-map-marker"></i>
                                    <h3 class="box-title">
                                        Meseros
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive ">
                                        <!-- .table - Uses sparkline charts-->
<?php
$meseros = UserData::getAllMeseros();
?>
<?php if(count($meseros)>0):
?>
<table class="table table-striped table-bordered datatable ">
                                            <thead>
                                            <th></th>
                                                <th>Nombre</th>
                                                <th>Total</th>
                                            </thead>
<?php foreach($meseros as $mesero):
$sells = SellData::getAllDayliByMesero($mesero->id);
$total = 0;
if(count($sells)>0){ foreach($sells as $sell){ $total += $sell->total;} }
?>
                                            <tr>
                                            <td><a href="index.php?view=reportbymesero&mesero_id=<?php echo $mesero->id; ?>" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-chevron-right"></i></a> </td>
                                                <td><?php echo $mesero->name." ".$mesero->lastname; ?></td>
                                                <td>$ <?php echo number_format($total,2,".",","); ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                        </table><!-- /.table -->    
                                        <?php endif; ?>                                
                                        </div>
                                </div><!-- /.box-body-->
                            </div>
                            <!-- /.box -->
</section>
                        
                    </div>
<?php endif; ?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>
</div>
