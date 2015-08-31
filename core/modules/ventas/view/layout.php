<?php
if(Session::getUID()!=""){
  Core::$user = UserData::getById(Session::getUID());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cazueliyas | Panel de control</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
 <!-- jQuery 2.0.2 -->
        <script src="res/jquery.min.js"></script>
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<link rel="stylesheet" type="text/css" href="res/datepicker/css/datepicker.css">

    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="./" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Cazueliyas
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <!-- Tasks: style can be found in dropdown.less -->

                        <!-- User Account: style can be found in dropdown.less -->
                        <?php if(Session::getUID()!=""):?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo Core::$user->name; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue" style="height:80px;">
                                    <p >
                                        <?php echo Core::$user->name; ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <!-- <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div> -->
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <?php if(Session::getUID()!=""):?>
                    <div class="user-panel">

                        <div class="pull-left info">
                            <p><?php echo Core::$user->name; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> <?php if(Core::$user->is_cajero){ echo "Cajero"; }else if(Core::$user->is_mesero){ echo "Mesero"; }else if(Core::$user->is_admin){ echo "Administrador"; }?></a>
                        </div>
                    </div>
                <?php endif; ?>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                    <?php if(Session::getUID()==""):?>
                        <li>
                            <a href="./">
                                <i class="fa fa-home"></i> <span>Login</span>
                            </a>
                        </li>
                        <li >
                            <a href="index.php?view=sell">
                                <i class="fa fa-usd"></i> <span>Vender</span>
                            </a>
                        </li>                    <?php else: ?>
                        <?php if(Core::$user->is_admin):?>

                        <li >
                            <a href="./">
                                <i class="fa fa-home"></i> <span>Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?view=sell">
                                <i class="fa fa-usd"></i> <span>Vender</span> 
                            </a>
                        </li>
                        <li >
                            <a href="index.php?view=resume">
                                <i class="fa fa-star"></i>
                                <span>Resumen</span>
                                <small class="badge pull-right bg-green">hoy</small>
                            </a>
                        </li>
                        <li >
                            <a href="index.php?view=dayli">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Ventas</span>
                                <small class="badge pull-right bg-green">hoy</small>
                            </a>

                        </li>
                        <li >
                            <a href="index.php?view=spents">
                                <i class="fa fa-upload fa-rotate-180"></i>
                                <span>Gastos</span>
                                <small class="badge pull-right bg-green">hoy</small>
                            </a>

                        </li>                        

                        <li >
                            <a href="index.php?view=sells">
                                <i class="fa fa-th-list"></i>
                                <span>Lista de venta</span>
                            </a>

                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="glyphicon glyphicon-time"></i>
                                <span>Historial</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?view=resumehist"><i class="fa fa-angle-double-right"></i> Resumen</a></li>
                                <li><a href="index.php?view=sellhist"><i class="fa fa-angle-double-right"></i> Venta</a></li>
                                <li><a href="index.php?view=spenthistory"><i class="fa fa-angle-double-right"></i> Gastos</a></li>
                            </ul>
                        </li>

                        <li >
                            <a href="index.php?view=reports">
                                <i class="fa fa-tasks"></i>
                                <span>Reportes</span>
                            </a>
                        </li>
                        <li >
                            <a href="index.php?view=products">
                                <i class="fa fa-glass"></i>
                                <span>Productos</span>
                            </a>
                        </li>
                        <li >
                            <a href="index.php?view=categories">
                                <i class="fa fa-th"></i>
                                <span>Categorias</span>
                            </a>
                        </li>

                        <li >
                            <a href="index.php?view=users">
                                <i class="fa fa-users"></i>
                                <span>Usuarios</span>
                            </a>
                        </li>
                    <?php else:?>
                        <li>
                            <a href="index.php?view=sell">
                                <i class="fa fa-usd"></i> <span>Vender</span> 
                            </a>
                        </li>

                        <li >
                            <a href="index.php?view=sells">
                                <i class="fa fa-th-list"></i>
                                <span>Lista de venta</span>
                            </a>

                        </li>
                        <?php endif; ?>                     
                        <?php endif; ?>                     
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
<?php 
  // puedo cargar otras funciones iniciales
  // dentro de la funcion donde cargo la vista actual
  // como por ejemplo cargar el corte actual
  if(Session::getUID()=="")
    {View::load("login");}else{
        if(Core::$user->is_admin){
        View::load("home");
    }else{
        View::load("sell");

        }
    }
?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="res/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
 <script>
 $(function() {
                $('.datatable').dataTable();
            });</script>
<script src="res/datepicker/js/bootstrap-datepicker.js"></script>
<script>
            $('.tip').tooltip();

            $('#alert').hide();
  var startDate = new Date();
      var endDate = new Date();
      $('#dp4').attr('data-date',startDate);
      $('#dp5').attr('data-date',endDate);

      $('#startDate').text($('#dp4').data('date'));
      $('#endDate').text($('#dp5').data('date'));
      $('#dp4').datepicker()
        .on('changeDate', function(ev){
          if (ev.date.valueOf() > endDate.valueOf()){
            $('#alert').show().find('strong').text('La fecha de inicio no debe ser mayor que la fecha de fin.');
          } else {
            $('#alert').hide();
            startDate = new Date(ev.date);
            $('#startDate').text($('#dp4').data('date'));
            $('#stdate').val($('#dp4').data('date'));
          }
          $('#dp4').datepicker('hide');
        });

      $('#dp5').datepicker()
        .on('changeDate', function(ev){
          if (ev.date.valueOf() < startDate.valueOf()){
            $('#alert').show().find('strong').text('La fecha de fin no debe ser menor que la fecha de inicio.');
          } else {
            $('#alert').hide();
            endDate = new Date(ev.date);
            $('#endDate').text($('#dp5').data('date'));
            $('#endate').val( $('#dp5').data('date') );
          }
          $('#dp5').datepicker('hide');
        });


</script>

        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>     
        
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>
    </body>
</html>