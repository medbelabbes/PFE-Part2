<?php
// remove all session variables
session_unset();
session_start();

$username = $_POST['username'];
$password = md5($_POST['password']);
$type = "";
if (empty($username) || empty($password)) { ?>
    <script>
        sweetAlert("Oops...", "Veuillez remplir tous les champs !", "error");
    </script>
    <?php
} else {
echo $type;
switch ($_POST['type']) {
case 'etudiant' : $type = 'etudiant';break;
case 'enseignant' :$type = 'enseignant';break;
}

// Check the username and password
$query = "SELECT * FROM ".$type." where username = '".$username."' AND password ='".$password."' ;";
$set = mysqli_query($conn,$query);
$run = mysqli_fetch_array($set);
$id = $run['username'];
$matricule = $run['matricule'];

// Save the type
$_SESSION['type'] = $type;

if (!empty($id)) {
$_SESSION['user_id'] = $username;
$_SESSION['matricule'] = 'matricule';

switch ($type) {
case 'etudiant':
header('location: ../groupes.php',true);exit;break;
    case 'enseignant':
header('location: ../seance.php',true);exit;break;

}

} else { ?>
  <script>
      sweetAlert("Oops...", "Le nom d'utilisateur et le mot de passe ne sont pas identique !", "error");
  </script>
    <?php
}
}

?>
