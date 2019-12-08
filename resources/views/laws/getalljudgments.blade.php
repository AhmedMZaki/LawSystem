
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
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
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
                    <li class=" alert alert-info" style="list-style-type: none;text-align: justify">
                        الاحكام
                    </li>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">التصنيف</th>
                        <th scope="col">تاريخ الجلسة</th>
                        <th scope="col">السنة</th>
                        <th scope="col">رقم الطعن</th>
                        <th scope="col">عدد المبادئ</th>
                        <th scope="col"> عدد المبادى الغير مكتملة </th>
                        <th scope="col">نص الحكم </th>
                        <th scope="col">اضافة مبادئ</th>
                        <th scope="col">تعديل الحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($judgments as $judgment)
                        <tr>
                            <th scope="row">{{$judgment->id}}</th>
                            <td>{{$judgment->judgmentcategory}}</td>
                            <td>{{$judgment->judgmentDate}}</td>
                            <td>{{$judgment->year}}</td>
                            <td>{{$judgment->objectionNo}}</td>
                            <td>{{$judgment->notes}}</td>
                            <td>{{$judgment->incompletednotes}}</td>
                            <td>
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModalScrollable">
                                    نص الحكم
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <object width="350" height="350" data="{{asset('storage/Finished_Judgments/'.$judgment->judgmentFile)}}">
                                                </object>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <a href="{{route('Judgmentaddnotes',['judgmentid'=>$judgment->id])}}" class="btn btn-outline-primary">اضافة مبادئ الحكم</a>
                            </td>

                            <td>
                                <a href="#" class="btn btn-outline-primary">  تعديل الحكم </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
