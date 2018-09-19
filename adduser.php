<!DOCTYPE html>
<?php
session_start();

if (isset($_SESSION['user_id'])) {

        $type= $_SESSION['type'];
    
    if ($type <> "clients") {
?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ajouter un nouveau utilisateur</title>

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
                    <a class="navbar-brand" <?php switch ($type) { case "Admin":?>href="index.php"<?php
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php echo $_SESSION['user_id']; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="settings.php"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Paramètres</a></li>
                                <li><a href="login.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- /.container-fluid -->
        </nav>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <ul class="nav menu">
                <?php if ($type === "Admin"){ ?>
                <li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Acceuil</a></li>
                <li><a href="reclamations.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Reclamations</a></li>
                <li class="parent ">
                    <a href="#">
                        <span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>Employeurs
                    </a>
                    <ul class="children collapse" id="sub-item-2">
                        <li>
                            <a class="" href="employeurs.php">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Afficher employeurs
                            </a>
                        </li>
                        <li>
                            <a class="" href="addemploye.php">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Ajouter employeurs
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <li class="parent ">
                    <a href="#">
                        <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>Utilisateurs
                    </a>
                    <ul class="children collapse" id="sub-item-1">
                        <li>
                            <a class="" href="users.php">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Afficher utilisateurs
                            </a>
                        </li>
                        <li class="active">
                            <a class="" href="adduser.php">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Ajouter utilisateur
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="parent ">
                    <a href="#">
                        <span data-toggle="collapse" href="#sub-item-3"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span>Dossier
                    </a>
                    <ul class="children collapse" id="sub-item-3">
                        <?php 
                    if ($type === "clients") { ?>
                        <li>
                            <a class="" href="dossier.php">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Mon dossier
                            </a>
                        </li>
                        <?php } ?>
                        <li>
                            <a class="" href="dossiers.php">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Affiches dossiers
                            </a>
                        </li>
                        <li>
                            <a class="" href="adddossier.php">
                                <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>Ajouter Dossier
                            </a>
                        </li>
                    </ul>
                </li>

                <li role="presentation" class="divider"></li>
            </ul>
        </div>
        <!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gestions des utilisateurs</h1>
                </div>
            </div>
            <!--/.row-->

            <?php
        $conn = mysqli_connect("localhost","root","","cnr");        
        //fetch table rows from mysql db
        $sql = "select * from clients";
        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
        
        //create an array
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray[] = $row;
        }        
    
        $json_data = json_encode($emparray);
        file_put_contents('tables/users.json', $json_data);
        
        ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Ajouter un utilisateur</div>
                            <div class="panel-body">
                                <form method="post">


                                    <?php

                                if (isset($_POST['submit'])) {
                                    // Listening to the submit button
                                    $username = $_POST['username'];
                                    $password = sha1($_POST['password']);
                                    $num_serie = $_POST['num_serie'];

                                    if ( empty($username) || empty($password)|| empty($num_serie) ) { 
                                            // if one of the fields is empty 
                                        ?>
                                        <div class="alert bg-warning" role="alert">
                                            <svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg>Certaines case sont vides !<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                        </div>
                                        <?php
                                    } else {
                                                                                                                        
                                        // Insertion finale du nouveau client
                                        
                                        $conn = mysqli_connect("localhost","root","","cnr");                                    
                                        $query = mysqli_query($conn,"INSERT into clients (username,password,iddossier)
                                        values('".$username."','".$password."','".$num_serie."') ");
                                        $query = mysqli_query($conn,"insert into reclamation (message,idclients,type) values ('','".$username."','reclamation1') ");
                                        if ($query) {                                            
                             				?>
                                            <div class="alert bg-success " role="alert">
                                                <svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg>L'utilisateur a été bien ajouté.<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                                <div class="alert bg-danger " role="alert">
                                                    <svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>Soit le nom d'utilisateur exist deja soit le dossier n'exist pas.<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                                </div>
                                                <?php
                                            
                                        }                                    
                                    }                    
                                 }
                                 if (isset($_POST['reset'])) {
                                     $_POST['password'] = "";
                                     $_POST['username'] = "";
                                     $_POST['num_serie'] = "";
                                                                  
                                 }
                                 ?>

                                                    <div class="form-group">
                                                        <label>Username:</label>
                                                        <input name="username" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Numéro de série de dossier:</label>
                                                        <input name="num_serie" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Password:</label>
                                                        <input name="password" type="password" class="form-control">
                                                    </div>

                                                    <button name="submit" type="submit" class="btn btn-primary">Ajouter</button>
                                                    <button name="reset" type="reset" class="btn btn-default">Réinitialiser</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.row-->
        </div>
        <!--/.main-->

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
    <?php }} ?>
