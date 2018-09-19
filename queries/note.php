<script>
var note_livrable = "<?php echo $_POST['note_livrable']; ?>" ;
var note_logiciel = "<?php echo $_POST['note_logiciel']; ?>" ;
var note_presentation = "<?php echo $_POST['note_presentation']; ?>" ;
var equipe = "<?php echo $_POST['equipe'];?>" ;

if ($.isNumeric(note_livrable) && $.isNumeric(note_logiciel) && $.isNumeric(note_presentation)
&& note_livrable>=0 && note_livrable<=20 && note_logiciel>=0 && note_logiciel<=20 && note_presentation>=0 && note_presentation<=20) {
  str = "numero=\'"+equipe+"\'&note_livrable=\'"+note_livrable+"\'&note_logiciel=\'"+note_logiciel+"\'&note_presentation=\'"+note_presentation+"\'" ;
  swal({
    title: "Etes vous sur de donner votre note ?",
    text: "Vous ne pouvez pas la modifier au futur !",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Oui, je veux donner ma note!",
    closeOnConfirm: false,
  },
  function(isConfirm){
    if (isConfirm) {
      showHint(str);
      swal("Envoyé!", "Votre note a été bien sauvgarder.", "success");
    }
  });
} else {
  swal("Oops!", "La note doit étre entre 0 et 20.", "error");
}



function showHint(str) {
   if (str.length == 0) {
       document.getElementById("txtHint").innerHTML = "";
       return;
   } else {
       var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               document.getElementById("txtHint").innerHTML = this.responseText;
           }
       };
       xmlhttp.open("GET", "queries/insertNote.php?"+str, true);
       xmlhttp.send();
   }
}

</script>
