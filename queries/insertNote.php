<?php

require('dbsetup.php');
session_start();
$note_logiciel = $_GET['note_logiciel'];
$note_livrable = $_GET['note_livrable'];
$note_presentation = $_GET['note_presentation'];
$equipe_code = $_GET['numero'];
$enseignant_matricule = $_SESSION['matricule'];
$note = str_replace('\'','',$note);
echo $note;

if ( $note>=0 && $note<=20) {
  $sql = " insert into note (note_livrable,note_logiciel,note_presentation,equipe_numero,Enseignant_Matricule)
  values (".$note_livrable.",".$note_logiciel.",".$note_presentation.",".$equipe_code.",'".$enseignant_matricule."') ";  
  mysqli_query($conn,$sql);

} else { ?>
  <script>

  </script>
<?php }




?>
