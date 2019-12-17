@extends('layouts.master')

@section('title')
    الأحكام
@endsection

@section('stylesheets')
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico" /> -->
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/select2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/icons.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/jquery.toast.css')}}"/>
    <style>
        .table-right td {
            text-align: center;
        }

        .general_btn {
            margin-right: -4px;
        }
    </style>

@endsection

@section('content')

    <!-- start content-wrapper -->
    <div class="content-wrapper">
        <div class="main_content">

            <!-- start row -->
            <div class="row align-items-center min-height-row">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center flex-wrap">
                        <ol class="breadcrumb">
                            <li><a href="#">الرئيسية</a></li>
                            <li><a href="{{route('getJudgments')}}">الأحكام</a></li>
                        </ol>
                    </div>
                </div>

                <template id="alert_template">
                    <div :class="alertClasses" v-show="show">
                        <slot></slot>
                        <span class="alert_close" @click="show=false">X</span>
                    </div>
                </template>
                <div class="col-lg-6">
                    <div
                        class="navbar d-flex flex-wrap align-items-center justify-content-start justify-content-lg-end rec-counts">
                        <a href="{{route('addJudgments')}}">
                            <button class="general_btn btn_1 ml-2">
                                <i class="plus-icon btn-icon-width inline-icon green-icon"></i><span>اضافة جديد</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <!-- start row -->
            <div class="row mt-0">
                <div class="col-lg-12 tbl-new-brdr">
                    <div class="panel panel-default no-brdr">
                        <div class="table-responsive">
                            <table id="usersTable" class="table table-striped mb-0 table-right CustomTable datatable">
                                <thead>
                                <tr>
                                    <th class="w_40 pr-2">م</th>
                                    <th class="w_100 text-center">التصنيف</th>
                                    <th class="w_120 text-center">تاريخ الجلسة</th>
                                    <th class="w_100 text-center">سنة الاصدار</th>
                                    <th class="w_70 text-center">رقم الطعن</th>
                                    <th class="w_70 text-center">عدد المبادئ</th>
                                    <th class="w_70 text-center">غير مكتمل</th>
                                    <th class="w_100 text-center">عرض المبادئ</th>
                                    <th class="w_100 text-center">إضافة مبدأ</th>
                                    <th class="w_70 text-center">تعديل</th>
                                    <th class="w_70 text-center">حذف</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th><input id="Name" class="form-control" type="text" placeholder="التصنيف"/></th>
                                    <th><input id="Name" class="form-control" type="text" placeholder="تاريخ الجلسة"/>
                                    </th>
                                    <th><input id="Name2" class="form-control" type="text" placeholder="سنة الاصدار"/>
                                    </th>
                                    <th><input id="Name2" class="form-control" type="text" placeholder="رقم الطعن"/>
                                    </th>
                                    <th><input id="Name2" class="form-control" type="text" placeholder="عدد المبادئ"/>
                                    </th>
                                    <th><input id="Name2" class="form-control" type="text" placeholder="غير مكتمل"/>
                                    </th>
                                    <th>######</th>
                                    <th>######</th>
                                    <th>######</th>
                                    <th>######</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end content-wrapper -->

@endsection

@section('secripts')
    <!-- end main-wrapper -->
    <script src="{{asset('lawSystem/assets/js/jquery.js')}}"></script>
    <script>
        $(function () {
            $("#header").load("header.html");
            $("#footer").load("footer.html");

        });
    </script>
    <script src="{{asset('lawSystem/assets/js/popper.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/full_numbers_no_ellipses.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/function.js')}}"></script>
    <script>
        $.fn.DataTable.ext.pager.numbers_length = 3;
        var table = $('#usersTable').DataTable({
            paging: true,
            destroy: true,
            columnDefs: [
                {
                    "targets": [0],
                    "orderable": false,

                }
            ],
            select: {
                style: 'multi',
                selector: '.select-box'
            },
            order: [[2, 'asc']],
            orderCellsTop: true,
            "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "الكل"]],
            'pagingType': 'full_numbers_no_ellipses',
            sDom: 'lrt<"row"<"col-sm-12 col-md-7"i><"col-sm-12 col-md-5"p>>',
            "bLengthChange": false,
            "language": {
                select: {
                    rows: " تم تحديد   %d   قانون اضافة الى<li class='add-to-group'><select class='fotrolo' title='اختر'><option>المدرسين</option> <option>اطباء</option></select><button class='btn save-to-group general_btn btn_1'><i class='plus-icon   btn-icon-width inline-icon green-icon'></i><span>اضافة </span></button></li>"
                },
                "emptyTable": "لا يوجد بيانات",
                "infoEmpty": "عرض 0 الي 0 من 0 قانون",
                "info": "عرض _START_ الى _END_ من _TOTAL_ قانون",
                "lengthMenu": "اظهر _MENU_ ملف",
                "infoFiltered": "(من اصل _MAX_ ملف)",
                "zeroRecords": "لا يوجد نتائج للبحث",
                "paginate": {
                    "previous": "<",
                    "next": ">",
                    "last": ">>",
                    "first": "<<"
                }
            },
            ajax: "{{ url('judgments-list') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'judgmentcategory', name: 'judgmentcategory'},
                {data: 'judgmentDate', name: 'judgmentDate'},
                {data: 'year', name: 'year'},
                {data: 'objectionNo', name: 'objectionNo'},
                {data: 'notes', name: 'notes'},
                {data: 'notes', name: 'incompletednotes'},
                {
                    data: 'id', name: 'add', "render": function (data) {
                        data = '<a class="general_btn btn_1 ml-2" href="#">' + "عرض المبادئ" + '</a>';
                        return data;
                    }
                },
                {
                    data: 'id', name: 'add', "render": function (data) {
                        data = '<a class="general_btn btn_1 ml-2" href="/judgments/addNote/' + data + '">' + "إضافة مبادئ" + '</a>';
                        return data;
                    }
                },
                {
                    data: 'id', name: 'edit', "render": function (data) {
                        data = '<a class="general_btn btn_1 ml-2" href="/judgments/' + data + '/edit">' + "تعديل" + '</a>';
                        return data;
                    }
                },
                {
                    data: 'id', name: 'edit', "render": function (data) {
                        data = '<a class="general_btn btn_1 ml-2" href="#">' + "حذف" + '</a>';
                        return data;
                    }
                },

            ]

        });


        table.columns().every(function (index) {
            $('.CustomTable tfoot tr:eq(0) th:eq(' + index + ') input[type="text"],.CustomTable tfoot tr:eq(0) th:eq(' + index + ') select').on('change', function () {
                table.column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
            });

        });

        table.on('order.dt search.dt', function () {
            table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


        table.on("click", "th.select-checkbox2>input", function () {
            if ($("th.select-checkbox2").hasClass("selected")) {
                table.rows({page: 'current'}).deselect();
                $("th.select-checkbox2").removeClass("selected");
            } else {
                table.rows({page: 'current'}).select();
                $("th.select-checkbox2").addClass("selected");
            }
        })


        $(window).on('load', function () {
            PageNumberInput();
        })
        $('.CustomTable').on('draw.dt', function () {
            PageNumberInput();

        });


        function PageNumberInput() {
            $(`<li><input type='number' min='1' id='goPage' onchange="Jumpto(this)" class='paginate_input go-to-page' placeholder='ادخل رقم'></li>`).insertBefore(".next");
        }

        function Jumpto(e) {
            table = $('.CustomTable').DataTable();
            var ss = e.value - 1;
            table.page(ss).draw(false);
        }

        function chabgepgln(pgln) {
            var value = pgln.value;
            var table = $('.CustomTable').DataTable();
            table.page.len(value).draw();

        }

    </script>
    <script src="{{asset('lawSystem/assets/js/select2.min.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/jquery.toast.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/alertfunction.js')}}"></script>


@endsection
