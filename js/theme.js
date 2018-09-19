

var $result = $('#eventsResult');
$('#eventsTable')
.on('dbl-click-row.bs.table', function (e, row, $element) {
  $result.text('Event: dbl-click-row.bs.table');
  swal("Resumé du projet",row['Resume']);
});

(function () {
  $('#btnRight').click(function (e) {
    var selectedOpts = $('#lstBox1 option:selected');
    if (selectedOpts.length == 0) {
      alert("Nothing to move.");
      e.preventDefault();
    }
    var lstBox2 = $('#lstBox2 option');
    if ((lstBox2.size() < choix_max) && (selectedOpts.length <= (choix_max - lstBox2.size()))) {
      $('#lstBox2').append($(selectedOpts).clone());
      $(selectedOpts).remove();
      e.preventDefault();
    };
  });

  $('#btnAllRight').click(function (e) {
    var selectedOpts = $('#lstBox1 option');
    if (selectedOpts.length == 0) {
      alert("Nothing to move.");
      e.preventDefault();
    }
    var lstBox2 = $('#lstBox2 option');
    if (lstBox2.size() < choix_max) {
      $('#lstBox2').append($(selectedOpts).clone());
      $(selectedOpts).remove();
      e.preventDefault();
    }
  });

  $('#btnLeft').click(function (e) {
    var selectedOpts = $('#lstBox2 option:selected');
    if (selectedOpts.length == 0) {
      alert("Nothing to move.");
      e.preventDefault();
    }
    var lstBox1 = $('#lstBox1 option');
    $('#lstBox1').append($(selectedOpts).clone());
    $(selectedOpts).remove();
    e.preventDefault();
  });

  $('#btnAllLeft').click(function (e) {
    var selectedOpts = $('#lstBox2 option');
    if (selectedOpts.length == 0) {
      alert("Nothing to move.");
      e.preventDefault();
    }
    var lstBox1 = $('#lstBox1 option');
    $('#lstBox1').append($(selectedOpts).clone());
    $(selectedOpts).remove();
    e.preventDefault();

  });

  $('#btnUp').click(function(e) {
    var selectedOpts = $('#lstBox2 option:selected');
    if (selectedOpts.length == 0) {
      alert("nothing to move");
      e.preventDefault();
    }
    $(selectedOpts).insertBefore($(selectedOpts).prev());
  });

  $('#btnDown').click(function(e) {
    var selectedOpts = $('#lstBox2 option:selected');
    if (selectedOpts.length == 0) {
      alert('nothing to move');
      e.preventDefault();
    }

    $(selectedOpts).insertAfter($(selectedOpts).next());

  });


  $('#btnSubmit').click(function(e) {
    var lstBox2 = $('#lstBox2 option');
    var groupe = document.getElementById('groupe').innerHTML;

    if (lstBox2.size() < choix_min || lstBox2.size() > choix_max ) {
      swal("Vérification!","Le nombre de vos choix doit être entre "+choix_min+" et "+choix_max+"","warning");
    } else {

      var array = [];
      for (var i=0;i<choix_max;i++) {
        array.push(lstBox2[i].innerHTML);
      }

      swal({
        title: "Etes vous sur de confirmer votre fiche de voeux ?",
        text: "Vous ne pouvez pas la modifier !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Confirmer",
        cancelButtonText: "Annuler",
        closeOnConfirm: false,
      },
      function(isConfirm){
        if (isConfirm) {
          help(array,groupe)
          swal("Envoyé!", "Votre fiche de voeux a été bien enregistré.", "success");
        }
      });

    }
  });

}(jQuery));

function arrayForGet(array,groupe) {
  var str = "?a[]=1&a[]=2&a[]=3";
  var str = "?a[]=";
  str += groupe;
  str += "&a[]=" + array[0];

  for (var i=1;i<array.length;i++) {
    str += "&a[]=";
    str += array[i];
  }
  return str;
}

function help(array,groupe){
  document.getElementById('help').setAttribute('value','a');
  showHint(arrayForGet(array,groupe));
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
       
       xmlhttp.open("GET", "queries/addChoices.php" + str, true);
       xmlhttp.send();
   }
}
