<!DOCTYPE html>
<script>var equipe_jour = [] ;</script>
<?php
session_start();

if (isset($_SESSION['user_id'])) {
  $type= $_SESSION['type'];


  require('queries/dbsetup.php');
  $username = $_SESSION['user_id'];

  $sql = "select matricule from enseignant where username='".$_SESSION['user_id']."' ";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);
  $matricule = $row['matricule'];

  // les jours de soutenance
  $sql = "select distinct s.jour from soutenance s,salle sa,jury j,enseignant e where e.matricule=".$matricule." and e.matricule=j.enseignant_matricule
  and j.soutenance_code=s.code";
  $result = mysqli_query($conn,$sql);
  while ($row = mysqli_fetch_array($result)) {
    $jours[] = $row['jour'];
  }
  ?>
  <html>
  <head>

    <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
     <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">


     <!-- Theme Styles -->
     <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
     <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jour de soutenance</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/bootstrap-table.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/soutenance.css" rel="stylesheet">
    <link rel="stylesheet" href="bower_components/sweetalert2/dist/sweetalert2.min.css">
    <link href="css/sweetalert.css" rel="stylesheet" type="text/css">


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

          <ul class="user-menu">
            <li class="dropdown pull-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $_SESSION['user_id']; ?><span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="parametre.php"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Paramètres</a></li>
                <li><a href="login.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
      <ul class="nav menu">
        <li class="active"><a href="dossier.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Mon dossier</a></li>
        <li ><a href="reclamation.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Réclamation</a></li>
        <li role="presentation" class="divider"></li>
      </ul>

    </div><!--/.sidebar-->


    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header"> Frequently Asked Questions </h1>
        </div>
      </div><!--/.row-->

      <div class="row">
        <div class="col-lg-12">
          <div class="col s12 m12 l8">
            <div class="card">
              <div class="card-content">
              <ul class="collapsible" data-collapsible="accordion">
                <li>
                  <div class="collapsible-header">1. Proin vehicula luctus libero sit amet pellentesque?</div>
                  <div class="collapsible-body"><p>Curabitur a lectus at risus porttitor facilisis. Duis ac fermentum mi, consequat finibus erat. Proin hendrerit, ex et gravida hendrerit, mauris quam lacinia nunc, et laoreet mi risus quis risus.</p></div>
                </li>
                <li>
                  <div class="collapsible-header">2. Praesent accumsan et nisi gravida suscipit?</div>
                  <div class="collapsible-body"><p>Vestibulum laoreet nisi vel massa rutrum ullamcorper. Phasellus nec turpis lacus. Suspendisse pulvinar ut ligula ut egestas. Quisque posuere viverra enim sagittis pellentesque.</p></div>
                </li>
                <li>
                  <div class="collapsible-header">3. Nulla eget turpis non risus dignissim cursus eget sed dolor?</div>
                  <div class="collapsible-body"><p>Mauris interdum erat ac sapien fringilla, at sollicitudin enim finibus.</p></div>
                </li>
                <li>
                  <div class="collapsible-header">4. Morbi placerat sapien vitae lacus auctor?</div>
                  <div class="collapsible-body"><p>Proin non facilisis lorem, a finibus nulla. Donec sed eleifend nulla, nec dictum enim. Sed tempus non ex id pulvinar. Nam mollis in dolor quis convallis. Donec vulputate leo nibh, ac ultrices ex auctor eu. Praesent sit amet velit at dui tristique tincidunt.</p></div>
                </li>
                <li>
                  <div class="collapsible-header">5. Aenean sit amet metus et magna viverra venenatis ac id lacus?</div>
                  <div class="collapsible-body"><p>Nunc vel risus quis sem posuere tincidunt. Vestibulum dignissim orci ut erat ullamcorper, pharetra dictum lorem rutrum.</p></div>
                </li>
                <li>
                  <div class="collapsible-header">6. Curabitur bibendum et magna id condimentum?</div>
                  <div class="collapsible-body"><p>Maecenas nulla nunc, vehicula non ultricies in, maximus sed urna. Proin nibh enim, consequat vel metus et, auctor varius ex. Vestibulum facilisis leo non tellus commodo, feugiat condimentum urna pretium.</p></div>
                </li>
                <li>
                  <div class="collapsible-header">7. Pellentesque porta dictum purus non molestie?</div>
                  <div class="collapsible-body"><p>Maecenas elementum lacinia neque, id mollis lorem aliquam at. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nulla mi, pharetra eu nulla eu, consectetur convallis turpis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer eleifend sollicitudin enim, eget placerat odio pellentesque ut. Sed vel rhoncus leo, sit amet luctus lorem. Cras vitae dolor mi.</p></div>
                </li>
                <li>
                  <div class="collapsible-header">8. Class aptent taciti sociosqu ad litora torquent per conubia nostra?</div>
                  <div class="collapsible-body"><p>Cras rutrum consectetur velit eget porta. Phasellus non odio id ligula mollis tempor eu et diam.</p></div>
                </li>
                <li>
                  <div class="collapsible-header">9. Quisque bibendum mauris a rhoncus eleifend?</div>
                  <div class="collapsible-body"><p>Sed tincidunt dapibus lorem, eget iaculis massa ultrices a. Sed ornare neque sit amet mauris feugiat iaculis. In velit nisi, egestas id mauris nec, interdum pellentesque sem.</p></div>
                </li>
                <li>
                  <div class="collapsible-header">10. Neque porro quisquam est qui dolorem ipsum quia dolor sit amet?</div>
                  <div class="collapsible-body"><p>Phasellus nec turpis lacus. Suspendisse pulvinar ut ligula ut egestas. Quisque posuere viverra enim sagittis pellentesque.</p></div>
                </li>
                <li>
                  <div class="collapsible-header">11. Nam finibus interdum ipsum non pretium?</div>
                  <div class="collapsible-body"><p>Sed ac nunc sed ligula ultrices suscipit. Curabitur nec pharetra nulla, sit amet aliquet tortor. Proin consequat ultrices euismod. Quisque at nibh euismod, faucibus arcu a, porta orci. Nulla facilisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div>
                </li>
              </ul>
            </div>
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
      <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
      <script src="assets/plugins/materialize/js/materialize.min.js"></script>
      <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
      <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
      <script src="assets/js/alpha.min.js"></script>


      <script src="js/sweetalert.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/soutenance.js"></script>
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
    <?php }    ?>
