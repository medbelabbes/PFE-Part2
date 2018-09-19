<!DOCTYPE html>

<?php
     session_start();
require('queries/dbsetup.php');

if (isset($_SESSION['user_id'])) {

  $premiere = mysqli_fetch_array(mysqli_query($conn," select premiere from ".$_SESSION['type']." where username = '".$_SESSION['user_id']."' "))['premiere'];
if ($premiere == 0) {
        $type= $_SESSION['type'];
        if ($type == 'etudiant') {



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
        <a href="groupes.php" class="navbar-brand">Gestion des projets <span>fin d'études</span></a>
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

            </div>
            <!-- /.container-fluid -->
        </nav>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <ul class="nav menu">
                <li class="active"><a href="groupes.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Groupe</a></li>
                <li><a href="themes.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Thêmes</a></li>
                <li role="presentation" class="divider"></li>
            </ul>
        </div>
        <!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Groupes</h1>
                </div>
            </div>
            <!--/.row-->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Mon groupe de projet</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <?php

                            $sql = "select Equipe_Numero from etudiant where username ='".$_SESSION['user_id']."'";
                            $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
                            $row = mysqli_fetch_array($result);
                            $sql = " select designation from equipe where numero=".$row['Equipe_Numero']." ";
                            $sql = mysqli_query($conn,$sql)or die("Error in designation " . mysqli_error($conn));
                            $sql = mysqli_fetch_array($sql);

                            if ($sql['designation'] <> null) {
                                $numEquipe = $sql['designation'];
                                echo "Le numero de votre equipe est: ".$numEquipe;
                                $sql = "select * from etudiant where Equipe_Numero ='".$numEquipe."'";
                                $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
                                while($row =mysqli_fetch_assoc($result)) {
                                    $emparray2[] = $row;
                                }
                                $json_data = json_encode($emparray2);
                                file_put_contents('tables/equipe.json', $json_data); ?>

                                    <table data-toggle="table" data-url="tables/equipe.json" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                                        <thead>
                                            <tr>
                                                <th data-field="Matricule" data-sortable="true">Matricule</th>
                                                <th data-field="Nom" data-sortable="true">Nom</th>
                                                <th data-field="Prenom" data-sortable="true">Prenom</th>
                                                <th data-field="Email" data-sortable="true">Email</th>
                                                <th data-field="Qualite" data-sortable="true">qualite</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <?php

                            } else {
                                echo "Vous n'appartient à aucune équipe pour le moment.";
                            }

                            /*
                            ?>

                                        <table>
                                            <form method="get">
                                                <tr>
                                                    <?php


                                $nbrGroup = 4;
                                $nbrMembre = 3;
                                $n=0;$m=0;
                                for ($i=0;$i<$nbrGroup;$i++) { $n++;?>
                                                    <td>

                                                        <labe title="Groupe 1">Groupe
                                                            <?php echo $n; ?>
                                                        </labe><br>
                                                        <?php for ($j=1;$j<=$nbrMembre;$j++) { $m++; ?>
                                                        <input name="<?php echo " m ".$m ?>" type="text" value="" />
                                                        <?php } ?><br>
                                                        <br>
                                                        <?php
                                    } ?>
                                                        <?php

                                    if (isset($_GET['submit'])) {
                                        for ($membre=1;$membre<=$nbrMembre*$nbrGroup;$membre++) {
                                            echo $_GET['m'.$membre];

                                            //fetch table rows from mysql db
                                            $sql = "select * from etudiant where Email ='".$_GET['m'.$membre]."' ";
                                            $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
                                            $row = mysqli_fetch_array($result);
                                            if ($row <> null) {
                                                $numGrp = (int)($membre / $nbrMembre);
                                                echo ++$numGrp;
                                                $sql = "update etudiant set Equipe_Numero = '".$numGrp."' where Email='".$_GET['m'.$membre]."' ";
                                                mysqli_query($conn, $sql);
                                            }

                                        }


                                    } ?>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <input name="submit" type="submit" value="submit" />
                                                </tr>
                                            </form>

                                        </table>
                                        <?php */ ?>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <!--/.row-->
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
