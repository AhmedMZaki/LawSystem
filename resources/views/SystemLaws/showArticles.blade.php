@extends('layouts.master')

@section('title')
    قوانين
@endsection

@section('stylesheets')

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
                            <li><a href="{{route('getLaws')}}">القانون رقم {{$law->lawno}}</a></li>
                            <li><a href="#">مواد القانون</a></li>
                        </ol>
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
                                    <th class="w_30 pr-2">م</th>
                                    <th class="w_70 text-center">رقم المادة</th>
                                    <th class="w_100 text-center">نص المادة</th>
                                    <th class="w_80 text-center">رقم الكتاب</th>
                                    <th class="w_80 text-center">عنوان الكتاب</th>
                                    <th class="w_50 text-center">رقم الباب</th>
                                    <th class="w_80 text-center"> عنوان الباب</th>
                                    <th class="w_100 text-center">الفصل</th>
                                    <th class="w_70 text-center"> عنوان الفصل</th>
                                    <th class="w_80 text-center"> عنوان المادة</th>

                                    <th class="w_70 text-center">إضافة</th>
                                    <th class="w_70 text-center">حذف</th>
                                </tr>
                                </thead>
                                <tfoot>

                                </tfoot>
                                <tbody>
                                @if (count($articles))
                                    @foreach ($articles as $article)
                                        <tr>
                                            <td>{{$article->id}}</td>
                                            <td>{{$article->articleno}} </td>
                                            <td>{{$article->articlebody}} </td>
                                            <td>{{$article->subjectid}}</td>
                                            <td>{{$article->subjectitle}}</td>
                                            <td>{{$article->chapterid}}</td>
                                            <td>{{$article->chaptertitle}} </td>
                                            <td>{{$article->sectionid}} </td>
                                            <td>{{$article->sectiontitle}} </td>
                                            <td>{{$article->articletitle}} </td>
                                            <td>
                                                <a href="{{route('editArticle',['articleID'=>$article])}}"
                                                   class="btn general_btn btn_1">
                                                    تعديل
                                                    <img src="{{asset('lawSystem/assets/images/edit.svg')}}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{route('deleteArticle',['articleID'=>$article])}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn  general_btn btn_1"
                                                            style="height: 26px;"
                                                            onclick="return confirm('هل انت متأكد من انك تريد حذف هذه المادة');"
                                                            name="submit">
                                                        حذف
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
    in
@endsection

@section('secripts')

    <script src="{{asset('lawSystem/assets/js/jquery.js')}}"></script>

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
