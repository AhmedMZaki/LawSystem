@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header right">اضافة قانون جديد</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form method="post" action="{{route('saveLaw')}}"  enctype="multipart/form-data">
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
                                <label class="right" dir="rtl" for="lawtype">نوع القانون</label>
                                <select class="form-control" id="lawtype" name="lawtype" required>
                                    <option dir="rtl" value="قانون">قانون</option>
                                    <option dir="rtl" value="مرسوم">مرسوم</option>
                                    <option dir="rtl" value="قرار">قرار</option>
                                    <option dir="rtl" value="مقترح">مقترح</option>
                                    <option dir="rtl" value="المذكرة الأنضباطية">المذكرة الأنضباطية</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="right" dir="rtl" for="lawcategory">تصنيف القانون</label>
                                <select class="form-control" id="lawcategory" name="lawcategory" required>
                                    <option value="دستورى">دستورى</option>
                                    <option value="جنائي">جنائي</option>
                                    <option value="أحوال ">أحوال</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="right" dir="rtl" for="lawno">رقم القانون</label>
                                <input type="text" class="form-control" name="lawno" id="lawno" lang="ar" placeholder="رقم القانون"
                                       dir="rtl" required
                                    {{old('lawno')}}
                                >
                            </div>
                            <div class="form-group">
                                <label class="right" dir="rtl" for="lawyear">لسنة </label>
                                <input type="text" lang="ar" class="form-control" name="lawyear" id="lawyear" placeholder="سنة الأصدار" dir="rtl" required {{old('lawyear')}}>
                            </div>
                            <div class="form-group">
                                <label dir="rtl" class="right" for="lawrelation"> بشأن</label>
                                <input type="text" class="form-control" name="lawrelation" lang="ar" id="lawrelation" placeholder="القانون يخص" dir="rtl" required
                                    {{old('lawrelation')}}
                                >
                            </div>
                            <div class="form-group">
                                <label dir="rtl" class="right" for="lawfile"> تحميل مستند القانون </label>
                                <input type="file" id="lawfile" name="lawfile" accept="application/pdf">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" name="submit" value="حفظ" class=" right btn btn-primary">
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
