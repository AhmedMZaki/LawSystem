
<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <style media="screen">
        .right
        {
            float: right;
            text-align: right;
        }
        option
        {
            direction: rtl;
            text-align: right;
        }
    </style>
</head>
<body>

<div class="flex-center " id="app">
    <div class="content">
        <div class="container">
            <div class="col-md-6 col-lg-6">
                <div class="col-md-6 col-lg-6">
                    <li class=" alert alert-info" style="list-style-type: none;text-align: justify">

                        رقم القانون   {{$findedLaw->lawno}}
                    </li>
                </div>
                 <form  id="addLawArticles" method="post" action="{{route('SaveArticle')}}" >

                    @csrf

                    <input type="hidden" {{old('lawid')}} name="lawid" id="lawid" value="{{$findedLaw->id}}">
                    <div class="form-group">
                        <label class="right" dir="rtl" for="subjectid">رقم الكتاب</label>
                        <input type="text" class="form-control" name="subjectid" id="subjectid" lang="ar" placeholder="رقم الكتاب"
                               dir="rtl" {{old('subjectid')}}>
                        <label class="right" dir="rtl" for="subjectitle">عنوان الكتاب </label>
                        <input type="text" class="form-control" name="subjectitle" id="subjectitle" lang="ar" placeholder="عنوان الكتاب "
                               dir="rtl" {{old('subjectitle')}}>
                    </div>
                    <div class="form-group">
                        <label class="right" dir="rtl" for="chapterid">رقم الباب</label>
                        <input type="text" class="form-control" name="chapterid" id="chapterid" lang="ar" placeholder=" الباب"
                               dir="rtl" {{old('chapterid')}}
                        >
                        <label class="right" dir="rtl" for="chaptertitle">عنوان الباب </label>
                        <input type="text" class="form-control" name="chaptertitle" id="chaptertitle" lang="ar" placeholder="عنوان الباب "
                               dir="rtl" {{old('chaptertitle')}}
                        >
                    </div>
                    <div class="form-group">
                        <label class="right" dir="rtl" for="sectionid">رقم الفصل</label>
                        <input type="text" class="form-control" name="sectionid" id="sectionid" lang="ar" placeholder=" الفصل"
                               dir="rtl" {{old('sectionid')}}
                        >
                        <label class="right" dir="rtl" for="sectiontitle">عنوان الفصل </label>
                        <input type="text" class="form-control" name="sectiontitle" id="sectiontitle" lang="ar" placeholder=" عنوان الفصل "
                               dir="rtl"
                        >
                    </div>
                    <div class="form-group">
                        <label class="right" dir="rtl" for="articletitle">عنوان المادة </label>
                        <input type="text" lang="ar" {{old('articletitle')}} class="form-control" name="articletitle" id="articletitle"
                               placeholder="عنوان المادة" dir="rtl"  >
                    </div>
                    <div class="form-group">
                        <label dir="rtl" class="right" for="articleno"> رقم المادة</label>
                        <input type="text" class="form-control" name="articleno" lang="ar" id="articleno" placeholder="رقم المادة" dir="rtl"
                               required
                        >
                    </div>
                    <div class="form-group">
                        <label class="right" dir="rtl" for="articlebody"> نص المادة</label>
                        <textarea name="articlebody" id="articlebody" class="form-control" rows="8" cols="40" required
                        ></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" name="submit" value="حفظ" class=" right btn btn-primary">
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
