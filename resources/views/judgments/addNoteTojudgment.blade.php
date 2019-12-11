@extends('layouts.master')

@section('title')
    إضافة المبدأ والموجز
@endsection

@section('stylesheets')
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico" /> -->
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
                            <li>الاحكام</li>
                            <li>اضافة مبدأ</li>
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
                    <div class="panel panel-default no-brdr" id="formaction">

                        <form method="post"
                              action="{{route('saveNote',['judgmentID'=>$judgmentID])}}"
                              enctype="multipart/form-data"
                              @submit.prevent="SaveData({{json_encode($judgmentID)}})"
                        >
                            @csrf
                            <div class="col-md-6 float-right">
                                <div class="form-row">
                                    <div class="form-group col-md-12">

                                        <div class="form-group">
                                            <label>الموجز</label>
                                            <textarea class="form-control rounded-0" rows="4"
                                                      name="judgshort" id="judgshort"
                                                      v-model="judgshort"
                                                      required
                                            ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>المبدأ</label>
                                            <textarea class="form-control rounded-0" rows="4"
                                                      name="judgrule" id="judgrule" required
                                                      v-model="judgrule"
                                            ></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputAddress">المواد المرتبطة</label>

                                            <select class="SelectWithSearch full-width" multiple="multiple">

                                            </select>

                                        </div>


                                        {{-- /////////////// --}}
                                    </div>

                                </div>
                                <button type="
                      " data-dismiss="modal" class="btn general_btn btn_1">حفظ</button>
                                <a href="{{route('addJudgments')}}" class="btn general_btn btn_1">الرجوع</a>

                            </div>

                            <div class="col-md-6 float-right">

                                <iframe id="myFrame" style="display:none" width="100%" height="400"></iframe>
                                @foreach ($files as $filename)
                                    <div class="radio">
                                        <label><input type="radio" name="pdf"
                                                      onclick="openPdf({{json_encode($filename)}})"> 12-11-2019 </label>
                                    </div>
                                @endforeach
                            </div>
                        </form>
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
    <script src="{{asset('lawSystem/assets/js/select2.min.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/jquery.toast.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/users.js')}}"></script>
    <script src="{{asset('lawSystem/assets/js/alertfunction.js')}}"></script>
    <script src="{{asset('js/vue.js')}}"></script>
    <script src="{{asset('js/axios.js')}}"></script>
    <script>
        const judgmentNotes = new Vue({
            el: '#formaction',
            data: {
                articleNo: '',
                judgmentID: '',
                judgshort: '',
                judgrule: '',
                lawArticles: [],
            },
            methods: {
                //s2id_autogen2
                SaveData: function (judgment_id) {
                    this.judgmentID = judgment_id;
                    var selected = new Array();
                    let selectedArticle = document.getElementsByName('selectedArticle');
                    for (var i = 0; i < selectedArticle.length; i++) {
                        selected.push(selectedArticle[i].value);
                    }
                    this.lawArticles = selected;

                    axios.post('/judgments/saveNotes/store', {
                        judgment_id: judgment_id,
                        judgrule: this.judgrule,
                        judgshort: this.judgshort,
                        lawarticles: this.lawArticles,
                    }).then(function (response) {
                        console.log(response.data);
                    });
                    this.judgshort = "";
                    this.judgrule = "";

                },
                SearchForData: function () {

                    axios.get("/judgments/getArticles/" + this.articleNo, {})
                        .then(function (response) {

                            if (response.data) {

                                var element = document.getElementById('coming');
                                for (var i = 0; i < response.data.length; i++) {
                                    var li = document.createElement("li");
                                    li.setAttribute('value', response.data[i]['articleId']);
                                    li.setAttribute('id', response.data[i]['articleId']);
                                    li.setAttribute('name', 'selectedArticle');
                                    li.setAttribute("class", "list-group-item alert alert-info ");
                                    li.addEventListener('click', function (e) {
                                        element.innerHTML = "";
                                    });
                                    li.innerHTML = response.data[i]['info'];
                                    element.append(li);

                                }
                            }
                        });

                }

            },
            computed: {},
            created() {

            },
            mounted() {
                axios.defaults.headers.common['X-CSRF-TOKEN']
                    = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            }
        });
    </script>
    <script type="text/javascript">
        function openPdf(file) {
            let filename = "/storage/unFinished_Notes/" + file;
            var omyFrame = document.getElementById("myFrame");
            omyFrame.style.display = "block";
            omyFrame.src = filename;
        }

    </script>
    </body>
@endsection
