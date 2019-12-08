
(function($) {
  "use-strict";

  //  1-  menu mobile
  $("#toggle").on("click", function() {
    if ($(window).width() < 992) {
      $(" .main-navigation .main-menu").slideToggle(200);

      $(".mobile-menu-overlay").toggleClass("mobile-menu-overlay-active");
    }
  });

  $(".mobile-menu-overlay").on("click", function() {
    if ($(window).width() < 992) {
      $(" .main-navigation .main-menu").slideToggle(200);

      $(".mobile-menu-overlay").toggleClass("mobile-menu-overlay-active");
    }
  });





  //  2- tooltip
  $('[data-toggle="tooltip"]').tooltip({
    trigger : 'hover'
}) 


  $(".toogleCompletion").click(function() {
    $(this).css('color', '#ffffff');
    if($(this).text() == "أنجز") {
        $(this).text('لم يتم');
        $(this).css('background-color', '#e32336');
    }else{
      $(this).text('أنجز');
      $(this).css('background-color', '#28a745');
    }
  });

  
  
  // 3- dropdown-menu
 
  $(document).ready(function() {

    var SelectWithSearch = document.getElementsByClassName('SelectWithSearch');
    if (SelectWithSearch.length > 0) {
    $('.SelectWithSearch').select2({
placeholder: "اختر", width: "100%",height: "100%"
  });
    }
    var SelectRemovedSearch = document.getElementsByClassName('SelectRemovedSearch');
    if (SelectRemovedSearch.length > 0) {
  $('.SelectRemovedSearch').select2({
    dir: "rtl",dropdownCssClass:'RemoveInput',allowClear: true, placeholder: "اختر"
    });
    }
  });
    

  $(document).ready(function() {
    $(".dropdown-menu a ").click(function(event) {
      var option = $(event.target).text();
      $(event.target)
        .parents(".dropdown")
        .find(".dropdown-toggle")
        .html(option);
    });
  });

     // 4- datepicker
     $(".input_datetimepicker").datepicker($.datepicker.regional["ar"]);

     $(".input_dateyearpicker").datepicker( {
       format: "yyyy",
       viewMode: "years", 
       minViewMode: "years",
       orientation: "bottom right",
   }).on('changeDate', function(e){
       $(this).datepicker('hide');
   });


})(jQuery);

/********************************************
 * 
********************************************/

function appendButtonPrint() {
  document.querySelectorAll('.printer').forEach(function(a) {
    a.remove()
  })
  $(`<li id="goPage2"><input type='number' min='1' id='goPageNV' onChange="Jumpto(this)" class='paginate_input go-to-page' placeholder='ادخل رقم'></li>`).insertBefore( "#DataTables_Table_0_paginate  .next" );


$('#DataTables_Table_0_paginate ul').append(`
<div class="printer"><a class="btn_print mx-2" data-toggle="modal" data-target="#print-modal">
<i class="fa fa-print" data-toggle="tooltip" data-original-title="طباعة"></i>
</a></div>
`);
}

function Jumpto(e) {
  table = $('.datatable').DataTable();
  var ss = e.value-1;
  table.page(ss).draw(false);
  }
/*******************************************
 *  select multiple checkboxes
*******************************************/ 

$(document).ready(function () {
  $('.select-all-box').click(function () {
    if(this.checked) {
      $('.select-box').prop('checked', this.checked);
      $('.select-semi').prop("disabled", true);
      $('.select-semi').prop("checked", false);
    } else {
      $('.select-box').prop('checked', false);
      $('.select-semi').prop("disabled", false);
      $('.select-semi').prop("disabled", false);
    }
        
  });

  $('.select-semi-box').click(function () {
    if(this.checked) {
      $('.select-semi').prop("disabled", true);
      $('.select-semi').prop("checked", false);
    } else {
      $('.select-semi').prop("disabled", false);
    }
   
  });

  $('.select-email-box').click(function () {
    if(this.checked) {
      $('.select-email').prop("disabled", true);
      $('.select-email').prop("checked", false);
    } else {
      $('.select-email').prop("disabled", false);
    }
   
  });

});



/*******************************************
 *    Upload file
*******************************************/ 
$("#file-upload").change(function(){
  $("#file-name").text(this.files[0].name);
});


/*******************************************
 * highlight row when checkbox is checked
*******************************************/

$(document).ready(function () {

  /********* highlight single row ********/
  $('.table').on('click','.select-box', function() {
    if ($(this).prop('checked') === true) {
       $(this).closest('tr').addClass('highlight'); 
    } else {
       $(this).closest('tr').removeClass('highlight'); 
    }
  });

  /********* highlight multiple rows ********/
  $(".table").on('click','.select-all-box',function(){
    if(this.checked) {
      $('.select-box').parents('tr').addClass('highlight');
    } else {
      $('.select-box').parents('tr').removeClass('highlight');
    }
    });
});





