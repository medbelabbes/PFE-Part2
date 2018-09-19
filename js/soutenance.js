$('.insertnote').submit(function(){
  return false;
});


function noter(e){
  var str = $(e).attr('id');
  str = "numero=\'" + str + "\'";
  swal({
    title: "Etes vous sur de donner votre note ?",
    text: "Vous ne pouvez pas la modifier au futur !",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Oui, je veux donner ma note!",
    cancelButtonText: "Annuler",
    closeOnConfirm: false,
  },
  function(isConfirm){
    if (isConfirm) {
      showHint(str);
      swal("Envoyé!", "Votre note a été bien sauvgarder.", "success");
    }
  });
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



function checkNote(e){
  var val = $(e).val();
  if ($.isNumeric(val)) {
    if ( (val>20) || (val<0) ) {
      $(e).attr('style','width: 40%;border-color: red;');
    } else {
      $(e).attr('style','width: 40%;');
    }
  } else {
    $(e).attr('style','width: 40%;border-color: red;');
  }
}
