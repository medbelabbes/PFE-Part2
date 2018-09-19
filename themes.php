<!DOCTYPE html>

<?php
session_start();
require('queries/dbsetup.php');
if (isset($_SESSION['user_id'])) {
  $type= $_SESSION['type'];
  $premiere = mysqli_fetch_array(mysqli_query($conn," select premiere from ".$type." where username = '".$_SESSION['user_id']."' "))['premiere'];

  if ($premiere == 0) {

            if ($type == 'etudiant') {


$sql = " select equipe_numero from etudiant where username='".$_SESSION['user_id']."' ";
$result = mysqli_query($conn,$sql) or die("error: ".mysqli_error($conn));
$aaa = mysqli_fetch_array($result);
?>
<div id="groupe">test</div>
<script>
var groupe = "<?php echo $aaa['equipe_numero']; ?>";
document.getElementById('groupe').innerHTML = groupe;

</script>


<?php
$username = $_SESSION['user_id'];

$sql = " select promotion_id from etudiant where username='".$username."' ";
$result = mysqli_query($conn,$sql);
$promotion_id = mysqli_fetch_array($result);
$promotion_id = $promotion_id['promotion_id'];


$sql = "select Equipe_Numero from etudiant where username='".$_SESSION['user_id']."'  ";
$result = mysqli_query($conn,$sql) or die("error".mysqli_error($conn));
$row = mysqli_fetch_array($result);
$idEquipe = $row['Equipe_Numero'];
$sql = "select equipe_numero from choisir where equipe_numero ='".$idEquipe."'  ";
$result = mysqli_query($conn,$sql) or die("error".mysqli_error($conn));
$row = mysqli_fetch_array($result);
$hasEquipe = $row['equipe_numero'];
$sql = "select qualite from etudiant where username = '".$_SESSION['user_id']."'  ";
$result = mysqli_query($conn,$sql);
$qualite_result = mysqli_fetch_array($result);
$qualite = $qualite_result['qualite'];


?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestions des projets fin d'études</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/theme.css" rel="stylesheet">
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
        <script src="js/test.js"></script>

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
        <a href="groupes.php" class="navbar-brand">Gestion des projets <span>fin d'études</span></a>
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

            </div>
            <!-- /.container-fluid -->
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
          <ul class="nav menu">
              <li><a href="groupes.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Groupe</a></li>
              <li class="active"><a href="themes.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Thêmes</a></li>
              <li role="presentation" class="divider"></li>
          </ul>

        </div>
        <!--/.sidebar-->
        <?php

    if ($hasEquipe == null ) { ?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêmes</h1>
                </div>
            </div>
            <!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Les thêmes disponibles</div>
                        <div class="panel-body">

                            <?php
                            // recuperer promotion_id de l'etudiant
                            $sql ="select distinct s.promotion_numero as numero from etudiant e,groupe g,section s,promotion p where e.username='".$_SESSION['user_id']."' and e.Groupe_Numero=g.id
                            and g.section_code = s.id " ;
                            $result = mysqli_query($conn,$sql) or die('error'.mysqli_error($conn));
                            $row = mysqli_fetch_array($result);
                            $promo_id = $row['numero'];
                            // recuperer le choix_max
                            $sql ="select par.nbr_max from parametre par, promotion promo where promo.id=par.promotion_numero and promo.id=".$promo_id." ";
                            $result = mysqli_query($conn,$sql) or die('error'.mysqli_error($conn));
                            $row = mysqli_fetch_array($result);
                            $choix_max = $row['nbr_max'];
                            // recuperer le choix_min
                            $sql ="select par.nbr_min from parametre par, promotion promo where promo.id=par.promotion_numero and promo.id=".$promo_id." ";
                            $result = mysqli_query($conn,$sql) or die('error'.mysqli_error($conn));
                            $row = mysqli_fetch_array($result);
                            $choix_min = $row['nbr_min'];
                            ?>
                            <div style="display: none;" id="choix_max"><?php echo $choix_max; ?></div>
                            <div style="display: none;" id="choix_min"><?php echo $choix_min; ?></div>
                            <script>var choix_max = document.getElementById('choix_max').innerHTML;</script>
                            <script>var choix_min = document.getElementById('choix_min').innerHTML;</script>
                            <input style="display: none;" id="help"></input>
                            <label style="display: none;" id="txtHint"></label>
                            <?php

                             $sql = "select p.*,a.year,pr.niveau from projet p,annee a,promotion pr where p.Promotion_code=pr.id and pr.annee_code=a.code and p.validation=1 and promotion_code=".$promotion_id." ";
                              $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
                              while($row =mysqli_fetch_assoc($result)) {
                                  $emparray2[] = $row;
                              }
                              if (isset($emparray2)) {

                              $json_data = json_encode($emparray2);
                              file_put_contents('tables/projets.json', $json_data); ?>

                            <table id="eventsTable" data-toggle="table" data-url="tables/projets.json" data-show-refresh="true" data-show-toggle="true"
                            data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true"
                            data-sort-name="name" data-sort-order="desc">
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
                                    </tr>
                                </thead>
                            </table>
                        <?php  } else {
                          echo " Aucun sujet n'est disponible pour votre promotion."  ;
                        }?>
                        </div>
                    </div>
                </div>
            </div>
<?php if ($qualite === 'chef') { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                  <?php $nbr_max = mysqli_fetch_array(mysqli_query($conn," select para.nbr_max from parametre para,etudiant e where para.promotion_numero=e.promotion_id and e.matricule=".$_SESSION['matricule']." "))['nbr_max'];
                  $nbr_min = mysqli_fetch_array(mysqli_query($conn," select para.nbr_min from parametre para,etudiant e where para.promotion_numero=e.promotion_id and e.matricule=".$_SESSION['matricule']." "))['nbr_min'];
                 echo "Fiche de voeux ( Max: ".$nbr_max." Min: ".$nbr_min.")"?></div>
                <div class="panel-body">
<div class="subject-info-box-1">
  <select multiple="multiple" id='lstBox1' class="form-control">
    <?php
    for ($i = 0 ; $i < sizeof($emparray2) ; $i++) { ?>
      <<option value="<?php echo $emparray2[$i]['Code'] ; ?>"><?php echo $emparray2[$i]['Code'] ; ?></option>
    <?php } ?>

  </select>
</div>

<div class="subject-info-arrows text-center">
  <input type='button' id='btnRight' value='>' class="btn btn-default" /><br />
  <input type='button' id='btnLeft' value='<' class="btn btn-default" /><br />
  <input type='button' id='btnAllLeft' value='<<' class="btn btn-default" /><br />
  <input type='button' id='btnUp' value='up' class="btn btn-default" />
  <input type='button' id='btnDown' value='down' class="btn btn-default" /><br />
  <input type='button' id='btnSubmit' value='valider' class="btn btn-default" /><br />
</div>

<div class="subject-info-box-2">
  <select multiple="multiple" id='lstBox2' class="form-control">
  </select>
</div>

<div class="clearfix"></div>

                    <form class="form-horizontal" role="form" method="post" id="form" name="form">

                        <?php
                        // tous les projets de 2017
                        $sql = "select prj.* from annee a,projet prj,promotion promo where a.year = '2017'
                        and prj.promotion_code=promo.id and promo.annee_code=a.code";
                        $result = mysqli_query($conn,$sql);

                        if ($row = mysqli_fetch_array($result)) {

                        }
    if (isset($_POST['submit'])) {

        $v2 = $_POST['c'.($i-1)];
        $boolean = true;
        for ($i=1;$i<=$nbrChoix;$i++) {
            if(1<$i){$v2 = $_POST['c'.($i-1)];}
            $v = $_POST['c'.$i];

        $result = mysqli_query($conn,"set autocommit=0") or die("error".mysqli_error($conn));
        if ( !empty($v) and ($v <> $v2) ) {

        $sql = "insert into choisir (equipe_numero,Projet_Code,Ordre) values('".$idEquipe."','".$_POST['c'.$i]."','".$i."')";
        $result = mysqli_query($conn,$sql) or die("error".mysqli_error($conn));

        } else {             ?>
            <div class="alert bg-danger " role="alert">
                <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>Vérifie que tous les champs soit remplis et différents !<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
            <?php $boolean=false; break;}}
    if ($boolean) {$result = mysqli_query($conn,"commit") or die("error".mysqli_error($conn));
    $result = mysqli_query($conn,"set autocommit=1") or die("error".mysqli_error($conn));
  }}} ?>
                    </form>
                </div>
            </div>
        </div>
        <?php } else {  ?>

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Resultats</h1>
                </div>
            </div>
            <!--/.row-->


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Votre fiche de voeux</div>
                        <div class="panel-body">
                            <?php

                                $sql = "select * from choisir where equipe_numero='".$idEquipe."' order by ordre asc";
                                $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
                                while($row =mysqli_fetch_assoc($result)) {
                                    $emparray3[] = $row;
                                }
                                $json_data = json_encode($emparray3);
                                file_put_contents('tables/fichedevoeux.json', $json_data); ?>

                            <table data-toggle="table" data-url="tables/fichedevoeux.json" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                                <thead>
                                    <tr>
                                        <th data-field="Projet_Code" data-sortable="true">Projet code</th>
                                        <th data-field="Ordre" data-sortable="true">Ordre</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Resulta final -->
            <div class="panel panel-default">
                <div class="panel-heading">Les informations de votre projet</div>
                <div class="panel-body">
                    <?php
        $sql = "select Projet_Code from equipe where Numero='".$idEquipe."'  ";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        if ($row['Projet_Code'] == null) {
            echo "<label class=\"form-control\" > L'affectation n'a pas été faites pour le moment. </label>";
        } else {
          $sql = " select * from projet where code =".$row['Projet_Code']." ";
          $sql = mysqli_query($conn,$sql);
          $projet = mysqli_fetch_array($sql);
          $encadreur = " select enseignant_matricule from proposer where projet_code=".$row['Projet_Code']." ";
          $encadreur = mysqli_query($conn,$encadreur);
          $encadreur = mysqli_fetch_array($encadreur);
          $encadreur = " select nom,prenom from enseignant where matricule=".$encadreur['enseignant_matricule']." ";
          $encadreur = mysqli_query($conn,$encadreur);
          $encadreur = mysqli_fetch_array($encadreur);
           ?>
            <h4 class=\"form-control\" ><?php echo "Le code de projet: ".$row['Projet_Code']; ?></h4><br>
            <h4 class=\"form-control\" ><?php echo "Encadreur: Mr. ".$encadreur['nom']." ".$encadreur['prenom']; ?></h4><br>
            <h4 class=\"form-control\" ><?php echo "Designation: ".$projet['Designation']; ?></h4><br>
            <h4 class=\"form-control\" ><?php echo "Spécialité: ".$projet['Specialite']; ?></h4><br>
            <h4 class=\"form-control\" ><?php echo "Technologie: ".$projet['Technologie']; ?></h4><br>
            <h4 class=\"form-control\" ><?php echo "Outil: ".$projet['Outil']; ?></h4><br>
            <h4 class=\"form-control\" ><?php echo "Prerequis: ".$projet['Prerequis']; ?></h4><br>
            <h4 class=\"form-control\" ><?php echo "Résumé: ".$projet['Resume']; ?></h4><br>
            <h4 class=\"form-control\" ><?php echo "Durée: ".$projet['Duree']; ?></h4><br>
            <h4 class=\"form-control\" ><?php echo "Plan de travail: ".$projet['Plan_travail']; ?></h4><br>
        <?php }
                   ?>
                </div>
            </div>

            <!-- La date de soutenance -->
            <div class="panel panel-default">
              <div class="panel-heading">La date de soutenance</div>
              <div class="panel-body">
                  <?php
      $sql = "select * from soutenance where equipe_numero='".$idEquipe."'  ";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);
      if ($row['Code'] == null) {
          echo "<label class=\"form-control\" > Le jour de la soutenance n'a pas été fixé pour le moment. </label>";
      } else {
          $sql_salle = mysqli_fetch_array(mysqli_query($conn," select designation from salle where numero=".$row['Salle_Numero']."  "))['designation'];
          echo "<label class=\"form-control\" >Votre soutenance aura lieu le: ".$row['Jour']." de ".$row['Heure_Debut']." à " .$row['Heur_Fin']." dans la salle: ".$sql_salle." </label>" ;
      }
         ?>
              </div>
        </div>

        <?php
        $nbr_jury = mysqli_fetch_array(mysqli_query($conn," select count(*) as total from note where equipe_numero=".$aaa['equipe_numero']." "))['total'];
        $max_jury = mysqli_fetch_array(mysqli_query($conn," select Nmbre_enseignant from jury j,soutenance s where j.numero=s.jury_numero and s.equipe_numero=".$aaa['equipe_numero']." "))['Nmbre_enseignant'];

        if ($max_jury == $nbr_jury) {

        ?>
        <div class="panel panel-default">
          <div class="panel-heading">Note finale</div>
          <div class="panel-body">
            <?php
            // note livrable
            $note_livrable = 0;
            $query = mysqli_query($conn," select note_livrable from note where equipe_numero=".$aaa['equipe_numero']." ");
            while ($note = mysqli_fetch_array($query)) {
              $note_livrable += $note['note_livrable'];
            }
            $note_livrable = $note_livrable/$max_jury;
            $coef_livrable = mysqli_fetch_array(mysqli_query($conn," select coe_livrable from element_evaluation element,equipe e where e.numero=".$aaa['equipe_numero']." and e.promotion_numero=element.promotion_id  "))['coe_livrable'];
            // note logiciel
            $note_logiciel = 0;
            $query = mysqli_query($conn," select note_logiciel from note where equipe_numero=".$aaa['equipe_numero']." ");
            while ($note = mysqli_fetch_array($query)) {
              $note_logiciel += $note['note_logiciel'];
            }
            $note_logiciel = $note_logiciel/$max_jury;
            $coef_logiciel = mysqli_fetch_array(mysqli_query($conn," select coe_logiciel from element_evaluation element,equipe e where e.numero=".$aaa['equipe_numero']." and e.promotion_numero=element.promotion_id  "))['coe_logiciel'];
            // note presentation
            $note_presentation = 0;
            $query = mysqli_query($conn," select note_presentation from note where equipe_numero=".$aaa['equipe_numero']." ");
            while ($note = mysqli_fetch_array($query)) {
              $note_presentation += $note['note_presentation'];
            }
            $note_presentation = $note_presentation/$max_jury;
            $coef_presentation = mysqli_fetch_array(mysqli_query($conn," select coe_presentation from element_evaluation element,equipe e where e.numero=".$aaa['equipe_numero']." and e.promotion_numero=element.promotion_id  "))['coe_presentation'];
            // note global
            $note_global = 0;$seances=0;
            $query = mysqli_query($conn," select note_global from appriciation_global where equipe_numero=".$aaa['equipe_numero']." ");
            while ($note = mysqli_fetch_array($query)) {
              $note_global += $note['note_global'];
              $seances++;
            }
            $note_global = $note_global/$seances;
            $coef_global = mysqli_fetch_array(mysqli_query($conn," select coe_appglobale from element_evaluation element,equipe e where e.numero=".$aaa['equipe_numero']." and e.promotion_numero=element.promotion_id  "))['coe_appglobale'];
            // note assiduite
            $note_assiduite = 0;
            $query = mysqli_query($conn," select assiduite from appriciation_indv_assiduite where etudiant_matricule=".$_SESSION['matricule']." ") or die(mysqli_error($conn));
            while ($note = mysqli_fetch_array($query)) {
              $note_assiduite += $note['assiduite'];
            }
            $note_assiduite = $note_assiduite/$seances;
            $coef_assiduite = mysqli_fetch_array(mysqli_query($conn," select coe_appindividu from element_evaluation element,equipe e where e.numero=".$aaa['equipe_numero']." and e.promotion_numero=element.promotion_id  "))['coe_appindividu'];
            // calculons la moyenne
            $somme = ($note_livrable*$coef_livrable) + ($note_logiciel*$coef_logiciel) + ($note_presentation*$coef_presentation) + ($note_global*$coef_global) + ($note_assiduite*$coef_assiduite);
            $coe = $coef_livrable + $coef_logiciel + $coef_presentation + $coef_global +$coef_assiduite;
            echo "Votre note finale du projet est :".round($moy = $somme/$coe,2);







             ?>
          </div>
        </div>
        <?php } ?>



        <?php } ?>
        <script src="js/sweetalert.min.js"></script>
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/chart.min.js"></script>
        <script src="js/theme.js"></script>
        <script src="js/chart-data.js"></script>
        <script src="js/easypiechart.js"></script>
        <script src="js/easypiechart-data.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>


        <script>
            ! function($) {
                $(document).on("click", "ul.nav li.parent > a > span.icon", function() {
                    $(this).find('em:first').toggleClass("glyphicon-minus");
                });
                $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
            }(window.jQuery);

            $(window).on('resize', function() {
                if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
            })
            $(window).on('resize', function() {
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
