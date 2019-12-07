
<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/Toast.css')}}">
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
<div class="container">
    <div class="col-md-6 col-lg-6">
        <div class="form-group">
            @if (count($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div id="formaction">
            <form method="post" action="{{route('storeNotes')}}"  @submit.prevent="SaveData({{$judgmentid->id}})">
                @csrf
                <div class="form-group">
                    <label class="right" dir="rtl" for="judgrule">المبدأ</label>
                    <textarea name="judgrule" id="judgrule" class="form-control" rows="8" cols="40" required
                             {{old('judgrule')}} v-model="judgrule"></textarea>
                </div>
                <div class="form-group">
                    <label class="right" dir="rtl" for="judgshort">الموجز</label>
                    <textarea name="judgshort" id="judgshort" class="form-control" rows="8" cols="40" required
                             {{old('judgshort')}} v-model="judgshort"></textarea>
                </div>
                <div class="form-group">
                    المادةرقم 1
                    <input type="checkbox" value="1" name="lawarticles">
                    المادةرقم 2
                    <input type="checkbox" value="2" name="lawarticles">
                    المادةرقم 3
                    <input type="checkbox" value="3" name="lawarticles">
                    المادةرقم 4
                    <input type="checkbox" value="4" name="lawarticles">
                    المادةرقم 5
                    <input type="checkbox" value="5" name="lawarticles">
                    المادة رقم 6
                    <input type="checkbox" value="6" name="lawarticles">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="حفظ" class=" right btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const judgmentNotes =  new Vue({
        el:'#formaction',
        data:{
            judgmentID:'',
            judgshort:'',
            judgrule:'',
            lawArticles:[],
        },
        methods:{
            SaveData:function (judgment_id) {
                this.judgmentID = judgment_id;
                let selected = new Array();
                $("input:checkbox[name=lawarticles]:checked").each(function(){
                    selected.push($(this).val());
                });
                this.lawArticles = selected;

                axios.post('/judgments/saveNotes/store', {
                    judgment_id:judgment_id,
                    judgrule:this.judgrule,
                    judgshort:this.judgshort,
                    lawarticles:this.lawArticles,
                }).then(function (response) {
                        console.log(response.data);
                });
                this.judgshort="";
                this.judgrule="";

            }
        },
        computed:{

        },
        created(){

        },
        mounted(){
            axios.defaults.headers.common['X-CSRF-TOKEN']
                = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }
    });
</script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/Toast.js')}}"></script>
</body>
</html>
