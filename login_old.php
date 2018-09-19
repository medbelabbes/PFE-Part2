<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Projet fin d'etudes</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/datepicker3.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">
  <link href="css/sweetalert.css" rel="stylesheet" type="text/css">
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

</head>

<body>
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">Connexion au compte PFE</div>
        <div class="panel-body">
          <form action="query.php" method="post" id="e1" class="e1">
              <h4>Nouvelle seance</h4>
              <select name="type" class="form-control">
                <option value="etudiant">Etudiant</option>
                <option value="enseignant">Enseignant</option>
              </select>
              <input name="username" placeholder="username" type="text" class="form-control">
              <input name="password" placeholder="password" type="password" class="form-control">
              <button id="login" class="btn btn-primary" >Login</button>
              <p id="result"></p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src='https://code.jquery.com/jquery-3.1.0.min.js'></script>
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/login.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/chart.min.js"></script>
  <script src="js/chart-data.js"></script>
  <script src="js/easypiechart.js"></script>
  <script src="js/easypiechart-data.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/sweetalert.min.js"></script>
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
