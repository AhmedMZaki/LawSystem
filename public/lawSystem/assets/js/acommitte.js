
  // Not Voted Table
  var NotVotedTable = $('#notvoted').dataTable({
      paging: true,
      destroy: true,
      columnDefs: [ 
        {
          "targets": [ 0 ],
          "orderable": false,

        }
      ],
      order: [[ 1, 'asc' ]],
        orderCellsTop: true,
        "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "الكل"]],
        'pagingType': 'full_numbers_no_ellipses',
        sDom: 'lrt<"row"<"col-sm-12 col-md-7"i><"col-sm-12 col-md-5"p>>',
        "bLengthChange" : false,   
        "language": {
          "emptyTable": "لا يوجد بيانات",
          "infoEmpty":      "عدد 0 اسم",
          "info": "عدد _TOTAL_ اسم",
          "lengthMenu": "اظهر _MENU_ اسم",
          "infoFiltered": "(من اصل _MAX_ اسم)",
          "zeroRecords": "لا يوجد نتائج للبحث",
           "paginate": {
            "previous": "<",
            "next": ">",
            "last": ">>",
            "first": "<<"
          }
      }
    });
    

// Voted
    var VotedTable = $('#voted').dataTable({
        paging: true,
        destroy: true,
        columnDefs: [ 
          {
            "targets": [ 0 ],
            "orderable": false,
  
          }
        ],
        order: [[ 1, 'asc' ]],
          orderCellsTop: true,
          "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "الكل"]],
          'pagingType': 'full_numbers_no_ellipses',
          sDom: 'lrt<"row"<"col-sm-12 col-md-7"i><"col-sm-12 col-md-5"p>>',
          "bLengthChange" : false,   
          "language": {
            "emptyTable": "لا يوجد بيانات",
            "infoEmpty":      "عدد 0 اسم",
            "info": "عدد _TOTAL_ اسم",
            "lengthMenu": "اظهر _MENU_ اسم",
            "infoFiltered": "(من اصل _MAX_ اسم)",
            "zeroRecords": "لا يوجد نتائج للبحث",
             "paginate": {
              "previous": "<",
              "next": ">",
              "last": ">>",
              "first": "<<"
            }
        }
      });


    
    var t = $('#notvoted').DataTable();    

    t.columns().every(function (index) {
      $('#notvoted tfoot tr:eq(0) th:eq(' + index + ') input[type="text"],#notvoted tfoot tr:eq(0) th:eq(' + index + ') select').on('change', function () {
        t.column($(this).parent().index() + ':visible')
              .search(this.value)
              .draw();
      });
 
});

    t.on( 'order.dt search.dt', function () {
      t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
      } );
     } ).draw();
  
  var tt = $('#voted').DataTable();    

  tt.columns().every(function (index) {
    $('#voted tfoot tr:eq(0) th:eq(' + index + ') input[type="text"],#voted tfoot tr:eq(0) th:eq(' + index + ') select').on('change', function () {
      tt.column($(this).parent().index() + ':visible')
            .search(this.value)
            .draw();
    });

});

  tt.on( 'order.dt search.dt', function () {
    tt.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
   } ).draw();

    $('#notvoted').on('click', '.isvoted' , function () {
      $('body>.tooltip').remove();
      var $row = $(this).closest('tr');
      var addRow = (NotVotedTable.fnGetData($row));
      addRow[3] = '<div class="d-flex actions justify-content-center"><a data-toggle="tooltip" data-placement="top" title="حذف" class="icon remove-voter" data-original-title="حذف"><i class="removevote window-close-icon inline-icon red-icon"></i> </a></div>';
      VotedTable.fnAddData(addRow);
       NotVotedTable.fnDeleteRow($(this).closest('tr')); 
       NotVotedTable.draw();
       VotedTable.draw();

    });
      $('#voted').on('click', '.removevote' , function () {
        $('body>.tooltip').remove();
        var $row = $(this).closest('tr');
        var addRow = (VotedTable.fnGetData($row));
        addRow[3] = '<div class="d-flex actions justify-content-center"><a data-toggle="tooltip" data-placement="top" title="اضافة" class="icon add-voter" data-original-title="اضافة"> <i class="isvoted check-square-icon inline-icon green-icon"></i></a></div>';
        NotVotedTable.fnAddData(addRow);
         VotedTable.fnDeleteRow($(this).closest('tr'));
         NotVotedTable.draw();
         VotedTable.draw();
    });


    
    
function chabgepgln(pgln) {
  var value = pgln.value;  
  var table = $('#notvoted').DataTable();
  var table2 = $('#voted').DataTable();
  table.page.len( value ).draw();
  table2.page.len( value ).draw();

}


$(window).on('load',function(){
  PageNumberInputNV();
  PageNumberInputV();
  vappendButtonPrint();
  nvappendButtonPrint();

})


$('#voted').on('draw.dt', function () {
  vappendButtonPrint();
  PageNumberInputV();
} );
$('#notvoted').on('draw.dt', function () {
  nvappendButtonPrint();
  PageNumberInputNV();

} );

function nvappendButtonPrint() {
  $('#notvoted_paginate ul').append(`
    <div class="printer"><a class="btn_print mx-2" data-toggle="modal" data-target="#print-modal">
      <i class="print-icon inline-icon black-icon" data-toggle="tooltip" data-original-title="طباعة"></i>
    </a></div>
  `);
}

function vappendButtonPrint() {
  $('#voted_paginate ul').append(`
  <div class="printer"><a class="btn_print mx-2" data-toggle="modal" data-target="#print-modal">
  <i class="print-icon inline-icon black-icon" data-toggle="tooltip" data-original-title="طباعة"></i>
</a></div>
  `);
}

function PageNumberInputNV() {
  $(`<li id="goPage1"><input type='number' min='1' id='goPageV' onChange="JumptoNV(this)" class='paginate_input go-to-page' placeholder='ادخل رقم'></li>`).insertBefore( "#notvoted_paginate  .next" );
}

function JumptoNV(e) {
  table = $('#notvoted').DataTable();
  var PN = e.value-1;
  table.page(PN).draw(false);
  }

  function PageNumberInputV() {
    $(`<li id="goPage2"><input type='number' min='1' id='goPageNV' onChange="JumptoV(this)" class='paginate_input go-to-page' placeholder='ادخل رقم'></li>`).insertBefore( "#voted_paginate  .next" );
  }
  
  function JumptoV(e) {
    table = $('#voted').DataTable();
    var PN = e.value-1;
    table.page(PN).draw(false);
    }


    