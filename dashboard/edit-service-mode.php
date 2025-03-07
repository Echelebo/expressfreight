<?php 
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system		                               *
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
require_once('database-settings.php');
require_once('database.php');
require_once('library.php');
require_once('funciones.php');
require 'requirelanguage.php';
$con = conexion();

date_default_timezone_set($_SESSION['ge_timezone']);

$id=$_GET['id'];
$id = decodificar($id);	
$resultado = $con->query("SELECT * FROM service_mode WHERE id='$id' ");
isUser();												 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $editstyle; ?></title>
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

</head>
<body>
 <?php include("header.php"); ?> 
  <!-- content -->
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
					<div class="row">		
						<div class="col-sm-12">			
						  <div class="panel panel-default">
						  <div class="table-responsive">
							<div class="panel-heading font-bold"><?php echo $addnewser; ?></div>
							</br>							
							</br>
							<div class="panel-body">

								<!-- START Checkout form -->
								<?php while($row = $resultado->fetch_assoc()){ ?> 
									<form action="settings/modebookings/update_mode_service.php"   method="POST" > 
										
										<!-- START Presonal information -->

										<legend><?php echo $informations; ?>:</legend>
										
										<!-- Country and state -->								
										<div class="row">
											<div class="col-sm-4 form-group">
											 <input type="hidden" name="id" value="<?php echo $id; ?>">
												<label for="zipcode" class="control-label"><i class="fa fa-plane icon text-default-lter"></i>&nbsp;<?php echo $TYPESTATUS; ?></label>
												<input type="text" class="form-control" value="<?php echo $row['servicemode']; ?>"  name="servicemode">
											</div>
											<div class="col-sm-4 form-group">
												<label for="zipcode" class="control-label"><i class="fa  fa-info icon text-default-lter"></i>&nbsp;<?php echo $DETAILSTATUS; ?></label>
												<input type="text" class="form-control" value="<?php echo $row['detail'] ;?>"  name="detail">
											</div>
											<div class="col-sm-1 form-group">
												<label for="zipcode" class="control-label"><i class="fa  fa-info icon text-default-lter"></i>&nbsp;<?php echo $COLORS; ?></label>
												<input class="form-control jscolor" value="<?php echo $row['color'] ;?>"  name="color">
											</div>											
										</div>
										<div class="col-md-6 text-left">
											<br>
											<br>
											<button name="Guardar" type="submit" class="btn btn-large btn-success"><?php echo $UPDATE; ?></button>												
											<a href="styles.php"  class="btn btn-large btn-warning"><?php echo $RETORNAR; ?></a>										
										</div>											
									</form>
								<?php } ?>					
							</div>				 
						</div>
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

</div>

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
<script src="js/jscolor.min.js"></script>

</body>
</html>
