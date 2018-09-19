<!DOCTYPE html>
<?php
     session_start();

if (isset($_SESSION['user_id'])) {
require('queries/dbsetup.php');
if ($_SESSION['premiere'] == 0) {
        $type= $_SESSION['type'];

    if ($type == "enseignant") {?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestions des projets fin d'études</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/sweetalert.css" rel="stylesheet" type="text/css" >
<!-- favicon -->
<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
<link rel="manifest" href="images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

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
        <img src="images/logo.png" height="50px" width="50px">
        <a href="seance.php" class="navbar-brand">Gestion des projets <span>fin d'études</span></a>
        <ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php echo $_SESSION['user_id']; ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="parametre.php"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Paramètres</a></li>
							<li><a href="login.php?a='a'"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>

		</div><!-- /.container-fluid -->
	</nav>

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li><a href="addsujet.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Mes sujets</a></li>
        <li class="active"><a href="historiques.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>Historiques des sujets</a></li>
        <li><a href="seance.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Suivi des seances</a></li>
        <li><a href="soutenance.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Jours de soutenance</a></li>
        <li role="presentation" class="divider"></li>
    </ul>
	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Historiques</h1>
			</div>
		</div><!--/.row-->

		<?php
        //fetch table rows from mysql db
        $sql = "select p.*,a.year,pr.niveau from projet p,annee a,promotion pr where p.Promotion_code=pr.id and pr.annee_code=a.code and p.validation=1";
        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

        //create an array
        $emparray = array();
        while($row =mysqli_fetch_assoc($result)) {
            $emparray[] = $row;
        }

        $json_data = json_encode($emparray);
        file_put_contents('tables/historique.json', $json_data);
        ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Liste des sujets</div>
					<div class="panel-body">
						<table id="eventsTable" data-toggle="table" data-url="tables/historique.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
                  <th data-field="Code" data-sortable="true">Code</th>
                  <th data-field="Designation" data-sortable="true">Designation</th>
                  <th data-field="Technologie" data-sortable="true">Technologie</th>
                  <th data-field="Duree" data-sortable="true">Technologie</th>
                  <th data-field="Outil" data-sortable="true">Outils</th>
                  <th data-field="Prerequis" data-sortable="true">Prerequis</th>
                  <th data-field="niveau" data-sortable="true">Niveau</th>
                  <th data-field="Duree" data-sortable="true">Duree (jours)</th>
                  <th data-field="Plan_travail" data-sortable="true">Plan travail</th>
                  <th data-field="year" data-sortable="true">Année</th>
                  <th data-field="Validation" data-sortable="true">Validation</th>
						    </tr>
						    </thead>
						</table>
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
  <script src="js/historiques.js"></script>
	<script src="js/bootstrap-table.js"></script>
  <script src="js/sweetalert.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>



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

    <?php } } else {
      ?>
      <script>
          window.location = "parametre.php?a='a'";
      </script>
      <?php
    } }else {
      ?>
      <script>
          window.location = "404.html";
      </script>
      <?php   }?>
