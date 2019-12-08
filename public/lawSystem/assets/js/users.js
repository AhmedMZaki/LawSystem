$.fn.DataTable.ext.pager.numbers_length = 3;
var table = $('.CustomTable').DataTable({
    paging: true,
    destroy: true,
    columnDefs: [ 
      {
        "targets": [ 0 ],
        "orderable": false,

      }
    ],
    select: {
      style:    'multi',
      selector: '.select-box'
  },
    order: [[ 2, 'asc' ]],
      orderCellsTop: true,
      "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "الكل"]],
      'pagingType': 'full_numbers_no_ellipses',
      sDom: 'lrt',
      "bLengthChange" : false,   
      "language": {
           select: {
          rows: " تم تحديد   %d   اسم اضافة الى<li class='add-to-group'><select class='fotrolo' title='اختر'><option>المدرسين</option> <option>اطباء</option></select><button class='btn save-to-group general_btn btn_1'><i class='plus-icon   btn-icon-width inline-icon green-icon'></i><span>اضافة </span></button></li>"
      },
        "emptyTable": "لا يوجد بيانات",
        "infoEmpty":      "عرض 0 الي 0 من 0 اسم",
        "info": "عرض _START_ الى _END_ من _TOTAL_ اسم",
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




  table.columns().every(function (index) {
    $('.CustomTable tfoot tr:eq(0) th:eq(' + index + ') input[type="text"],.CustomTable tfoot tr:eq(0) th:eq(' + index + ') select').on('change', function () {
      table.column($(this).parent().index() + ':visible')
            .search(this.value)
            .draw();
    });

});

  table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
   cell.innerHTML = i+1;
} );
} ).draw();





