<?php
require('dbsetup.php');

$startDate = new DateTime($_POST['date']);
$_POST['date']= $startDate->format("Y-m-d");
$endDate = new DateTime(date("m/d/Y"));

if (is_numeric($_POST['equipes_select'])) {

  $idequipe = $_POST['equipes_select'];
  $sql = " select * from etudiant where equipe_numero =".$idequipe." ";
  $sql1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));

/*
$json_file = '../tables/equipes'.$idequipe.'.json';
$json_data = file_get_contents($json_file);
$array = json_decode($json_data,true);*/
$help = true;

while ($etudiant = mysqli_fetch_array($sql1)) {
  $sql = "select matricule from etudiant where username='".$etudiant['Username']."'  ";
  $result_matricule = mysqli_query($conn,$sql);
  $row_matricule = mysqli_fetch_array($result_matricule);
  $matricule = $row_matricule['matricule'];
  $username_haha = str_replace(".","_",$etudiant['Username']);

  if ( ($_POST[$username_haha]>20) || ($_POST[$username_haha]<0) || !is_numeric($_POST[$username_haha]) ) {
    $help = false;break;
  }
}


if ( $help &&  is_numeric($_POST['note_global']) && ($_POST['note_global']<=20)
 && ($_POST['note_global']>0) && ($endDate>=$startDate) && is_numeric($_POST['equipes_select']) ) {

$sql = "insert into seance_encadrement (date,equipe_code,enseignant_matricule)
values('".$_POST['date']."','".$_POST['equipes_select']."','".$_POST['enseignant_matricule']."')   ";
$result = mysqli_query($conn,$sql) or die ("error1".mysqli_error($conn));
$last_id = $conn->insert_id;

$sql = "insert into appriciation_global (note_global,equipe_numero,seance_encadrement_numero)
values('".$_POST['note_global']."','".$_POST['equipes_select']."','".$last_id."')  ";
$result2 = mysqli_query($conn,$sql) or die ("error2".mysqli_error($conn));


$idequipe = $_POST['equipes_select'];
$sql = " select * from etudiant where equipe_numero =".$idequipe." ";
$sql1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));

while ($etudiant = mysqli_fetch_array($sql1)) {
  $sql = "select matricule from etudiant where username='".$etudiant['Username']."'  ";
  $result_matricule = mysqli_query($conn,$sql);
  $row_matricule = mysqli_fetch_array($result_matricule);
  $matricule = $row_matricule['matricule'];

  $username_haha = str_replace(".","_",$etudiant['Username']);
  $sql = " insert into appriciation_indv_assiduite (assiduite,etudiant_matricule,seance_encadrement_numero)
  values ('".$_POST[$username_haha]."','".$matricule."','".$last_id."')  ";
  $result_insert = mysqli_query($conn,$sql) or die ("error insert".mysqli_error($conn));
}

if ($result_insert) {
  ?> <script>
  swal('Success','La nouvelle seance a été ajouté avec succée','success');
modal.style.display = "none";
</script> <?php
} else { ?>
  <script>
      sweetAlert("Oops...", "Une erreure est survenue !", "error");
  </script>
<?php }

if ($result && $result2) {

  ?> <script>
  swal(
  'Success',
  'La nouvelle seance a été ajouté avec succée',
  'success'
);
modal.style.display = "none";
</script> <?php
} else { ?>
  <script>
      sweetAlert("Oops...", "Une erreure est survenue !", "error");
  </script>
<?php } } else {
  ?>
    <script>
        sweetAlert("Oops...", "Vérifie les champs !", "error");
    </script>
  <?php
}
}else {
  ?>
    <script>
        sweetAlert("Oops...", "Selectionnez votre equipe !", "error");
    </script>
  <?php
}
?>
