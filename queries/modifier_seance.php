<?php

require('dbsetup.php');
$seance_numero = $_POST['numero_seance'];
$date = $_POST['date'];
$idEquipe  = $_POST['idEquipe'];
$note_global = $_POST['note_global'];
?><script>console.log("<?php echo "dd" .$startDate = new DateTime($date);?>")</script><?php
$endDate = new DateTime(date("m/d/Y"));
$help = true;


$sql_etudiant = "select username from etudiant where equipe_numero = ".$idEquipe." ";

$etudiants = null;
$result_etudiant = mysqli_query($conn,$sql_etudiant) or die ("error insert".mysqli_error($conn));
while ($row_etudiant = mysqli_fetch_array($result_etudiant)) {
  $etudiants[] = $row_etudiant['username'];
}

for ($i=0;$i<sizeof($etudiants);$i++) {
  $etudiant = str_replace('.','_',$etudiants[$i]);
  if (is_numeric($_POST[$etudiant]) && ($_POST[$etudiant]>=0) && ($_POST[$etudiant]<=20) ) {
    //
  } else {
    $help = false;break;
  }
}

if ($help && ($endDate>=$startDate) &&  ($note_global>=0) && ($note_global<=20)
&& is_numeric($note_global) ) {

for ($i=0;$i<sizeof($etudiants);$i++) {
  $etudiant = str_replace('.','_',$etudiants[$i]);
  $sql = " select matricule from etudiant where username='".$etudiants[$i]."' ";
  $result = mysqli_query($conn,$sql);
  $sql_etudiant_matricule = mysqli_fetch_array($result);
  $sql_etudiant_matricule = $sql_etudiant_matricule['matricule'];

  $sqlDate = " update seance_encadrement set date='".$date."' where numero=".$seance_numero." ";
  $sqlDate;
  mysqli_query($conn,$sqlDate);
  $sqlNote = " update appriciation_indv_assiduite set assiduite=".$_POST[$etudiant]."  where etudiant_matricule=".$sql_etudiant_matricule." and seance_encadrement_numero=".$seance_numero." ";
  mysqli_query($conn,$sqlNote);
  $sql = " update appriciation_global set note_global=".$note_global." where seance_encadrement_numero=".$seance_numero." ";
  mysqli_query($conn,$sql);
  ?> <script>
  swal('Success','La modification a été faite !','success');
  modal.style.display = "none";
  </script> <?php
}

} else {
  ?> <script>
  swal('Oops ','Vérifie les champs','error');
  modal.style.display = "none";
  </script> <?php
}
 ?>
