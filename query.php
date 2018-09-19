<?php
require('queries/dbsetup.php');
session_start();
session_unset();

$username = $_POST['username'];
$password = md5($_POST['password']);
$type = "";
if (empty($username) || empty($password)) { ?>
    <script>
        sweetAlert("Oops...", "Veuillez remplir tous les champs !", "error");
    </script>
<?php
} else {
switch ($_POST['type']) {
case 'etudiant' : $type = 'etudiant';break;
case 'enseignant' :$type = 'enseignant';break;
default: $type = "nothing";
}

// Check the username and password
$query = "SELECT username,matricule,etat FROM ".$type." where username = '".$username."' AND password ='".$password."' ;";
$set = mysqli_query($conn,$query);
$run = mysqli_fetch_array($set) ;
$id = $run['username'];





if (!empty($id))  {



switch ($type) {
  case 'etudiant':
  $sql = " select premiere,etat from etudiant where matricule=".$run['matricule']." ";
  $sql = mysqli_query($conn,$sql);
  $sql = mysqli_fetch_array($sql);
  $etat = $sql['etat'];
  if ($etat == "autorise") {
    // Save the session
    $_SESSION['user_id'] = $username;
    $_SESSION['type'] = $type;
    $_SESSION['matricule'] = $run['matricule'];
    // Save the cookie
    if (isset($_POST['remember'])) {
      setcookie('username',$username,time()+ 10000);
      setcookie('type',$type,time()+10000);
    }

    if ($sql['premiere'] == 0) {
      ?>
      <script>
          window.location = "groupes.php";
      </script>
      <?php
      exit;
      break;
    } else {
      $_SESSION['premiere'] = 1;
      ?>
      <script>
          window.location = "parametre.php?a='a'";
      </script>
      <?php
      exit;
      break;
    }
  } else {
    ?>
    <script>
        window.location = "403.html";
    </script>
    <?php
    exit;
    break;
  }


  case 'enseignant':
  $sql = " select premiere,etat from enseignant where matricule=".$run['matricule']." ";
  $sql = mysqli_query($conn,$sql);
  $sql = mysqli_fetch_array($sql);
  $etat = $sql['etat'];


  if ($etat == "autorise") {
    // Save the session
    $_SESSION['user_id'] = $username;
    $_SESSION['type'] = $type;
    $_SESSION['matricule'] = $run['matricule'];
    // Save the cookie
    if (isset($_POST['remember'])) {
      setcookie('username',$username,time()+ 10000);
      setcookie('type',$type,time()+10000);
    }


    if ($sql['premiere'] == 0) {
      $_SESSION['premiere'] = 0;
      ?>
      <script>
          window.location = "seance.php";
      </script>
      <?php
      exit;
      break;
    } else {
      $_SESSION['premiere'] = 1;
      ?>
      <script>
          window.location = "parametre.php?a='a'";
      </script>
      <?php
      exit;
      break;
    }
  } else {
    ?>
    <script>
      window.location = "403.html";
    </script>
    <?php
    exit;
    break;
  }


}
} else {  ?>
   <script>
       sweetAlert("Oops...", "Le nom d'utilisateur et le mot de passe ne sont pas identique !", "error");
   </script>
   <?php
}}

?>
