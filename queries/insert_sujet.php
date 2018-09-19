<?php
session_start();

require('dbsetup.php');

$titre=$_POST['titre'];
$technologie=$_POST['technologie'];
$outil=$_POST['outil'];
$specialite=$_POST['specialite'];
$prerequise=$_POST['prerequis'];
$resume=$_POST['resume'];
$promotion=$_POST['promotion'];
$designation=$_POST['designation'];
$month = date("m");
$year = date("Y");
$duree = $_POST['duree'];
$nbr_equipe = $_POST['nbr_equipe'];
$plan_travail = $_POST['plan_travail'];

if ($month>= 1 && $month<7) {
  $year = ($year-1)."/".($year);
} else {
  $year = ($year)."/".($year+1);
}

$sqlAnnee = " select code from annee where year='".$year."' ";
$result = mysqli_query($conn,$sqlAnnee);
$annee_code = mysqli_fetch_array($result);
$annee_code = $annee_code['code'];

$sqlPromotions = " select id from promotion where niveau = '".$promotion."' and annee_code=".$annee_code." ";
$result = mysqli_query($conn,$sqlPromotions) or die(mysqli_error($conn));
$promotion_numero = mysqli_fetch_array($result);
$promotion_numero = $promotion_numero['id'];


$titreB=false;$technologieB=false;$outilB=false;$specialiteB=false;$prerequisB=false;$resumeB=false;
$designationB=false;$plan_travailB=false;$dureeB=false;$nbr_equipeB=false;
if (strpos($_POST['titre'],'\'') !== false) {
  $titreB = true;
}
if (strpos($_POST['technologie'],'\'') !== false) {
  $technologieB = true;
}
if (strpos($_POST['outil'],'\'') !== false) {
  $outilB = true;
}
if (strpos($_POST['specialite'],'\'') !== false) {
  $specialiteB = true;
}
if (strpos($_POST['prerequis'],'\'') !== false) {
  $prerequisB = true;
}
if (strpos($_POST['resume'],'\'') !== false) {
  $resumeB = true;
}

if (strpos($_POST['plan_travail'],'\'') !== false) {
  $plan_travailB = true;
}
if (strpos($_POST['duree'],'\'') !== false) {
  $dureeB = true;
}
if (strpos($_POST['nbr_equipe'],'\'') !== false) {
  $nbr_equipeB = true;
}


if (!$titreB && !$designationB && !$technologieB && !$outilB && !$specialiteB && !$prerequisB && !$resumeB && !$plan_travailB && !$dureeB && !$nbr_equipeB
&& !empty($titre) && !empty($technologie) && !empty($outil) && !empty($specialite) && !empty($prerequise) && !empty($resume)
&& !empty($designation) && !empty($plan_travail) && !empty($duree) &&!empty($nbr_equipe)) {

  $sqlProjet = " insert into projet (designation,technologie,outil,specialite,prerequis,resume,promotion_code,validation,duree,plan_travail,nombre_equipe) values
  ('".$titre."','".$technologie."','".$outil."','".$specialite."','".$prerequise."','".$resume."',".$promotion_numero.",0,$duree,$plan_travail,$nbr_equipe)  ";
  mysqli_query($conn,$sqlProjet) or die ("error in projet".mysqli_error($conn)."  ".$sqlProjet);
  $enseignant_matricule = $_SESSION['matricule'];
  $projet_code = $conn->insert_id;
  $sqlProposer = " insert into proposer values(".$enseignant_matricule.",".$projet_code.") ";
  mysqli_query($conn,$sqlProposer) or die ("error in proposer".mysqli_error($conn));

  ?>
    <script>
        sweetAlert("Success", "Le sujet a été ajouté", "success");
    </script>
  <?php
} else {
  ?>
    <script>
        sweetAlert("Oops...", "Vérifie les champs !", "error");
    </script>
  <?php
}



 ?>
