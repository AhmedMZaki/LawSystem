<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  </head>
  <body>


    <div id="app2">
        <input type="search" name="search" id="search" v-model="articleNo" @keyup="SearchForData" placeholder="ابحث عن مادة">
        <ul id="ul">

        </ul>
    </div>
    <script>
    new Vue({
      el:'#app2',
      data:{
        articleNo:''
      },
      methods:{
        SearchForData:function () {

            axios.get("/searchArticle/"+this.articleNo, {

                      })
                      .then(function (response) {

                        if (response.data) {
                        for (var i = 0; i < response.data.length; i++) {
                          li = document.createElement("li");
                           a = document.createElement("a");
                          a.setAttribute('href','localhost:8000');
                          a.innerHTML="article no "+response.data[i]['articleNO']+" law category "+response.data[i]['lawCategory'];
                          li.append(a);
                          document.getElementById('ul').append(li);
                        }
                        }else{
                          console.log('there is no article with this number');
                        }
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
        },
      }
    });
    </script>

  </body>
</html>
