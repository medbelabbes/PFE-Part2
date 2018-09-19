<!DOCTYPE html>
<?php
session_start();
require('queries/dbsetup.php');
if (isset($_SESSION['user_id'])) {
$type= $_SESSION['type'];

$premiere = mysqli_fetch_array(mysqli_query($conn," select premiere from ".$type." where username = '".$_SESSION['user_id']."' "))['premiere'];

if ($premiere == 0) {


  if ($type == "enseignant") {

    $matricule = $_SESSION['matricule'];



    ?>
    <html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Gestions des projets fin d'études</title>

      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/datepicker3.css" rel="stylesheet">
      <link href="css/styles.css" rel="stylesheet">
      <link href="css/modal.css" rel="stylesheet">
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

        </div>
        <!-- /.container-fluid -->
      </nav>

      <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <ul class="nav menu">
            <li><a href="addsujet.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Mes sujets</a></li>
            <li><a href="historiques.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>Historiques des sujets</a></li>
            <li class="active"><a href="seance.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg>Suivi des seances</a></li>
            <li><a href="soutenance.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Jours de soutenance</a></li>
            <li role="presentation" class="divider"></li>
        </ul>
      </div>
      <!--/.sidebar-->

      <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Suivi des seance</h1>
          </div>
        </div>
        <!--/.row-->
        <button class="btn btn-primary" id="myBtn">Ajouter une nouvelle seance</button>

        <?php
        // les equipes encadrés par l'enseignant
        $sqlEquipes = " select e.designation as code,e.numero as Numero from equipe e,projet prj,proposer p,enseignant prof where prof.matricule=".$matricule." and p.enseignant_matricule=prof.matricule and e.projet_code=prj.code and prj.code=p.projet_code group by e.numero ";
        $result_equipes = mysqli_query($conn,$sqlEquipes) or die(mysqli_error($conn));


        ?>

        <!-- The Modal -->
        <div id="myModal" class="modal">
<input id="txtHint" >
          <!-- Modal content -->
          <div class="modal-content">
            <div class="modal-header">
              <span class="close">&times;</span>
              <h2>Les informations de nouvelle seance</h2>
            </div>
            <div class="modal-body"><br>
              <form id="e1" action="queries/insert_seance.php" method="post">
                <center>
                  <input style="display: none;" name="enseignant_matricule" value="<?php echo $matricule; ?>" >
                  <input type="datepicker" id="calendar" name="date" class="datepicker form-control" style="width: 40%;margin-bottom: 20px;" placeholder="Date">
                  <input onchange="checkNote(this)" name="note_global" class="form-control" style="width: 40%;margin-bottom: 20px;" placeholder="Note Global">
                  <select onchange="getMembres(this)" id="equipes_select" name="equipes_select" style="width: 40%;" class="form-control">
                    <option>Selectionnez votre equipe</option>
                    <?php
                    while ($row_equipes = mysqli_fetch_array($result_equipes)) {
                      // promo de chaque equipe
                      $sql_promo = " select niveau from promotion promo,equipe e,projet p where e.projet_code=p.code and p.promotion_code=promo.id and e.numero=".$row_equipes['Numero']." ";
                      $sql_promo = mysqli_query($conn,$sql_promo);
                      $sql_promo = mysqli_fetch_array($sql_promo);
                      $sql_promo = $sql_promo['niveau'];
                      ?>

                      <option value="<?php echo $row_equipes['Numero']; ?>"><?php echo "Equipe:".$row_equipes['code']." promo: ". $sql_promo; ?></option>
                      <?php }
                      ?>
                    </select><br>
                    <div id="membre">
                      <?php
                      $result_equipes = mysqli_query($conn,$sqlEquipes);
                      while ($row_equipes = mysqli_fetch_array($result_equipes)){
                        // les membres de chaque equipe
                        $sql_membre = " select username from etudiant where equipe_numero = ".$row_equipes['Numero']." ";
                        $sql_membre = mysqli_query($conn,$sql_membre);
                        while ($row_membre = mysqli_fetch_array($sql_membre)) { ?>
                          <input placeholder="<?php echo str_replace('.','_',$row_membre['username']); ?>" onchange="checkNote(this)" class="<?php echo "form-control e".$row_equipes['Numero']; ?>" style="display:none;" name="<?php echo str_replace('.','_',$row_membre['username']); ?>">
                          <?php } unset($row_membre);
                        }?></div><button id="ajouter" style="width: 40%;" class="btn btn-primary">Ajouter</button><br>

                      </center>
                      <p id="result"></p>
                    </form>
                  </div>
                </div>

              </div>


              <?php


              // nombre des equipes
              $sql = "select e.numero from equipe e,proposer p where p.Enseignant_Matricule=1 and e.projet_code=p.projet_code";
              $sql_seance = " select * from seance_encadrement where Enseignant_Matricule=".$matricule." group by equipe_code ";
              $result_seance1 = mysqli_query($conn,$sql_seance);
              // nome de seance Total
              $sql = " select count(*) as total from seance_encadrement where Enseignant_Matricule=".$matricule." " ;
              $total = mysqli_query($conn,$sql) or die("error seance_encadrement".mysqli_error($conn));
              $total = mysqli_fetch_array($total);
              $total = $total['total'];


              $idTab = 1;$seance=0;
              while ($result_seance = mysqli_fetch_array($result_seance1)) {
                unset($array);
                // les equipes
                $idEquipe=$result_seance['Equipe_Code'];

                // Le niveau de chaque equipe
                $sqlNiveau = "select promo.niveau from equipe e,projet p,promotion promo where e.projet_code=p.code and promo.id=p.promotion_code and e.numero=".$result_seance['Equipe_Code']." ";
                $resultNiveau = mysqli_query($conn,$sqlNiveau) or die(mysqli_error($conn));
                $resultNiveau = mysqli_fetch_array($resultNiveau);
                $resultNiveau = $resultNiveau['niveau'];


                $result = mysqli_query($conn,$sql);$i=$idTab;
                // nombre de seance pour chaque equipe
                $sql = " select * from seance_encadrement where equipe_code=".$idEquipe." and Enseignant_Matricule=".$matricule." ";
                $sqlEquipe = mysqli_query($conn,$sql);
                $nbrSeance = mysqli_num_rows($sqlEquipe);
                $seance+=$nbrSeance;
                // les memebres de chaque equipe
                $sql = " select * from etudiant where equipe_numero =".$idEquipe." ";

                $sqlMembre = mysqli_query($conn,$sql);
                while ($row = mysqli_fetch_array($sqlMembre)) {
                  $array[] = $row;
                }
                // save data to json file
                $json_data = json_encode($array);
                file_put_contents('tables/equipes'.$idEquipe.'.json',$json_data);
                // get data from json file
                $get_content = file_get_contents('tables/equipes'.$idEquipe.'.json');
                $get_json = json_decode($get_content,true);

                $row = mysqli_fetch_array($sqlEquipe);$numTab=2; // les seacnes de chaque equipe
                ?>
                <div class="col-lg-12">
                  <h1 class="page-header"><?php echo "Equipe ".$idEquipe." niveau: ".$resultNiveau ; ?></h1>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-body tabs">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="<?php echo "#tab".$i++; ?>" data-toggle="tab">Seance 1</a></li>
                          <?php
                          for ($i=($idTab+1);$i<=$seance;$i++) {  ?>
                            <li><a href="<?php echo "#tab".$i; ?>" data-toggle="tab">Seance <?php echo $numTab; ?></a></li>
                            <?php $numTab++;} ?>
                          </ul>

                          <div class="tab-content">
                            <div class="tab-pane fade in active" id="<?php echo "tab".$idTab; ?>">

                              <?php  // les notes globals
                              $sqlGlobal = " select * from appriciation_global where seance_encadrement_numero=".$row['Numero']." and equipe_numero=".$idEquipe." ";
                              $sqlGlobal = mysqli_query($conn,$sqlGlobal);
                              $sqlGlobal = mysqli_fetch_array($sqlGlobal);
                              $note_global = $sqlGlobal['Note_Global']; ?>

                              <div id="<?php echo "modal".$row['Numero']; ?>" class="modal">
                                <!-- Modal content -->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <span class="<?php echo "close".$row['Numero']; ?>" >&times;</span>
                                    <h2>Modifier une seance seance</h2>
                                  </div>
                                  <div class="modal-body"><br>
                                    <form id="<?php echo "e".$row['Numero']; ?>" action="queries/modifier_seance.php" method="post">
                                      <center>
                                        <input name="idEquipe" style="display:none;" value="<?php echo $idEquipe; ?>">
                                        <input id="seance_numero" style="display: none;" name="numero_seance" value="<?php echo $row['Numero']; ?>" >
                                        <label><?php echo "Date:" ?></label>
                                        <input type="datepicker" id="calendar" name="date" value="<?php echo $row['Date']; ?>" class="datepicker form-control" style="width: 40%;margin-bottom: 20px;" placeholder="Date">
                                        <label><?php echo "Note Global" ?></label>
                                        <input id="note_global" onchange="checkNote(this)" value="<?php echo $note_global; ?>" name="note_global" class="form-control" style="width: 40%;margin-bottom: 20px;" placeholder="Note Global">
                                        <div id="membre">
                                            <?php
                                            $result_equipes = mysqli_query($conn,$sqlEquipes);
                                              // les membres de chaque equipe
                                               for ($i=0;$i<sizeof($get_json);$i++) {
                                                // note assiduite pour chaque etudiant
                                                $assiduite = " select assiduite from appriciation_indv_assiduite where etudiant_matricule = ".$get_json[$i]['Matricule']." and seance_encadrement_numero=".$row['Numero']." ";
                                                $assiduite = mysqli_query($conn,$assiduite);
                                                $assiduite = mysqli_fetch_array($assiduite);
                                                $assiduite = $assiduite['assiduite'];
                                                ?>
                                                <label><?php echo "Note d'assiduite de :".$get_json[$i]['Nom']." ".$get_json[$i]['Prenom']; ?></label>

                                                <input value="<?php echo $assiduite; ?>" style="width: 40%;" name="<?php echo str_replace('.','_',$get_json[$i]['Username']); ?>" class="form-control">
                                                <?php }unset($assiduite);
                                              ?></div><button onclick="valider(this)" id="<?php echo $row['Numero']; ?>" style="width: 40%;" class="btn btn-primary">Modifier</button><br>

                                            <p id="result"></p>
                                            <center>
                                          </form>
                                        </div>
                                      </div>
                                    </div>


                              <label style="width: 40%;" class="form-control"><?php echo "Date: ".$row['Date']; ?></label>
                              <label style="width: 40%;"class="form-control"><?php echo "Note Global ".$note_global; ?></label>
                              <?php for ($i=0;$i<sizeof($get_json);$i++) {
                                // note assiduite pour chaque etudiant
                                $assiduite = " select assiduite from appriciation_indv_assiduite where etudiant_matricule = ".$get_json[$i]['Matricule']." and seance_encadrement_numero=".$row['Numero']." ";
                                $assiduite = mysqli_query($conn,$assiduite) or die(mysqli_error($conn));
                                $assiduite = mysqli_fetch_array($assiduite);
                                $assiduite = $assiduite['assiduite'];
                                ?>

                                <label style="width: 40%;" name="Date" class="form-control"><?php echo "Note d'assiduité de ".$get_json[$i]['Nom']." est :".$assiduite; ?></label>
                                <?php }unset($assiduite); ?>
                                <button onclick="supprimer(this)" style="width: 40%;" class="form-control" id="<?php echo $row['Numero'];?>">Supprimer</button>
                                <!-- <button onclick="modifier(this)" style="width: 40%;" class="form-control" id="<?php// echo $row['Numero'];?>">Modifier</button> -->
                              </div>
                            <?php $numTab=2;  for ($i=($idTab+1);$i<=$seance;$i++) { $row = mysqli_fetch_array($sqlEquipe);

                              ?>
                              <div class="tab-pane fade" id="<?php echo "tab".$i; ?>">


                                <?php // les notes globals

                                $sqlGlobal = " select * from appriciation_global where seance_encadrement_numero=".$row['Numero']." and equipe_numero=".$idEquipe." ";
                                $sqlGlobal = mysqli_query($conn,$sqlGlobal);
                                $sqlGlobal = mysqli_fetch_array($sqlGlobal);
                                $note_global = $sqlGlobal['Note_Global']; ?>

                                <label style="width: 40%;" class="form-control"><?php echo "Date: ".$row['Date']; ?></label>
                                <label style="width: 40%;" class="form-control"><?php echo "Note Global ".$note_global; ?></label>
                                <?php $j=0; while ($j<sizeof($get_json)) {
                                  // note assiduite pour chaque etudiant
                                  $assiduite = " select assiduite from appriciation_indv_assiduite where etudiant_matricule = ".$get_json[$j]['Matricule']." and seance_encadrement_numero=".$row['Numero']." ";
                                  $assiduite = mysqli_query($conn,$assiduite);
                                  $assiduite = mysqli_fetch_array($assiduite);
                                  $assiduite = $assiduite['assiduite'];
                                  ?><label style="width: 40%;" name="Date" class="form-control"><?php echo "Note d'assiduité de ".$get_json[$j]['Nom']." est :".$assiduite; ?></label><?php
                                  ?>

                                  <button onclick="supprimer(this)" style="width: 40%;" class="form-control" id="<?php echo $row['Numero'];?>">Supprimer</button>
                                  <!-- <button onclick="modifier(this)" style="width: 40%;" class="form-control" id="<?php // echo $row['Numero'];?>">Modifier</button> -->
                                  <?php $j=$j+1; } unset($assiduite);?>



                                  <div id="<?php echo "modal".$row['Numero']; ?>" class="modal">
                                    <!-- Modal content -->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <span class="<?php echo "close".$row['Numero']; ?>" >&times;</span>
                                        <h2>Modifier une seance seance</h2>
                                      </div>
                                      <div class="modal-body"><br>
                                        <form id="<?php echo "e".$row['Numero']; ?>" action="queries/modifier_seance.php" method="post">
                                          <center>
                                            <input name="idEquipe" style="display:none;" value="<?php echo $idEquipe; ?>">
                                            <input id="seance_numero" style="display: none;" name="numero_seance" value="<?php echo $row['Numero']; ?>" >
                                            <label><?php echo "Date:" ?></label>
                                            <input type="datepicker" id="calendar" name="date" value="<?php echo $row['Date']; ?>" class="datepicker form-control" style="width: 40%;margin-bottom: 20px;" placeholder="Date">
                                            <label><?php echo "Note Global" ?></label>
                                            <input id="note_global" onchange="checkNote(this)" value="<?php echo $note_global; ?>" name="note_global" class="form-control" style="width: 40%;margin-bottom: 20px;" placeholder="Note Global">
                                            <div id="membre">
                                                <?php
                                                $result_equipes = mysqli_query($conn,$sqlEquipes);
                                                  // les membres de chaque equipe
                                                   $j=0; while ($j<sizeof($get_json)) {
                                                    // note assiduite pour chaque etudiant
                                                    $assiduite = " select assiduite from appriciation_indv_assiduite where etudiant_matricule = ".$get_json[$j]['Matricule']." and seance_encadrement_numero=".$row['Numero']." ";
                                                    $assiduite = mysqli_query($conn,$assiduite);
                                                    $assiduite = mysqli_fetch_array($assiduite);
                                                    $assiduite = $assiduite['assiduite'];
                                                    ?>
                                                    <label><?php echo "Note d'assiduite de :".$get_json[$j]['Nom']." ".$get_json[$j]['Prenom']; ?></label>

                                                    <input value="<?php echo $assiduite; ?>" style="width: 40%;" name="<?php echo str_replace('.','_',$get_json[$j]['username']); ?>" class="form-control">
                                                    <?php $j=$j+1; }unset($assiduite);
                                                  ?></div><button onclick="valider(this)" id="<?php echo $row['Numero']; ?>" style="width: 40%;" class="btn btn-primary">Modifier</button><br>

                                                <p id="result"></p>
                                              </center>
                                              </form>
                                            </div>
                                          </div>
                                        </div>

                              </div> <?php } ?>
                            </div>
                          </div>
                        </div><!--/.panel-->
                      </div><!--/.col-->
                    </div>
                    <?php  $idTab+=$seance;$nbrSeance+=$seance; } ?>
                    <!--/.row-->
                  </div>

                  <script src="js/jquery-1.11.1.min.js"></script>
                  <script src="js/sweetalert.min.js"></script>
                  <script src="js/bootstrap.min.js"></script>
                  <script src="js/chart.min.js"></script>
                  <script src="js/chart-data.js"></script>
                  <script src="js/easypiechart.js"></script>
                  <script src="js/popup.js"></script>
                  <script src="js/easypiechart-data.js"></script>
                  <script src="js/bootstrap-datepicker.js"></script>
                  <script>
                  $('.datepicker').datepicker({});

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
