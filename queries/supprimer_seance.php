<?php

require('dbsetup.php');
session_start();
$seance_numero = $_GET['numero'];

$sql = " delete from seance_encadrement where numero=".$seance_numero." ";
mysqli_query($conn,$sql);



?>
