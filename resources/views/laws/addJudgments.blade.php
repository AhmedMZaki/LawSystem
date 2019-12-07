<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{asset('css/Toast.css')}}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style media="screen">
        .right
        {
            float: right;
        }
        option
        {
            direction: rtl;
        }
    </style>
</head>
<body>
<div class="flex-center " id="app">
    <div class="content">
        <div class="container">
            <div class="col-lg-12 col-md-12">
                <form method="post" action="{{route('saveJudgment')}}"  id="form2"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 col-lg-6" style="float: left;">
                        <div class="form-group">
                            <ul class="list-group">
                                @if(count($files))
                                    @foreach($files as $fileName)
                                        <div class="form-group">
                                            <li class="list-group-item">
                                                {{$fileName}}
                                                <input type="radio" id="judgmentfile" name="judgmentfile" value="{{$fileName}}"
                                                       required>
                                                <object width="400" height="400" data="{{asset('storage/files/'.$fileName)}}">

                                                </object>
                                            </li>
                                        </div>
                                    @endforeach
                                    @else
                                    <h3>their is no files to add</h3>
                                    @endif

                            </ul>
                        </div>
                    </div>
                    <div classb="col-md-6 col-lg-6" style="float: right">
                        <div id="errors">
                            <div class="form-group">
                                @if (count($errors))
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="list-group-item">{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @csrf
                        <div class="form-group">
                            <label class="right" dir="rtl" >اضافة الاحكام </label>
                            @if(count($files))
                            <input type="button" class="btn btn-info" value="تعديل الادخال الاخير" />
                                @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="right" dir="rtl" for="judgmentcategory">تصنيف الحكم</label>
                            <select class="form-control" id="judgmentcategory" name="judgmentcategory" required>
                                <option value="دستورى">دستورى</option>
                                <option value="جنائي">جنائي</option>
                                <option value="أحوال ">أحوال</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="right" dir="rtl" for="judgmentDate">تاريخ الجلسة</label>
                            <input type="date" class="form-control" name="judgmentDate" id="judgmentDate" lang="ar"
                                   placeholder="تاريخ
                        الجلسة"
                                   dir="rtl" required
                            >
                        </div>
                        <div class="form-group">
                            <label class="right" dir="rtl" for="year"> السنة</label>
                            <select class="form-control" id="year" name="year" required>
                                <option value="2010">2010</option>
                                <option value="2000">2000</option>
                                <option value="2018 ">2018</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label dir="rtl" class="right" for="objectionNo"> رقم الطعن</label>
                            <input type="text" class="form-control" name="objectionNo" lang="ar" id="objectionNo"
                                   placeholder="رقم الطعن" dir="rtl" required>
                        </div>
                        <div class="form-group">
                            <label dir="rtl" class="right" for="notes"> عدد المبادي </label>
                            <input type="text" class="form-control" name="notes" lang="ar" id="notes"
                                   placeholder="عد المبادئ" dir="rtl" required>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <label dir="rtl" class="right" for="lawfile"> تحميل مستند الطعن </label>--}}
                        {{--                            <input type="file" id="lawfile" name="lawfile" accept="application/pdf">--}}
                        {{--                        </div>--}}
                        <br>
                        <div class="form-group">
                            @if(count($files))  <input type="submit" name="submit" value="حفظ" class=" right btn
                            btn-primary">@endif
                        </div>
                    </div>
                </form>


            </div>


        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/Toast.js')}}"></script>
</body>
</html>
