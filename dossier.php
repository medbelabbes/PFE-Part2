<!DOCTYPE html>

<?php
session_start();

if (isset($_SESSION['user_id'])) {
            $type= $_SESSION['type'];

    if ($type === "etudiant") {
    
$conn = mysqli_connect("localhost","root","","pfe");
$username = $_SESSION['user_id'];
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mon dossier de retraite</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body style="padding-left: 20px">
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" 
                   <?php
    switch ($type) {
        case "adminstrateur":?>href="index.php"<?php
            break;
        case "etudiant":?>href="dossier.php"<?php
            break;
        default:?>href="dossiers.php"<?php
            break;            
    }
    ?>
                   >Caisse nationale des <span>retraites</span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $_SESSION['user_id']; ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="settings.php"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Paramètres</a></li>
							<li><a href="login.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
            <li class="active"><a href="dossier.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Mon dossier</a></li>
            <li ><a href="reclamation.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Réclamation</a></li>
            
			<li role="presentation" class="divider"></li>
		</ul>

	</div><!--/.sidebar-->
		

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"> Bienvenue !</h1>
			</div>
		</div><!--/.row-->
				

        <div class="row">
			<div class="col-lg-12">                            
				<div class="panel panel-default">
					<div class="panel-heading">L'avancement de votre dossier</div>
					<div class="panel-body">
							
							<div class="left clearfix">
								<span class="chat-img pull-left">
									<img
                                         
                                         <?php
                                         $query = mysqli_query($conn, "select statutguichet from dossier d,clients c where c.iddossier = d.num_serie and c.username = '".$username."' ");
                                         $statut = mysqli_fetch_array($query);
                                         switch ($statut[0]) {
                                             case "encours":?>src="images/encours.gif"<?php
                                                 break;
                                             case "valide":?>src="images/valide.png"<?php
                                                 break;
                                             case "enattente":?>src="images/enattente.png"<?php
                                                 break;
                                             case "incomplet":?>src="images/incomplet.png"<?php
                                                 break;                                                  
                                         }
                                         
                                         ?>
                                         
                                         alt="Validé" height="90" width="90" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="primary-font">Service technique</strong>
									</div>
									<p>
                                        <?php
                                        
                                        $query = mysqli_query($conn, "SELECT m.guichet from message m, dossier d, clients c where
                                        m.idmessage = d.idmessage and d.num_serie = c.iddossier and c.username = '".$username."'");                                
                                       
                                        $run = mysqli_fetch_array($query);
                                        echo $run = $run['guichet'];                                       
                                                                      
                                        ?>
										
									</p>
								</div>
							</div>
                            <div class="left clearfix">
								<span class="chat-img pull-left">
									<img 
                                         <?php
                                         $query = mysqli_query($conn, "select statutliquidateur from dossier d,clients c where c.iddossier = d.num_serie and c.username = '".$username."' ");
                                         $statut = mysqli_fetch_array($query);
                                         switch ($statut[0]) {
                                             case "encours":?>src="images/encours.gif"<?php
                                                 break;
                                             case "valide":?>src="images/valide.png"<?php
                                                 break;
                                             case "enattente":?>src="images/enattente.png"<?php
                                                 break;
                                             case "incomplet":?>src="images/incomplet.png"<?php
                                                 break;                                                  
                                         }
                                         
                                         ?>
                                         
                                         alt="Validé" height="90" width="90" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="primary-font">Liquidateur</strong> 
									</div>
									<p>
                                        <?php
                                        
                                        $query = mysqli_query($conn, "SELECT m.liquidateur from message m, dossier d, clients c where
                                        m.idmessage = d.idmessage and d.num_serie = c.iddossier and c.username = '".$username."'");                                
                                        $run = mysqli_fetch_array($query);
                                        echo $run = $run['liquidateur'];                                       
                                        
                                        ?>
										
									</p>
								</div>
							</div>
							<div class="left clearfix">
								<span class="chat-img pull-left">
									<img 
                                         <?php
                                         $query = mysqli_query($conn, "select statutrc from dossier d,clients c where c.iddossier = d.num_serie and c.username = '".$username."' ");
                                         $statut = mysqli_fetch_array($query);
                                         switch ($statut[0]) {
                                             case "encours":?>src="images/encours.gif"<?php
                                                 break;
                                             case "valide":?>src="images/valide.png"<?php
                                                 break;
                                             case "enattente":?>src="images/enattente.png"<?php
                                                 break;
                                             case "incomplet":?>src="images/incomplet.png"<?php
                                                 break;                                                  
                                         }
                                         
                                         ?>
                                         alt="En cours" height="90" width="90" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="pull-left primary-font">RC</strong>
									</div>
									<p>
                                        <?php
                                        
                                        $query = mysqli_query($conn, "SELECT m.rc from message m, dossier d, clients c where
                                        m.idmessage = d.idmessage and d.num_serie = c.iddossier and c.username = '".$username."'");
                                        
                                        $run = mysqli_fetch_array($query);
                                        echo $run = $run['rc'];
                                        
                                        
                                        ?>			
                                    </p>
								</div>
                            </div>
							<div class="left clearfix">
								<span class="chat-img pull-left">
									<img <?php
                                         $query = mysqli_query($conn, "select statutadmin from dossier d,clients c where c.iddossier = d.num_serie and c.username = '".$username."' ");
                                         $statut = mysqli_fetch_array($query);
                                         switch ($statut[0]) {
                                             case "encours":?>src="images/encours.gif"<?php
                                                 break;
                                             case "valide":?>src="images/valide.png"<?php
                                                 break;
                                             case "enattente":?>src="images/enattente.png"<?php
                                                 break;
                                             case "incomplet":?>src="images/incomplet.png"<?php
                                                 break;                                                  
                                         }
                                         
                                         ?>
                                          alt="User Avatar" height="90" width="90" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="primary-font">Administration</strong>
									</div>
									<p>
                                        <?php
                                        
                                        $query = mysqli_query($conn, "SELECT m.admin from message m, dossier d, clients c where
                                        m.idmessage = d.idmessage and d.num_serie = c.iddossier and c.username = '".$username."' ");
                                        
                                        $run = mysqli_fetch_array($query);
                                        echo $run = $run['admin'];                                    
                                        
                                        ?>		
                                    </p>
								</div>                        
							</div>
					</div>
				</div>            
			</div>
    </div>
</div>
				

					
					
	

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
<?php }   } ?>