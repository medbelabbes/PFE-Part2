
<?php
require('dbsetup.php');

$choices = $_GET['a'];
$equipe = $choices[0];


if (sizeof($choices) > 2) {
  for ($i=1 ; $i<sizeof($choices) ; $i++) {
    $sqlDesignation = " select designation from projet where code =".$choices[$i]." ";
    $sqlDesignation = mysqli_query($conn,$sqlDesignation);
    $sqlDesignation = mysqli_fetch_array($sqlDesignation);
    $sqlDesignation = $sqlDesignation['designation'];
    mysqli_query($conn,"insert into choisir values('".$equipe."','".$choices[$i]."','".$sqlDesignation."','".$i."')") or die('error'.mysqli_error($conn));
  }
} else {
  $sqlDesignation = " select designation from projet where code =".$choices[1]." ";
  $sqlDesignation = mysqli_query($conn,$sqlDesignation);
  $sqlDesignation = mysqli_fetch_array($sqlDesignation);
  $sqlDesignation = $sqlDesignation['designation'];
  mysqli_query($conn,"insert into choisir values('".$equipe."','".$choices[1]."','".$sqlDesignation."','1')");
}
?>
