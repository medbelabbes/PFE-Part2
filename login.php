<!DOCTYPE html>
<html lang="en">
    <head>

<?php
require('queries/dbsetup.php');
session_start();
session_unset();

/*if(isset($_SESSION)){
  switch ($_SESSION['type']) {
    case 'enseignant':
    ?> <script>window.location= 'groupes.php'</script> <?php
      break;
    case 'etudiant':
    ?> <script>window.location= 'groupes.php'</script> <?php
      break;
  }

}*/ ?>
        <!-- Title -->
        <title>Gestions des projets fin d'études</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
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


        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <script>var teacher = "enseignant";</script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>


    <body class="signin-page">
<?php

if (isset($_GET['a'])) {
  setcookie('username',"",time() - 100000);
  setcookie('type',"",time() - 100000);
  session_commit();
}

if (isset($_COOKIE['username']) && !isset($_GET['a'])) {
  switch ($_COOKIE['type']) {
    case 'enseignant':
      $type = 'enseignant';
      break;
    case 'etudiant':
      $type = 'etudiant';
      break;
  }
  $username = $_COOKIE['username'];

  // Check the username and password
  $query = "SELECT username,matricule FROM ".$type." where username = '".$username."' ;";
  $set = mysqli_query($conn,$query);
  $run = mysqli_fetch_array($set) or die("error:".$query) ;
  $id = $run['username'];

  // Save the session
  $_SESSION['type'] = $type;
  $_SESSION['matricule'] = $run['matricule'];
  $_SESSION['user_id'] = $username;

  switch ($type) {
    case 'etudiant':
    $_SESSION['premiere'] = 0;
    $sql = " select premiere from etudiant where matricule=".$_SESSION['matricule']." ";
    $sql = mysqli_query($conn,$sql);
    $sql = mysqli_fetch_array($sql);
    $_SESSION['premiere'] = 0;
    if ($sql['premiere'] == 0) {
      $_SESSION['premiere'] = 0;
      ?>
      <script>
          window.location = "groupes.php";
      </script>
      <?php
      exit;
      break;
    } else {
      $_SESSION['premiere'] = 1;
      ?>
      <script>
          window.location = "parametre.php?a='a'";
      </script>
      <?php
      exit;
      break;
    }

    case 'enseignant':
    $sql = " select premiere from enseignant where matricule=".$_SESSION['matricule']." ";
    $sql = mysqli_query($conn,$sql);
    $sql = mysqli_fetch_array($sql);
    $_SESSION['premiere'] = 0;
    if ($sql['premiere'] == 0) {
      ?>
      <script>
          window.location = "seance.php";
      </script>
      <?php
      exit;
      break;
    } else {
      $_SESSION['premiere'] = 1;
      ?>
      <script>
          window.location = "parametre.php?a='a'";
      </script>
      <?php
      exit;
      break;
    }

  }

} else {



 ?>

<style>
.container2 {
  position: relative;
  width: 50%;
}

.image {
opacity: 1;
display: block;
width: 100%;
height: auto;
transition: .5s ease;
backface-visibility: hidden;
}

.middle {
transition: .5s ease;
opacity: 0;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%)
}

.container2:hover .image {
opacity: 0.3;
}

.container2:hover .middle {
opacity: 1;
}

.text {
background-color: #4CAF50;
color: white;
font-size: 15px;
padding: 10px 10px;
}
</style>

        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mn-content valign-wrapper">
            <main class="mn-inner container ">
                <div class="valign">
                      <div class="row">
                          <div style="width: 40%;" class="col s10 m10 l4 offset-l4 offset-m1">
                              <div class="card white darken-1">
                                  <div class="card-content">
                                      <div class="row">
                                           <form action="query.php" method="post" id="e1" class="col s12">
                                             <?php $teacher = true;
                                             $imageSRC = "assets/images/profile-image.png";
                                              ?>
                                               <center>
                                               <div class="container2">
                                                 <img id="image" src="assets/images/profile-image-2.png" alt="Avatar" class="image" style="width:100%">
                                                 <div class="middle">
                                                   <div id="text" class="text">Enseignant</div>
                                                 </div>
                                               </div>
                                               </center>
                                               <div class="input-field col s12">
                                                   <input name="username" id="email" type="text">
                                                   <label for="email">Username</label>
                                                   <input id="type" name="type" value="enseignant" style="display: none;"></input>
                                               </div>
                                               <div class="input-field col s12">
                                                   <input name="password" id="password" type="password">
                                                   <label for="password">Password</label>
                                                 </div>
                                                 <input style="margin-left: 20px;" name="remember" type="checkbox" class="filled-in" id="filled-in-box-example" checked="checked" />
                                                 <label style="margin-left: 20px;padding-right: 5%;" for="filled-in-box-example">Remember me</label>
                                                 <a id="login" class="waves-effect waves-light btn teal">SIGN IN</a>
                                                   <p id="result"></p>
                                           </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </main>
        </div>


        <!-- Javascripts -->

        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="js/login.js"></script>
        <script src="js/sweetalert.min.js"></script>

        <script>


        var text = document.getElementById("text");
        var type = document.getElementById("type");
        text.addEventListener("click", changeimg_bw);
        function changeimg_bw(e) {
          var image = document.getElementById("image");
          if (teacher == "etudiant") {
            image.setAttribute("src","assets/images/profile-image-2.png");
            text.innerHTML = "Enseignant";
            teacher = "enseignant";
          } else {
            image.setAttribute("src","assets/images/profile-image.png");
            text.innerHTML = "Etudiant";
            teacher = "etudiant";
          }
          type.setAttribute("value",teacher);


        }
</script>
<?php } ?>
    </body>
</html>
