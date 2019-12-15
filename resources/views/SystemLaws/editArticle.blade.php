@extends('layouts.master')

@section('title')
    تعديل مادة إلي القانون رقم {{$articleID->law->lawno}}
@endsection

@section('stylesheets')
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico" /> -->
    {{--    <link rel="stylesheet" href="{{asset('lawSystem/lawSystem/assets/css/dataTables.bootstrap4.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/select2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/icons.css')}}"/>
    <link rel="stylesheet" href="{{asset('lawSystem/assets/css/jquery.toast.css')}}"/>

@endsection

@section('content')

    <!-- start content-wrapper -->
    <div class="content-wrapper">
        <div class="main_content" id="LawArticles">

            <!-- start row -->
            <div class="row align-items-center min-height-row">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center flex-wrap">
                        <ol class="breadcrumb">
                            <li><a href="#">الرئيسية</a></li>
                            <li><a href="{{route('getLaws')}}">القوانين</a></li>
                            <li><a href="{{route('addNewLaw')}}">تعديل مادة إلي القانون رقم ({{$articleID->law->lawno}}
                                    )</a></li>
                            <li><a href="{{route('getLaws')}}">المواد</a></li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
            </div>
            <!-- end row -->
            <!-- start row -->
            <div class="row mt-0">
                <div class="col-lg-12 tbl-new-brdr">
                    <div class="panel panel-default no-brdr">
                        <div id="app3">
                            <form method="post"
                                  action="{{route('updateArticle',['articleID'=>$articleID])}}"

                                  enctype="multipart/form-data"
                            >
                                @csrf
                                @method('PATCH')
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label>رقم الكتاب<span class="redstar"></span></label>

                                        <select name="subjectid" id="subjectid" dir="rtl"
                                                class="SelectRemovedSearch">
                                            <option selected>....</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>عنوان الكتاب</label>
                                        <input type="num" name="subjectitle" id="subjectitle" class="form-control"
                                               value="{{$articleID->subjectitle}}"
                                               lang="ar" placeholder="عنوان الكتاب "
                                               dir="rtl">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>رقم الباب<span class="redstar"></span></label>

                                        <select name="chapterid" id="chapterid" lang="ar" placeholder=" رقم الباب"
                                                dir="rtl"
                                                class="SelectRemovedSearch">
                                            <option selected>....</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>عنوان الباب</label>
                                        <input type="num" name="chaptertitle" id="chaptertitle" lang="ar"
                                               class="form-control"
                                               value="{{$articleID->chaptertitle}}"
                                               placeholder="عنوان الباب "
                                               dir="rtl">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>رقم الفصل<span class="redstar"></span></label>

                                        <select name="sectionid" id="sectionid" lang="ar" placeholder=" رقم الفصل"
                                                dir="rtl"
                                                class="SelectRemovedSearch">
                                            <option selected>....</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>عنوان الفصل</label>
                                        <input type="num" name="sectiontitle" id="sectiontitle" lang="ar"
                                               placeholder=" عنوان الفصل "
                                               dir="rtl"
                                               class="form-control" value="{{$articleID->sectiontitle}}"
                                        >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label>رقم المادة</label>
                                        <input type="num" class="form-control" name="articleno" lang="ar" id="articleno"
                                               placeholder="رقم المادة" dir="rtl"
                                               value="{{$articleID->articleno}}"

                                        >
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>عنوان المادة</label>
                                        <input type="num" lang="ar" class="form-control"
                                               name="articletitle" id="articletitle"
                                               placeholder="عنوان المادة" dir="rtl" value="{{$articleID->articletitle}}"
                                        >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>نص المادة</label>
                                        <textarea name="articlebody" id="articlebody"
                                                  class="form-control rounded-0"
                                                  rows="5" cols="15"

                                                  required>{{$articleID->articlebody}}</textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="submit" class="btn general_btn btn_1" value="حفظ">
                                        <a href="{{route('showrticles',['law'=>$articleID->law])}}"
                                           class="btn general_btn btn_1">
                                            العودة
                                        </a>
                                    </div>

                                </div>
                            </form>


                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end content-wrapper -->
    </div>
@endsection

@section('secripts')
    <!-- end main-wrapper -->

    <script>
        $(function () {
            $("#header").load("header.html");
            $("#footer").load("footer.html");

        });
    </script>
    {{--        <script src="{{asset('lawSystem/lawSystem/assets/js/popper.js')}}"></script>--}}
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
