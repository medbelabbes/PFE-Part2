<?php

require('dbsetup.php');

$sql= " delete from projet where code=".$_GET['code']." ";
mysqli_query($conn,$sql);


 ?>
 
