<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system                                      *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: osorio2380@yahoo.es                                            *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************
 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once('database.php');
require_once('library.php');
require_once('funciones.php');
require 'requirelanguage.php';

date_default_timezone_set($_SESSION['ge_timezone']);
$fechai=date('Y-m-d');
$fechaf=date('Y-m-d');

$styling=mysql_fetch_array(mysql_query("SELECT * FROM styles"));
isUser();													 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $listaentregadosonline; ?></title>
  <meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
  <meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
  <meta name="author" content="Jaomweb">	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  
  <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />
  
  <!-- Style Status -->
  <style><?php echo $styling['style']; ?></style>

</head>
<body>
<?php
include("header.php");
?>
  
 <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">      
<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = false; 
    app.settings.asideDock = false;
  ">
  <!-- main -->
  <div class="col">
    <!-- main header -->
    <div class="bg-light lter b-b wrapper-md">

    </div>
    <!-- / main header -->
    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">

      <!-- service -->
      <div class="panel hbox hbox-auto-xs no-border">

		<div class="col-sm-12">
		<div class="card-box table-responsive">
				<h4 class="header-title m-t-0 m-b-20"><?php echo $listaonline; ?></h4>
			<table border="0" align="center">
				<tr>				
					<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rangofecha; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td><i class="icon-append fa fa-calendar"></i>&nbsp;&nbsp;<input type="date" id="bd-desde" class="gentxt1" value="<?php echo $fechai; ?>"/></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $A; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td><i class="icon-append fa fa-calendar"></i>&nbsp;&nbsp;<input type="date" id="bd-hasta" class="gentxt1" value="<?php echo $fechaf; ?>"/></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a target="_blank" href="javascript:reportonlinePDF();"><img src="img/pdf.png" alt="x" border="0" height="35" width="26" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a target="_blank" href="javascript:reportonlineEXCEL();"><img src="img/excel.png" alt="x" border="0" height="35" width="26" /></a>
					</td>
				</tr>
			</table>
			</br>
			   <table ui-jq="dataTable" ui-options="" class="table table-striped b-t b-b">
				<thead>
				  <tr>				  
					  <th>
						  <?php echo $print; ?>
					  </th>
					  <th>
						  <?php echo $tracking; ?>
					  </th>
					  <th>
						  <?php echo $nombredestina; ?>
					  </th>
					  <th>
						  <?php echo $paisdestino1; ?>
					  </th>
					  <th>
						  <?php echo $datesend; ?>
					  </th>
					  <th>
						  <?php echo $empleado; ?>
					  </th>
					  <th></th>
					  <th>
						  <?php echo $deliverystatus; ?>
					  </th>
				  </tr>
				</thead>

				<tbody>
				<?php 

					$initial = 0; // Empezar a contar desde 0
					$consulta_mysql="SELECT o.cid,o.ship_name,o.rev_name,o.date,o.user,o.status,o.shipping_subtotal,o.cons_no, s.color, s.servicemode
					FROM courier_online o 
					inner join service_mode s on o.status=s.servicemode 
					 ORDER BY o.cid DESC";
					$resultado_consulta_mysql=mysql_query($consulta_mysql);	
					while($row=mysql_fetch_array($resultado_consulta_mysql)){
						
						$initial = $initial + $row['shipping_subtotal'];
				?> 
				  <tr>							  
					  <td align="center">
					  <a target="_blank" href="print-invoice/invoice-print-online.php?cid=<?php echo codificar($row['cid']); ?>">
					  <i class="glyphicon glyphicon-print icon text-dark-lter"></a></td>				  				  
					  <td><font color="#000"><?php echo $row['cons_no']; ?></font></td>
					  <td><?php echo $row['ship_name']; ?></td>
					  <td><?php echo $row['rev_name']; ?></td>
					  <td><?php echo $row['date']; ?></td>
					  <td><?php echo $row['user']; ?></td>
					  <td style="text-align: right;"><?php echo $_SESSION['ge_curr']; ?> <?php echo $row['shipping_subtotal']; ?></td>
					  <td><span style="background: #<?php echo $row['color']; ?>;"  class="label label-large" ><?php echo $row['status']; ?></span>               
				  </tr>						
				</tbody>
				<?php } ?>
				<tfoot>
					<tr>
						<td colspan="6" style="text-align: right;" rowspan="1">
							<b>Total Sales</b>
						</td>
						<td style="text-align: right;" rowspan="1" colspan="1">
							<b><?php echo $_SESSION['ge_curr']; ?> <?php echo $initial; ?></b>
						</td>
					</tr>
				</tfoot>				
			</table>    

		</div>
		</div>
		</div>       
      </div>
    </div>
  </div>
</div>
    </div>
  </div>
  <!-- / content -->

<?php
include("footer.php");
?>

</div>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.js"></script>
<script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>
<script src="js/reporteonline.js"></script>
<script src="js/reporteonlineship.js"></script>

</body>
</html>
