@extends('layouts.master')

@section('title')
  الأحكام
@endsection

@section('stylesheets')
  <!-- <link rel="shortcut icon" href="assets/images/favicon.ico" /> -->
  <link rel="stylesheet" href="{{asset('lawSystem/assets/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('lawSystem/assets/css/bootstrap.min.css')}}" />
  <link rel="stylesheet" href="{{asset('lawSystem/assets/css/main.css')}}" />
  <link rel="stylesheet" href="{{asset('lawSystem/assets/css/select2.min.css')}}" />
  <link rel="stylesheet" href="{{asset('lawSystem/assets/css/icons.css')}}" />
  <link rel="stylesheet" href="{{asset('lawSystem/assets/css/jquery.toast.css')}}" />
<style>
.table-right td
{
  text-align: center;
}
.general_btn {
  margin-right: -4px;
}
</style>

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
                <li><a href="{{route('getJudgments')}}">الأحكام</a></li>
              </ol>
            </div>
            </div>

            <template id="alert_template">
                  <div :class="alertClasses" v-show="show">
                      <slot></slot>
                      <span class="alert_close" @click="show=false">X</span>
                  </div>
              </template>
            <div class="col-lg-6">
              <div class="navbar d-flex flex-wrap align-items-center justify-content-start justify-content-lg-end rec-counts">
                <a href="{{route('addJudgments')}}">
                  <button  class="general_btn btn_1 ml-2">
                      <i class="plus-icon btn-icon-width inline-icon green-icon"></i><span>اضافة جديد</span>
                    </button>
                  </a>
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
                          <th class="w_40 pr-2">م</th>
                          <th class="w_170 text-center">التصنيف</th>
                          <th class="w_100 text-center">

تاريخ الجلسة</th>
                          <th class="w_200 text-center">سنة الاصدار</th>
                          <th class="w_70 text-center">رقم الطعن</th>
                          <th class="w_70 text-center">عدد المبادئ *</th>
                          <th class="w_120 text-center">غير مكتمل</th>
                          <th class="w_70 text-center">إضافة مبدأ</th>
                          <th class="w_70 text-center">تعديل</th>
                          <th class="w_70 text-center">حذف</th>
                        </tr>
                      </thead>
                      <tbody>

                        @if (count($judgments))
                          @foreach ($judgments as $judgment)
                            <tr>
                              <td>{{$judgment->id}}</td>
                              <td>{{$judgment->judgmentcategory}}</td>
                              <td>{{$judgment->judgmentDate}}</td>
                              <td>{{$judgment->year}}</td>
                              <td>{{$judgment->objectionNo}} </td>
                              <td>{{$judgment->notes}} </td>
                              <td>{{$judgment->incompletednotes}} </td>
                              <td>
                                <a href="#" class="btn general_btn btn_1"
                                  >
                                   إضافة مبادئ
                                <img src="{{asset('lawSystem/assets/images/plus.svg')}}" width="20px" height="20px">
                                </a>
                              </td>
                              <td>

                                <a href="#" class="btn general_btn btn_1"
                                  >
                                  تعديل
                                  <img src="{{asset('lawSystem/assets/images/edit.svg')}}" alt="">

                                </a>
                              </td>
                              <td>
                                <form  action="" method="post" >

                                  @csrf
                                  @method('DELETE')
                                  <button type="submit"
                                  onclick="return confirm(();" name="submit"
                                  class="btn general_btn btn_1"
                                  style="height:28px;"
                                  >
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

@endsection

@section('secripts')
  <!-- end main-wrapper -->
  <script src="{{asset('lawSystem/assets/js/jquery.js')}}"></script>
  <script>
      $(function(){
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
  <scirp></scirp>
</body>
@endsection
