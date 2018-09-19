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

var button = document.getElementById('login');

function currentDate(){
  var fullDate = new Date()
  //Thu Otc 15 2014 17:25:38 GMT+1000 {}

  //convert month to 2 digits
  var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) :(fullDate.getMonth()+1);

  var currentDate = twoDigitMonth + "/" + fullDate.getDate() + "/" + fullDate.getFullYear();
  return currentDate;
  //15/10/2014
}

$('#datepicker').change(function(){
  var start = new Date($(this).val());
  var end = new Date(currentDate());
  if (start > end) {
    $(this).attr('style','width: 40%;border-color: red;');

  } else {
    $(this).attr('style','width: 40%;');
  }
});

function checkNote(e){
  var val = $(e).val();
  if ($.isNumeric(val) && stringVerify(e) ) {
    if ( (val>20) || (val<0) ) {
      $(e).attr('style','width: 40%;border-color: red;');
    } else {
      $(e).attr('style','width: 40%;');
    }
  } else {
    $(e).attr('style','width: 40%;border-color: red;');
  }
}

document.getElementById('note_logiciel').setAttribute('onchange','checkNote(this)');
document.getElementById('note_livrable').setAttribute('onchange','checkNote(this)');


function returnIndex(array,str){
  for (var i=0;i<array.length;i++) {
    if (array[i][0] == str) {
      return i;
    }
  }
  return -1;
}
