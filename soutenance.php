<!DOCTYPE html>
<script>var equipe_jour = [] ;</script>
<?php
session_start();

if (isset($_SESSION['user_id'])) {
            $type= $_SESSION['type'];
if ($_SESSION['premiere'] == 0) {
if ($type == "enseignant") {


require('queries/dbsetup.php');
$username = $_SESSION['user_id'];

$sql = "select matricule from enseignant where username='".$_SESSION['user_id']."' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$matricule = $row['matricule'];

// les jours de soutenance
$sql = "select distinct s.* from soutenance s,salle sa,jury j,enseignant e,enseignant_has_jury has where e.matricule=".$matricule."
and e.matricule=has.enseignant_matricule and j.numero=has.jury_numero and j.numero=s.jury_numero ";
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
$jours = null;
while ($row = mysqli_fetch_array($result)) {
  $jours[] = $row['Jour'];
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestions des projets fin d'études</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/soutenance.css" rel="stylesheet">
<link rel="stylesheet" href="bower_components/sweetalert2/dist/sweetalert2.min.css">
<link href="css/sweetalert.css" rel="stylesheet" type="text/css">
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
        <img src="images/logo.png" height="50px" width="50px">
        <a href="seance.php" class="navbar-brand">Gestion des projets <span>fin d'études</span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $_SESSION['user_id']; ?><span class="caret"></span></a>
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
          <li><a href="historiques.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>Historiques des sujets</a></li>
          <li><a href="seance.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Suivi des seances</a></li>
          <li  class="active"><a href="soutenance.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Jours de soutenance</a></li>
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
          <center>
          <div class="panel-heading">Vos jours de soutenance</div>

            <select class="form-control" style="width: 50%;"  id="jours">
            <option >Choisi le jour </option>
          <?php

          for ($i=0 ; $i < sizeof($jours); $i++) { ?>
              <option value=""><?php echo $jours[$i]; ?></option>
          <?php }  ?>
        </select></br>
          <?php
          for ($j = 0 ; $j < sizeof($jours) ; $j++) {
            // l'equipe concerné pour la soutenance
            $sql = "select equipe_numero from soutenance where jour = '".$jours[$j]."' " ;
            $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            while ( $idEquipe = mysqli_fetch_array($result) ) {
              $data[] = $idEquipe['equipe_numero'];
            }
            for ($k =0;$k<sizeof($data);$k++) {
            ?>
            <div style="display: none;" class="<?php echo "a".$data[$k]; ?> " >
              <script> equipe_jour.push(['<?php echo str_replace('/','_',$jours[$j]); ?>' , '<?php echo "a".$data[$k]; ?>']);</script>
            <?php
            // les informations du projet de chaque equipe
            $sql = "select p.designation from projet p,equipe e where e.projet_code=p.code and e.numero=".$data[$k]." " ;
            $result = mysqli_query($conn,$sql) ;
            $titre = mysqli_fetch_array($result)['designation']; ?>
            <label style><?php echo "<h1> Titre de projet:  ".$titre. "</h1>"; ?></label><br>

            <?php // les etudiants de chaque soutenance
            $sql = "select distinct et.nom,et.prenom from equipe e,soutenance s,etudiant et where s.jour='".$jours[$j]."'
             and s.equipe_numero=e.numero and et.equipe_numero=e.numero and et.equipe_numero = ".$data[$k]." ";
            $result = mysqli_query($conn,$sql);
            while ($row = mysqli_fetch_array($result)) {
              $etudiants[] = $row;
            }

            $sqlSalleDate = " select heure_debut,heur_fin,salle_numero from soutenance where equipe_numero=".$data[$k]." ";
            $result = mysqli_query($conn,$sqlSalleDate);
            $salle_date = mysqli_fetch_array($result);
            $salle = $salle_date['salle_numero'];
            $heure = $salle_date['heure_debut'];

            echo "Les membres de l'equipe </br>";
            for ($i=0 ; $i < sizeof($etudiants)  ; $i++) {  ?>
              <label><?php echo "<h4>" .$etudiants[$i]['nom'] ." ". $etudiants[$i]['prenom']. "</h4>" ; ?></label></br>
            <?php } ?>
            <label><?php echo "<h4>".$heure." dans la salle: ".$salle."</h4>"; ?></label></br>
            <?php
            $sql = " select * from note where Enseignant_Matricule=".$_SESSION['matricule']." and equipe_numero=".$data[$k]." ";
            $result = mysqli_query($conn,$sql);
            $result = mysqli_fetch_array($result);
            if ($result['note_livrable'] == null ) {
             ?>

            <form action="queries/note.php" method="post" id="<?php echo "id".$data[$k]; ?>">
              <input style="display: none;" name="equipe" value="<?php echo $data[$k]; ?>"></input>
              <input onchange="checkNote(this)" class="form-control" style="width: 30%;" id="note" name="note_logiciel" placeholder="Note Logiciel" type="text"></input><br>
              <input onchange="checkNote(this)" class="form-control" style="width: 30%;" id="note" name="note_livrable" placeholder="Note Livrable" type="text"></input><br>
              <input onchange="checkNote(this)" class="form-control" style="width: 30%;" id="note" name="note_presentation" placeholder="Note Présentation" type="text"></input><br>
              <button onclick="noter(this)" type="submit" class="btn btn-primary" id="<?php echo $data[$k]; ?>">Noter </button>
              <input style="display:none;" id="help"></input>
              <label style="display:none;" id="txtHint"></label>
              <p id="result"></p>
            </form>
            <?php } else {  ?>
            <label style="width: 70%;" class="form-control"><?php echo "Vous avez donné a cette equipe note livrable: ".$result['note_livrable']."/20"; ?></label>
            <label style="width: 70%;" class="form-control"><?php echo "Vous avez donné a cette equipe note logiciel: ".$result['note_logiciel']."/20"; ?></label>
            <label style="width: 70%;" class="form-control"><?php echo "Vous avez donné a cette equipe note présentation: ".$result['note_presentation']."/20"; ?></label>
            <?php } ?>
            <br></div> <?php unset($etudiants); } unset($data); } ?>
          </center>
        </div>
			</div>
    </div>
</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <script>
  $(function() {
    $('#jours').change(function() {
      $('#jours option').eq(0).attr('disabled','true');
      var selectedPromo = $('#jours option:selected').text();
      selectedPromo = selectedPromo.replace('/','_',$('#jours option:selected').text());
      selectedPromo = selectedPromo.replace('/','_',$('#jours option:selected').text());
      var allOptions = $('#jours option').size();

      for (var i=0;i<equipe_jour.length;i++) {
          $('.'+equipe_jour[i][1]).attr('style','display: none;');
        }

      for (var i=0;i<equipe_jour.length;i++) {
        if (equipe_jour[i][0] == selectedPromo) {
          $('.'+equipe_jour[i][1]).attr('style','display: inline;');
        }
      }
    });
  });



  /**
   * Index of Multidimensional Array
   * @param arr {!Array} - the input array
   * @param k {object} - the value to search
   * @return {Array}
   */
  function getIndexOfK(arr, k) {
    for (var i = 0; i < arr.length; i++) {
      var index = arr[i].indexOf(k);
      if (index > -1) {
        return [i, index];
      }
    }
  }

  // console.log('The value #' + needle + ' is located at array[' + result[0] + '][' + result[1] + '].');


  </script>
  <script src="js/sweetalert.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/popup.js"></script>


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
  <script>
  var nbrForms = document.forms.length;
  for (var i=0;i<nbrForms;i++) {
    var form = document.forms[i].id;
    $("#"+form).submit(function(){
      return false;
    });
  }
  function noter(e) {
    var formID = $(e).parent().attr('id');

    $.post(
    $('#'+formID).attr('action'),
    $('#'+formID+' :input').serializeArray(),
    function(result){
      $('#result').html(result);
    });
  }

  function checkNote(e){
    var val = $(e).val();
    if ($.isNumeric(val)) {
      if ( (val>20) || (val<0) ) {
        $(e).attr('style','width: 30%;border-color: red;');
      } else {
        $(e).attr('style','width: 30%;');
      }
    } else {
      $(e).attr('style','width: 30%;border-color: red;');
    }
  }
  /*
  $.post(
  $("#"+form).attr('action'),
  $("#"+form+' :input').serializeArray(),
  function(result){
    $('#result').html(result);
  });
  */


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
