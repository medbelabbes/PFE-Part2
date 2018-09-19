var $result = $('#eventsResult');
$('#eventsTable')
.on('dbl-click-row.bs.table', function (e, row, $element) {
  $result.text('Event: dbl-click-row.bs.table');
  if (row['Validation'] == 0) {

    supprimer(row['Code']);
  } else {
    swal('Information','Vous ne pouvez pas supprimé un projet validé, veuillez consulter l\'administarton','warning');
  }

});


function supprimer(e) {
  var str = "code=\'" + e + "\'";
  swal({
    title: "Etes vous sur de supprimer ce projet ?",
    text: "Vous ne pouvez pas le récuperer !",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Confirmer",
    cancelButtonText: "Annuler",
    closeOnConfirm: false,
  },
  function(isConfirm){
    if (isConfirm) {
      showHint(str);
      swal("Supprimé!", "Le projet a été bien supprimé.", "success");
    }
  });
}

// When the user clicks on the button, open the modal
function modifier(a) {

  // Get the modal
  var modal2 = document.getElementById("modal"+$(a).attr('id'));

  // Get the <span> element that closes the modal
  var span2 = document.getElementsByClassName("close"+$(a).attr('id'))[0];

  modal2.style.display = "block";
  document.getElementById('sidebar-collapse').style.opacity= "50%";

  // When the user clicks on <span> (x), close the modal
  span2.onclick = function() {
    modal2.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal2) {
      modal2.style.display = "none";
    }
  }
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
       xmlhttp.open("GET", "queries/supprimer_sujet.php?"+str, true);
       xmlhttp.send();
   }
}


$('#e1').submit(function(){
  return false;
});

$('#login').click(function(){
  $.post(
  $('#e1').attr('action'),
  $('#e1 :input').serializeArray(),
  function(result){
    $('#result').html(result);
  }
);
});

function stringVerify(str) {
  if (str.includes('\'')) {
    return false;
  }
  return true;
}

function checkString(e){
  if ($(e).attr('name') == 'duree') {
    dureee(e);
  } else {
  var val = $(e).val();
  if (!stringVerify(val)) {
    $(e).attr('style','width: 40%;border-color: red;');
  } else {
    $(e).attr('style','width: 40%;');
  }
}}

function dureee(e) {
  var str = $(e).val();
  if (!$.isNumeric(str)) {
    $(e).attr('style','width: 40%;border-color: red;');
  } else if (str>=0) {
    $(e).attr('style','width: 40%;');
  } else {
    $(e).attr('style','width: 40%;border-color: red;');
  }
}


$('#e1 input').blur(function(){
  $(this).attr('onchange','checkString(this)');
});


$('#textarea').attr('onchange','checkString(this)');
