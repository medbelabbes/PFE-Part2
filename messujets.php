<!DOCTYPE html>
<?php 
     session_start();

if (isset($_SESSION['user_id'])) {


        $type= $_SESSION['type'];
    
    if ($type <> "etudiant") {?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Affichage des réclamations</title>

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

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
                <img src="images/logo.png" alt="CNR" height="50px" width="50px">
				<a class="navbar-brand" 
                   <?php
    switch ($type) {
        case "Admin":?>href="index.php"<?php
            break;
        case "clients":?>href="dossier.php"<?php
            break;
        default:?>href="dossiers.php"<?php
            break;            
    }
    ?>
                   >Caisse nationale des <span>retraites</span></a>
                <ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php echo $_SESSION['user_id']; ?><span class="caret"></span></a>
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
            <?php if ($type === "Admin"){ ?>
            <li ><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Acceuil</a></li>
            <li class="active"><a href="reclamations.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Reclamations</a></li>
            <li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>Employeurs 
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="employeurs.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Afficher employeurs
						</a>
					</li>
					<li>
						<a class="" href="addemploye.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Ajouter employeurs
						</a>
					</li>
				</ul>
			</li>
            <?php } ?>
            <li class="parent ">
				<a href="#">                    
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>Utilisateurs 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li  class="active">
						<a class="" href="users.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Afficher utilisateurs
						</a>
					</li>
					<li>
						<a class="" href="adduser.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Ajouter utilisateur
						</a>
					</li>
				</ul>
			</li>            
            <li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>Dossier 
				</a>
				<ul class="children collapse" id="sub-item-3">
					<?php 
                    if ($type === "clients") { ?>                                       
                    <li>
						<a class="" href="dossier.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Mon dossier
						</a>
					</li>                   
                    <?php } ?>
                    <li>
						<a class="" href="dossiers.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Affiches dossiers
						</a>
					</li>
					<li>
						<a class="" href="adddossier.php">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Ajouter Dossier
						</a>
					</li>
				</ul>
			</li> 
            
			<li role="presentation" class="divider"></li>
		</ul>
		
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Affichages des réclamations</h1>
			</div>
		</div><!--/.row-->
				
		<?php
        $conn = mysqli_connect("localhost","root","","cnr");        
        //fetch table rows from mysql db
        $sql = "select * from reclamation";
        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
        
        //create an array
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray[] = $row;
        }
        
    
        $json_data = json_encode($emparray);
        file_put_contents('tables/reclamations.json', $json_data);


        ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Liste des réclamations</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="tables/reclamations.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="idreclamation" data-sortable="true">Id réclamation</th>
						        <th data-field="message" data-sortable="true">Message</th>
						        <th data-field="idclients" data-sortable="true">Unsername</th>
						        <th data-field="type" data-sortable="true">Type de réclmation</th>
						    </tr>
						    </thead>
						</table>
					</div>
				</div>
                <div class="panel panel-default">
                <div class="panel-heading">Supprimer une réclamation</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="post">

                        <?php
                        if (isset ($_POST['supprimer']) && !empty($_POST['idrec']) ) {
                            $idrec = $_POST['idrec'];
                            $query = mysqli_query($conn,"update reclamation set message = '' where idreclamation= '".$idrec."' ");
                            if ($query === true) { ?>
                                <div class="alert bg-success" role="alert">
                                    <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>La réclamation a été bien supprimé.<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                </div><?php
                            } else {?>
                            <div class="alert bg-danger" role="alert">
                                <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>Une erreure est survenue !<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                            </div> <?php
                        }
                        } 

                        ?>

                        <div class="form-group">
                            <div class="col-md-5">
                            <input id="idrec" name="idrec" type="text" placeholder="Id réclamation" class="form-control">
                            <input type="submit" name="supprimer" value="Supprimer" class="btn btn-default btn-md pull-left">

                            </div>
                        </div>

                    </form>
                </div>
			 </div>
			</div>
		</div><!--/.row-->	
	</div><!--/.main-->

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
<?php } }?>