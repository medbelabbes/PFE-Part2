<?php
$note = $_POST['note'];
$equipe = $_POST['equipe'];


require('dbsetup.php');
?>
<form action="insertNote.php" method="post" id="insertnote">
  <p id="result"></p>
</form>

<script>

var equipe = "<?php echo $equipe; ?>";

$('#insertnote').submit(function(){
  return false;
);
swal({
  title: "Etes vous sur de donner votre note ?",
  text: "Vous ne pouvez pas la modifier au futur !",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Oui, je veux donner ma note!",
  closeOnConfirm: false,
  closeOnCancel: false,
},
function(isConfirm){
  if (isConfirm) {
    showHint(equipe));
    swal("Envoyé!", "Votre note a été bien sauvgarder.", "success");

  } else {
    swal("Cancelled", "Your imaginary file is safe :)", "error");
  }
});
    }

function showHint(str) {
  alert("hh");
   if (str.length == 0) {

       return;
   } else {
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {

           }
       };
       xmlhttp.open("GET", "queries/note.php?a="+str, true);
       xmlhttp.send();
   }
}

</script>
