@extends('layouts.master')

@section('title')
    قوانين
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/select2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/icons.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/jquery.toast.css')}}"/>
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
                            <li><a href="{{route('getLaws')}}">القوانين</a></li>
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
                        <a href="{{route('addNewLaw')}}">
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
                                    <th class="w_120 text-center">النوع</th>
                                    <th class="w_100 text-center">التصنيف</th>
                                    <th class="w_100 text-center">رقم القانون</th>
                                    <th class="w_80 text-center">سنة الاصدار</th>
                                    <th class="w_159 text-center">بشأن</th>
                                    <th class="w_70 text-center">إضافة مواد</th>
                                    <th class="w_80 text-center"> عرض المواد</th>
                                    <th class="w_70 text-center">تعديل</th>
                                    <th class="w_70 text-center">الحالة</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th><input id="Name" class="form-control" type="text" placeholder="النوع"/></th>
                                    <th><input id="Name" class="form-control" type="text" placeholder="القانون"/></th>
                                    <th><input id="Name2" class="form-control" type="text" placeholder="رقم القانون"/>
                                    </th>
                                    <th><input id="Name2" class="form-control" type="text" placeholder="سنة الاصدار"/>
                                    </th>
                                    <th><input id="Name2" class="form-control" type="text" placeholder="بشأن"/></th>
                                    <th><input disabled id="Name2" class="form-control" type="text"
                                               placeholder="إضافة مواد"/></th>
                                    <th><input disabled id="Name2" class="form-control" type="text"
                                               placeholder="عرض المواد"/></th>
                                    <th><input disabled id="Name2" class="form-control" type="text"
                                               placeholder="تعديل"/></th>
                                    <th><input disabled id="Name2" class="form-control" type="text"
                                               placeholder="الحالة"/></th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @if (count($laws))
                                    @foreach ($laws as $law)
                                        <tr>
                                            <td>{{$law->id}}</td>
                                            <td>{{$law->lawtype}}</td>
                                            <td>{{$law->lawcategory}}</td>
                                            <td>{{$law->lawno}}</td>
                                            <td>{{$law->lawyear}} </td>
                                            <td>{{$law->lawrelation}} </td>
                                            <td>
                                                <a href="{{route('addArticle',['lawID'=>$law])}}"
                                                   class="btn general_btn btn_1"
                                                   title="إضافة مواد إلي القانون {{$law->lawno}}"
                                                >
                                                    إضافة مادة
                                                    <img src="{{asset('lawSystem/assets/images/plus.svg')}}" alt="">

                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn general_btn btn_1"

                                                >
                                                    عرض المواد

                                                </a>
                                            </td>
                                            <td>

                                                <a href="{{route('editLaw',['lawID'=>$law])}}"
                                                   class="btn general_btn btn_1"
                                                   title="تعديل القانون رقم {{$law->lawno}}"
                                                >
                                                    تعديل
                                                    <img src="{{asset('lawSystem/assets/images/edit.svg')}}" alt="">

                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{route('delteLaw',['lawID'=>$law])}}" method="post">

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn  general_btn btn_1"
                                                            style="height: 26px;"
                                                            onclick="return confirm('هل انت متأكد من انك تريد حذف هذا القانون');"
                                                            name="submit">
                                                        تعطيل
                                                        <img src="{{asset('lawSystem/assets/images/times.svg')}}">
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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

    <script src="{{asset('lawSystem/assets/js/jquery.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/popper.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/full_numbers_no_ellipses.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/function.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/select2.min.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/jquery.toast.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/users.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/alertfunction.js')}}"></script>

@endsection
