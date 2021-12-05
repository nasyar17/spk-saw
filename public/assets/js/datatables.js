'use strict';

$('#crud1').dataTable({
   dom: 'lfrtip'
});
$('#obat').dataTable({
   dom: 'lfrtip'
});
$('#supplier').dataTable({
   dom: 'lfrtip',
});
$('#history').dataTable({
   dom: 'lfrtip'
});
$('#matriks').dataTable({
   dom: 'lfrtip'
});
$('#normalisasi').dataTable({
   dom: 'lfrtip'
});
$('#rekap').dataTable({
   dom: 'lfrtip',
   "order": [
      [6, "desc"]
   ]
});

// page variabel
$('#K01').dataTable({
   dom: 'frtip',
   "columnDefs": [{
      "sortable": false,
      "targets": 4
   }]
});
$('#K02').dataTable({
   dom: 'frtip',
   "columnDefs": [{
      "sortable": false,
      "targets": 4
   }, ]
});
$('#K03').dataTable({
   dom: 'frtip',
   "columnDefs": [{
      "sortable": false,
      "targets": 4
   }, ]
});
$('#K04').dataTable({
   dom: 'frtip',
   "columnDefs": [{
      "sortable": false,
      "targets": 4
   }, ]
});