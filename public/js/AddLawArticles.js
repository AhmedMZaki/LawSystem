$( document ).ready(function() {
  var addArcticle = new Vue({
      el:'#formaction',
      data:{
          lawid:'',
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
          SaveData:function (id) {
              this.lawid = id;

              axios.post('/law/addLawArticles/store', {
                  lawid:id,
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
                      // alert(response.data.message);
                      toastr.options.closeButton = true;

                      toastr.success(response.data.message," المادة رقم "+art,{timeOut: 6000});
                  } else {

                  }
              })
                  .catch(function (error) {
                      toastr.options.closeButton = true;

                      toastr.error("هذه المادة موجودة بالفعل","  المادة رقم "+art,{timeOut: 6000});
                  });
              art = this.articleno;
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
});
