$('#e1').submit(function(){
  return false;
});

$('#ajouter').click(function(){
  $.post(
  $('#e1').attr('action'),
  $('#e1 :input').serializeArray(),
  function(result){
    $('#result').html(result);
  }
);
});
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
  document.getElementById('sidebar-collapse').style.opacity= "50%";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function getMembres(e) {
  var equipe = e.value;
  $('#membre').children().attr('style','width: 40%; display: none;');
  $('.e'+equipe).attr('style','width: 40%; display: block; margin-bottom: 20px;');
}

function stringVerify(str) {
  if (str.includes('\'')) {
    return false;
  }
  return true;
}

function currentDate(){
  var fullDate = new Date()
  //Thu Otc 15 2014 17:25:38 GMT+1000 {}

  //convert month to 2 digits
  var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) :(fullDate.getMonth()+1);

  var currentDate = twoDigitMonth + "/" + fullDate.getDate() + "/" + fullDate.getFullYear();
  return currentDate;
  //15/10/2014
}

$('.datepicker').change(function(){
  var start = new Date($(this).val());
  var end = new Date(currentDate());
  if (start > end) {
    $(this).attr('style','width: 40%;border-color: red;margin-bottom: 20px;');

  } else {
    $(this).attr('style','width: 40%;margin-bottom: 20px;');
  }
});


function checkString(e){
  var val = $(e).val();
  if (!stringVerify(val)) {
    $(e).attr('style','width: 40%;border-color: red;margin-bottom: 20px;');
  } else {
    $(e).attr('style','width: 40%;margin-bottom: 20px;');
  }
  checkNote(e);
}


function checkNote(e){
  var val = $(e).val();
  if ($.isNumeric(val)) {
    if ( (val>20) || (val<0) ) {
      $(e).attr('style','width: 40%;border-color: red;margin-bottom: 20px;');
    } else {
      $(e).attr('style','width: 40%;margin-bottom: 20px;');
    }
  } else {
    $(e).attr('style','width: 40%;border-color: red;margin-bottom: 20px;');
  }
}


function valider (e) {
  $('#e'+$(e).attr('id')).submit(function(){
    return false;
  });

  $.post(
  $('#e'+$(e).attr('id')).attr('action'),
  $('#e'+$(e).attr('id')+' :input').serializeArray(),
  function(result){
    $('#result').html(result);
  });
}

function supprimer(e) {
  var str = $(e).attr('id');
  str = "numero=\'" + str + "\'";

  swal({
    title: "Etes vous sur de supprimer cette seance ?",
    text: "Vous ne pouvez pas la récuperer !",
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
      swal("Envoyé!", "La seance a été bien supprimé.", "success");
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


function help(str){
  document.getElementById('help').setAttribute('value','a');
  showHint(str);
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

       xmlhttp.open("GET", "queries/supprimer_seance.php?"+str, true);
       xmlhttp.send();
   }
}
