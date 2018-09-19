<!DOCTYPE html>
<?php 
    
session_start();

if (isset($_SESSION['user_id'])) {

    $type= $_SESSION['type'];
    
    if ($type <> "clients") {
        
  
    
    ?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ajouter un nouveau dossier</title>

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
            <li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Acceuil</a></li>
            <li><a href="reclamations.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Reclamations</a></li>
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
					<li>
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
					<li class="active">
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
				<h1 class="page-header">Ajouter un nouveau dossier</h1>
			</div>
		</div><!--/.row-->
				
		<?php
        $conn = mysqli_connect("localhost","root","","cnr");        
        //fetch table rows from mysql db
        $sql = "select * from clients";
        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
        
        //create an array
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray[] = $row;
        }        
    
        $json_data = json_encode($emparray);
        file_put_contents('tables/users.json', $json_data);
        
        ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Ajouter un nouveau dossier</div>
                        <div class="panel-body">
                            <form method="post">
                                                                
                                <?php

                                if (isset($_POST['submit'])) {
                                    
                                    $nom = $_POST['nom'];
                                    $prenom = $_POST['prenom'];
                                    $numpl = $_POST['numpl'];
                                    $numpension = $_POST['numpension'];
                                    $date_liquide = $_POST['date_liquide'];
                                    $date_depot = $_POST['date_depot'];
                                    $date_1er = $_POST['date_1er'];
                                    $etat = $_POST['etat'];
                                    $n_serie = $_POST['n_serie'];
                                    $adresse = $_POST['adresse'];
                                    $nom_pere = $_POST['nom_pere'];
                                    $nom_mere = $_POST['nom_mere'];
                                    $date_trait = $_POST['date_trait'];
                                    $date_juissance = $_POST['date_juissance'];
                                    

                                    if ( empty($numpl) || empty($nom) || empty($prenom) || empty($numpension) ||  empty($n_serie) || empty($adresse) || empty($nom_pere) || empty($nom_mere)  ) { 
                                            // if one of the fields is empty 
                                        ?>  <div class="alert bg-warning" role="alert">
                                            <svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Certains case sont vides !<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                        </div>
                                        <?php
                                    } else {
                                        $conn = mysqli_connect("localhost","root","","cnr");
                                        
                                        // Creation du message dans la bdd                                      
                                        $idemploye = $_SESSION['user_id'];                                         
                                        $guichet = "" ;
                                        $liquidateur = "" ;
                                        $admin = "" ;
                                        $rc = "" ;
                                        $last_id = "";                                        
                                        
                                        $query = mysqli_query($conn, "INSERT INTO message (idemploye,guichet,liquidateur,admin,rc)
                                        VALUES ('".$idemploye."','".$guichet."','".$liquidateur."','".$admin."','".$rc."')");
                                        
                                        if ($query === TRUE) {
                                            $last_id = $conn->insert_id; // ID du dernier message ajouté ( clé étrangaire du dossier)
                                        } else {
                                            echo "Error ! " ;
                                        }
                                        
                                        // L'ajout de nouveau dossier
                                        $query = mysqli_query($conn,"INSERT into dossier (idmessage,nom, prenom, numPL, numPension, etat, num_serie, adresse, nom_pere, date_liquide, date_depot, date_1er, date_trait, date_juissance, nom_mere )
                                        values ('".$last_id."','".$nom."','".$prenom."','".$numpl."','".$numpension."', '".$etat."', '".$n_serie."', '".$adresse."', '".$nom_pere."', '".$date_liquide."', '".$date_depot."', '".$date_1er."', '".$date_trait."', '".$date_juissance."', '".$nom_mere."' ) ");
                                        if ($query) {
                                            // Succession 
                             				?><div class="alert bg-success" role="alert">
					                        <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>Le dossier a été ajouté .<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
				                            </div><?php
                                        } else {?>
                                             // Echec 
                             				<div class="alert bg-danger" role="alert">
                                            <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>Une erreure est survenue !<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                        </div> <?php
                                        }                                                                                   
                                    }                    
                                 }
                                 if (isset($_POST['reset'])) {
                                     $_POST['nom'] = "";
                                     $_POST['prnom'] = "";
                                     $_POST['numpl'] = "";
                                     $_POST['numpension'] = "";
                                     $_POST['date_liquide'] = "";                                     
                                     $_POST['date_depot'] = "";                                     
                                     $_POST['date_1er'] = "";                                     
                                     $_POST['etat'] = "";                                     
                                     $_POST['n_serie'] = "";                                     
                                     $_POST['adresse'] = "";                                     
                                     $_POST['date_trait'] = "";                                     
                                     $_POST['date_juissance'] = "";                                     
                                     $_POST['nom_pere'] = "";                                     
                                     $_POST['nom_mere'] = "";                                     
                                 }      
    
                                 ?>
                                <div class="form-group">
                                    <label>Nom:</label>
                                    <input name="nom" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Prenom:</label>
                                    <input name="prenom" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Numéro PL:</label>
                                    <input name="numpl" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Numéro pension:</label>
                                    <input name="numpension" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Date liquide: </label>
                                    <input name="date_liquide" class="form-control" placeholder="yyyy-mm-dd" >
                                </div>
                                <div class="form-group">
                                    <label>Date depot:</label>
                                    <input name="date_depot" class="form-control" placeholder="yyyy-mm-dd" >
                                </div>
                                <div class="form-group">
                                    <label>Date 1er:</label>
                                    <input name="date_1er" class="form-control" placeholder="yyyy-mm-dd">
                                </div>
                                <div class="form-group">
                                    <label>Etat:</label>
                                    <input name="etat" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Numéro de série:</label>
                                    <input name="n_serie" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Adresse:</label>
                                    <input name="adresse" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Date de traitement:</label>
                                    <input name="date_trait" class="form-control" placeholder="yyyy-mm-dd" >
                                </div>
                                <div class="form-group">
                                    <label>Date de juissance:</label>
                                    <input name="date_juissance" class="form-control" placeholder="yyyy-mm-dd" >
                                </div>
                                
                                <div class="form-group">
                                    <label>Nom de pére:</label>
                                    <input name="nom_pere" class="form-control" >
                                </div>
                                                             
                                <div class="form-group">
                                    <label>Nom de mére:</label>
                                    <input name="nom_mere" class="form-control" >
                                </div>                               

				            <button name="submit" type="submit" class="btn btn-primary">Ajouter</button>
							<button name="reset" type="reset" class="btn btn-default">Réinitialiser</button>                    
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

<?php }   }?>