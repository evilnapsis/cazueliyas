<section class="content-header">
  <h1>Agregar Producto</h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-8 col-md-offset-2">

<div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body table-responsive">		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=newproduct" role="form">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-3 control-label">Nombre*</label>
    <div class="col-md-8">
      <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del Producto">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-3 control-label">Precio*</label>
    <div class="col-md-8">
      <input type="text" name="price_out" class="form-control " id="price_out" placeholder="Precio de salida">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-3 control-label">Unidad*</label>
    <div class="col-md-8">
      <input type="text" name="unit" class="form-control " id="unit" placeholder="Unidad del Producto">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-3 control-label">Categoria</label>
    <div class="col-md-8">
<select name="category_id" class="form-control " id="category_id">
  <option value="">-- SELECCIONE CATEGORIA --</option>
<?php foreach(CategoryData::getAll() as $cat):?>
  <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
<?php endforeach; ?>
</select>
    </div>
  </div>


<p class="alert alert-info">* Campor obligatorios: Nombre, Precio, Unidad, Categoria</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </div>
  </div>
</form>
</div>
</div>
<script>
  $("#addproduct").submit(function(e){
    if($("#name").val()!=""  && $("#price_out").val()!="" && $("#unit").val()!="" && $("#category_id").val()!="" ){

    }else{
    e.preventDefault();
    alert("No debes dejar campos vacios.");
  }

  });
</script>

<br><br><br><br><br><br><br><br><br>
	</div>
</div>
</section>