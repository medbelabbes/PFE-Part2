var $result = $('#eventsResult');
$('#eventsTable')
.on('dbl-click-row.bs.table', function (e, row, $element) {
  $result.text('Event: dbl-click-row.bs.table');
  swal("Resumé du projet",row['Resume']);
});
