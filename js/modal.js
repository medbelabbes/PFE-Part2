// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
/* btn.onclick = function() {
    /*modal.style.display = "block";
    document.getElementById('sidebar-collapse').style.opacity= "50%";*/
  /*  swal({
    title: 'Multiple inputs',
    html:
      '<input id="swal-input1" class="swal2-input">' +
      '<input id="swal-input2" class="swal2-input">',
    preConfirm: function () {
      return new Promise(function (resolve) {
        resolve([
          $('#swal-input1').val(),
          $('#swal-input2').val()
        ])
      })
    },
    onOpen: function () {
      $('#swal-input1').focus()
    }
  }).then(function (result) {
    swal(JSON.stringify(result))
  }).catch(swal.noop)
}*/

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

  // Get the modal
  var modal2 = document.getElementById('myModal2');

  // Get the button that opens the modal
  var btn2 = document.getElementById("modifier");

  // Get the <span> element that closes the modal
  var span2 = document.getElementsByClassName("close2")[0];


  // When the user clicks on <span> (x), close the modal
  span2.onclick = function() {
    modal2.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window2.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
  }
