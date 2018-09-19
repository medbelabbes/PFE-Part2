<!DOCTYPE html>

<?php
session_start();

if (isset($_SESSION['user_id'])) {
            $type= $_SESSION['type'];

    if ($type === "clients") {
    
$conn = mysqli_connect("localhost","root","","cnr");
$username = $_SESSION['user_id'];
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mes réclamations</title>

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
            <li><a href="dossier.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Mon dossier</a></li>
            <li class="active"><a href="reclamation.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Réclamation</a></li>
            
			<li role="presentation" class="divider"></li>
		</ul>

	</div><!--/.sidebar-->
		

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Réclamations</h1>
			</div>
		</div><!--/.row-->
        
        <div class="row">
			<div class="col-lg-12">                            
				<div class="panel panel-default">
                	<div class="panel-heading">Ma réclamation</div>
                       <div class="panel-body">
                            <form method="post">
                                <?php        
                                if (isset($_POST['send'])) {
                                    $message = $_POST['message'];
                                    $idclient = $username;
                                    $typeRec = $_POST['type'];
                                    $query = mysqli_query($conn,"update reclamation set message = '".$message."', type = '".$typeRec."' where idclients = '".$username."' ");    
                                    if ($query === true ) {?>
                                        <div class="alert bg-success" role="alert">
                                            <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> La reclamation a été envoyé <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                        </div><?php
                                    } else {?>
                                        <div class="alert bg-danger" role="alert">
                                            <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Une erreure est survenue ! <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                        </div><?php                                        
                                    }
                                }                            
                                ?>  
                                <div class="alert bg-warning" role="alert">
                                    <svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Vou ne pouvez envoyer qu'une seule reclamation si vous avez déja une, l'ancience va etre suprrimé.<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                </div>
                                
                                <div class="form-group">
                                   <label>Votre réclamation :</label>
                                </div>
                               <textarea class="form-group" id="message" name="message" placeholder="Ecrivez votre message ici ..." rows="5" cols="130"></textarea>

                                
                                <div class="form-group">
                                    <label>Type de reclamation</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="reclamation1">Réclamation 1</option>
                                        <option value="reclamation2">Réclamation 2</option>
                                        <option value="reclamation3">Réclamation 3</option>
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <span class="input-group-btn">
                                        <button name="send" class="btn btn-success btn-md" id="btn-chat">Send</button>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label>
                                    <?php
                                    $query = mysqli_query($conn, "select r.message from reclamation r, clients c where r.idclients = c.username and c.username = '".$username."' ");
                                    $run = mysqli_fetch_array($query);  
                                    
                                    if ($run['message'] <> "") {
                                        echo "Votre réclamation : ". $run['message'];
                                    } else {
                                        echo "Vous n'avez aucune reclamation.";                                        
                                    }
                                    ?>                              
                                    </label>
                                </div>
                        </form>
                        
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