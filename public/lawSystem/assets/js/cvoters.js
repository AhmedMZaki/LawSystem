  $.fn.DataTable.ext.pager.numbers_length = 3;
  var table = $('#voters').DataTable({
      paging: true,
      destroy: true,
      columnDefs: [ 
        {
          "targets": [ 0,1 ],
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
        sDom: 'lrt<"row"<"col-sm-12 col-md-7 pr-0"i><"col-sm-12 col-md-5"p>>',
        "bLengthChange" : false,   
        "language": {
             select: {
              rows: ' تحديد   %d   اسم اضافة الى<li class="add-to-group"><select class="SelectRemovedSearch"><option>المدرسين</option> <option>اطباء</option><option>مدرسة محمد الشايجي الابتدائية للبنين</option></select><button onclick="return toast(\' اضافة لمجموعة المدرسين \',\'لم يتم الحفظ \',\'error\')" class="btn save-to-group general_btn btn_1"><i class="plus-icon btn-icon-width inline-icon green-icon"></i><span>اضافة </span></button></li>'
            },
          "emptyTable": "لا يوجد بيانات",
          "infoEmpty":      "عدد 0 اسم",
          "info": "عرض _START_ الى _END_ من _TOTAL_",
          "lengthMenu": "اظهر _MENU_ اسم",
          "infoFiltered": "(من اصل _MAX_)",
          "zeroRecords": "لا يوجد نتائج للبحث",
           "paginate": {
            "previous": "<",
            "next": ">",
            "last": ">>",
            "first": "<<"
          }
      }
    });


    $('#example').on( 'click', 'tbody td:not(:first-child)', function (e) {
      editor.inline( this );
  } );

    table.columns().every(function (index) {
      $('#voters tfoot tr:eq(0) th:eq(' + index + ') input[type="text"],#voters tfoot tr:eq(0) th:eq(' + index + ') select').on('change', function () {
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


table.on( 'select deselect', function ( e, dt, type, indexes ) {
  $(".SelectRemovedSearch").select2("destroy");
  $(".SelectRemovedSearch").select2({ dir: "rtl",dropdownCssClass:'RemoveInput',allowClear: true, placeholder: "اختر"});
} ).draw();

table.on("click", "th.select-checkbox2>input", function() {
    if ($("th.select-checkbox2").hasClass("selected")) {
      table.rows({ page: 'current'}).deselect();
        $("th.select-checkbox2").removeClass("selected");
    } else {
      table.rows({ page: 'current'}).select();
        $("th.select-checkbox2").addClass("selected");
    }
})


$(window).on('load',function(){
  appendButtonPrint();
    PageNumberInput();
    Checkbox();
})
  $('#voters').on('draw.dt', function () {
    $(".SelectRemovedSearch").select2("destroy");
    $(".SelectRemovedSearch").select2({ dir: "rtl",dropdownCssClass:'RemoveInput',allowClear: true, placeholder: "اختر"});
    appendButtonPrint();
    PageNumberInput();
    Checkbox();

  } );

  function Checkbox() {
    
    $("th.select-checkbox2").removeClass("selected");
    $("th.select-checkbox2>input").prop('checked', false); 
    if ($("tr").hasClass("selected")) {
      $("th.select-checkbox2").addClass("selected");
      $("th.select-checkbox2>input").prop('checked', true); 
    }
  }
  function appendButtonPrint() {
    document.querySelectorAll('.printer').forEach(function(a) {
      a.remove()
    })
    $('#voters_paginate ul').append(`
    <div class="printer"><a class="btn_print mx-2" data-toggle="modal" data-target="#print-modal">
      <i class="print-icon inline-icon black-icon" data-toggle="tooltip" data-original-title="طباعة"></i>
    </a></div>
      `);
}


function PageNumberInput() {
  $(`<li><input type='number' min='1' id='goPage' onchange="Jumpto(this)" class='paginate_input go-to-page' placeholder='ادخل رقم'></li>`).insertBefore( ".next" );
}

function Jumpto(e) {
  table = $('#voters').DataTable();
  var ss = e.value-1;
  table.page(ss).draw(false);
  }

function chabgepgln(pgln) {
  var value = pgln.value;  
  var table = $('#voters').DataTable();
  table.page.len( value ).draw();

}