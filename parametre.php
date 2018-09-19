
  <!DOCTYPE html>
  <?php
       session_start();
?><script>sweetAlert("Modifié...", "Le mot de passe a été changé, veuillez reconectez vous.", "success");</script><?php
$username=$_SESSION['user_id'];
$type=$_SESSION['type'];
  ?>
      <html>

      <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Gestions des projets fin d'études</title>

          <!-- Styles -->
          <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
          <link href="css/sweetalert.css" rel="stylesheet" type="text/css">

          <link href="css/bootstrap.min.css" rel="stylesheet">
          <link href="css/datepicker3.css" rel="stylesheet">
          <link href="css/styles.css" rel="stylesheet">
          <link href="css/sweetalert.css" rel="stylesheet" type="text/css">
          <link href="css/bootstrap-table.css" rel="stylesheet">

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
              <a href="<?php if ($type =="etudiant") { echo "groupes.php";} else {echo "seance.php";}?>" class="navbar-brand">Gestion des projets <span>fin d'études</span></a>
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

          <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


              <div class="row">
                <div class="col-lg-12">
                  <h1 class="page-header"> Paramètres</h1>
                </div>
              </div><!--/.row-->


              <div class="col-md-8">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="panel panel-default">
                              <div class="panel-heading">Modifier le mot de passe</div>
                              <div class="panel-body">
                                          <form method="post" >
                                              <?php
                                              if (isset($_GET['a'])) {?>
                                                <div class="alert bg-warning" role="alert">
                                                   <svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg> C'est votre première utilisation de se site, vous devez changer votre mot de passe. <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                                </div>
                                                <?php }
                                                if (isset($_POST['submit'])) {
                                                  require('queries/dbsetup.php');
                                                  // Listening to the submit button
                                                  $old = md5($_POST['old']);
                                                  $password = md5($_POST['password']);
                                                  $username = $_POST['username'];
                                                  $confirme = md5($_POST['confirmer']);
                                                  $type = $_POST['type'];

                                                  if ( empty($old) || empty($password)|| empty($confirme) ) {
                                                          // Certaines case sont vides !
                                                          ?>  <div class="alert bg-warning" role="alert">
                                                              <svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Certaines case sont vides !<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                                          </div>
                                                          <?php
                                                  } else if ($password <> $confirme) {
                                                    // Modification du mot de passe
                                                    ?>  <div class="alert bg-warning" role="alert">
                                                        <svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Les deux mot de passe ne sont pas identiques !<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                                    </div>
                                                    <?php
                                                  } else {
                                                      $sql = " select password from ".$type." where username='".$username."' ";
                                                      $result = mysqli_query($conn,$sql);
                                                      $result = mysqli_fetch_array($result);
                                                      $result=$result['password'];
                                                      if ($result == $old) {
                                                        // Changement du mot de passe
                                                        $change_pass = mysqli_query($conn,"update ".$type." set password='".$password."' where username = '".$username."'  ") or die('error pass:'.mysqli_error($conn));
                                                        $change_premiere = mysqli_query($conn," update ".$type." set premiere=0 where username='".$username."'  ") or die('error premier:'.mysqli_error($conn));
                                                        ?><script> </script>
                                                              <script>window.location = "login.php";</script><?php
                                                      } else {
                                                        ?>  <div class="alert bg-warning" role="alert">
                                                            <svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>L'ancien message est différent !<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                                        </div>
                                                        <?php
                                                      }
                                                  }
                                                }
                                                 ?>
                                              <div class="form-group">
                                                  <label>Ancien mot de passe:</label>
                                                  <input name="old" type="password" class="form-control" >
                                              </div>
                                              <input style="display: none;" name="username" value="<?php echo $username ?>">
                                              <input style="display: none;" name="type" value="<?php echo $type ?>">
                                              <div class="form-group">
                                                  <label>Nouveau mot de passe:</label>
                                                  <input name="password" type="password" class="form-control" >
                                              </div>
                                              <div class="form-group">
                                                  <label>Confirmer:</label>
                                                  <input name="confirmer" type="password" class="form-control" >
                                              </div>
                                          <button name="submit" class="btn btn-primary">Confirmer</button>
                                          </form>
                                  </div>
                              </div>
                </div>
              </div>
              </div>

          </div>
          <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
          <script src="assets/plugins/materialize/js/materialize.min.js"></script>
          <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
          <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
          <script src="assets/js/alpha.min.js"></script>
          <script src="js/sweetalert.min.js"></script>

          <script>
              $('#calendar').datepicker({});

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
