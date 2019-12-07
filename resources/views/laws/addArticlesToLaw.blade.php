@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/Toast.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 right">
            <div class="card" id="FormArticles">
            
                <div class="card-header">
                <strong>
                اضافة مواد القانون رقم 
              ({{$findedLaw->lawno}})
              </strong>
                </div>

                <div class="card-body" id="formaction">
                    <div id="ArticlesForm">
                     <div >
                      <form method="post" action="{{route('SaveArticle',['lawid'=>$findedLaw->id])}}" 
                       @submit.prevent="SaveData">
                      @csrf
                        <div class="form-group">
                          <label class="right" dir="rtl" for="subjectid">رقم الكتاب</label>
                          <input type="text" class="form-control" v-model="subjectid" name="subjectid" id="subjectid" lang="ar"
                                 placeholder="رقم الكتاب"
                                 dir="rtl">
                          <label class="right" dir="rtl" for="subjectitle">عنوان الكتاب </label>
                          <input type="text" class="form-control" name="subjectitle" id="subjectitle" lang="ar" placeholder="عنوان الكتاب "
                                 dir="rtl" v-model="subjectitle" {{old('subjectitle')}}
                          >
                          <div class="form-group">
                          <label class="right" dir="rtl" for="chapterid">رقم الباب</label>
                          <input type="text" class="form-control" name="chapterid" id="chapterid" lang="ar" placeholder=" الباب"
                                 dir="rtl" v-model="chapterid"
                          >
                          <label class="right" dir="rtl" for="chaptertitle">عنوان الباب </label>
                          <input type="text" class="form-control" name="chaptertitle" id="chaptertitle" lang="ar" placeholder="عنوان الباب "
                                 dir="rtl" v-model="chaptertitle"
                          >
                      </div>
                               <div class="form-group">
                          <label class="right" dir="rtl" for="sectionid">رقم الفصل</label>
                          <input type="text" class="form-control" name="sectionid" id="sectionid" lang="ar" placeholder=" الفصل"
                                 dir="rtl" v-model="sectionid"
                          >
                          <label class="right" dir="rtl" for="sectiontitle">عنوان الفصل </label>
                          <input type="text" class="form-control" name="sectiontitle" id="sectiontitle" lang="ar" placeholder=" عنوان الفصل "
                                 dir="rtl" v-model="sectiontitle"
                          >
                      </div>
                        <div class="form-group">
                          <label class="right" dir="rtl" for="articletitle">عنوان المادة </label>
                          <input type="text" lang="ar" v-model="articletitle" class="form-control" name="articletitle" id="articletitle"
                                 placeholder="عنوان المادة" dir="rtl"  >
                      </div>
                      <div class="form-group">
                          <label dir="rtl" class="right" for="articleno"> رقم المادة</label>
                          <input type="text" class="form-control" name="articleno" lang="ar" id="articleno" placeholder="رقم المادة" dir="rtl"
                                 required v-model="articleno"
                          >
                      </div>
                      <div class="form-group">

                          <label class="right" dir="rtl" for="articlebody"> نص المادة</label>
                          <textarea name="articlebody" v-model="articlebody" id="articlebody" class="form-control" rows="8" cols="40"
                                    required></textarea>
                      </div>
                      <div class="form-group">
                       <a href="{{route('addNewLaw')}}" class="btn btn-primary">
                              العودة 
                              </a>
                              <button type="submit" class="btn btn-primary"
                                      style="margin-right:11px;" >حفظ</button>
                             

                          </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el:'#FormArticles',
        data:{
            subjectid:'',
            subjectitle:'',
            chapterid:'',
            chaptertitle:'',
            sectionid:'',
            sectiontitle:'',
            articletitle:'',
            articleno:'',
            articlebody:'',
            errors:{},
        },

        methods:{
            SaveData:function () {
                 art = this.articleno;
                axios.post(('/law/addLawArticles/store/'+{{$findedLaw->id}}), {
                    subjectid:this.subjectid,
                    subjectitle:this.subjectitle,
                    chapterid:this.chapterid,
                    chaptertitle:this.chaptertitle,
                    sectionid:this.sectionid,
                    sectiontitle:this.sectiontitle,
                    articletitle:this.articletitle,
                    articleno:this.articleno,
                    articlebody:this.articlebody,
                }).then(function (response) {

                    if (response.data.status == 200)
                    {
                        //console.log(response.data); 
                        toastr.options.closeButton = true;
                       toastr.success(response.data.message," المادة رقم "+art,{timeOut: 5000});
                    } 
                }).catch(function (error) {
                        toastr.options.closeButton = true;

                        toastr.error("هذه المادة موجودة بالفعل","  المادة رقم "+art,{timeOut: 5000});
                    });
               
                this.articleno='';
                this.articlebody='';
            },
        },
        errors(){
            console.log();
        },

        mounted(){

            axios.defaults.headers.common['X-CSRF-TOKEN']
                = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        },

    });
</script>
<script src="{{asset('js/Toast.js')}}"></script>
@endsection
