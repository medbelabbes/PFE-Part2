<?php
require('dbsetup.php');

$code = $_POST['code'];
$titre = $_POST['titre'];
$specialite = $_POST['specialite'];
$technologie = $_POST['technologie'];
$outil = $_POST['outil'];


 if(!empty($code)){

?> <script> swal("Terminé !", "La seance a été ajouté.", "success"); </script><?php
 } else {
?> <script> sweetAlert("Oops...", "Une erreure est survenue !", "error"); </script><?php
 }
?>
