<!-- start footer -->
<footer class="main-footer">
   <div class="row">
     <div class="col-lg-6 text-center text-lg-right pr-1">
      <img src="{{asset('lawSystem/assets/images/flogo.png')}}" width="24"  style="float:right;width: 64px;height: 20px;margin-left: 5px;"  class="footerlogo" /> <p> اسم المشروع </p>
     </div>
     <div class="col-lg-6 text-center text-lg-left pl-1">
       <img src="{{asset('lawSystem/assets/images/nlogo2.png')}}" width="24" style="float:left;" class="nlogo" /> <p>شركة نوسف لنظم المعلومات والكمبيوتر</p>
     </div>
   </div>
 </footer>
<!-- end footer -->

<!-- print page Modal -->
<div class="modal" id="print-modal">
 <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
   <div class="modal-content">
     <div class="modal-header pl-0">
       <h5 class="modal-title">طباعة</h5>
       <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">

     </div>
   </div>
 </div>
</div>

<!-- new user Modal -->
<div class="modal" id="ModalAddUser">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header pl-0">
         <h5 class="modal-title">اضافة مستخدم جديد</h5>
         <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
           <form>
               <div class="form-row">
                 <div class="form-group col-md-6">
                   <label>اسم المستخدم <span class="redstar">*</span></label>
                   <input type="text" class="form-control" placeholder="اسم المستخدم">
                 </div>
                 <div class="form-group col-md-6">
                   <label>البريد الالكترونى</label>
                   <input type="email" class="form-control" placeholder="البريد الالكترونى">
                 </div>
               </div>
               <div class="form-row">
                 <div class="form-group col-md-6">
                   <label>الاسم الاول</label>
                   <input type="text" class="form-control" placeholder="الاسم الاول">
                 </div>
                 <div class="form-group col-md-6">
                   <label>الاسم الاخير</label>
                   <input type="text" class="form-control" placeholder="الاسم الاخير">
                 </div>
               </div>
               <div class="form-row">
                 <div class="form-group col-md-6">
                   <label>كلمة المرور <span class="redstar">*</span></label>
                   <input type="password" class="form-control" placeholder="كلمة المرور">
                 </div>
                 <div class="form-group col-md-6">
                   <label>تأكيد كلمة المرور <span class="redstar">*</span></label>
                   <input type="password" class="form-control" placeholder="تأكيد كلمة المرور">
                 </div>
               </div>
               <div class="form-row">
                 <div class="form-group col-md-6">
                   <label>رقم الهاتف</label>
                   <input type="tel" class="form-control" placeholder="رقم الهاتف">
                 </div>
                 <div class="form-group col-md-6">
                   <label>الصلاحية <span class="redstar">*</span></label>
                   <select class="form-control">
                     <option selected>الصلاحية</option>
                     <option>مندوب</option>
                   </select>
                 </div>
               </div>

               <div class="form-group">
                 <label for="inputAddress">المجموعات التى يستطيع المستخدم الاطلاع عليها</label>

                 <select class="SelectWithSearch full-width" multiple="multiple">
                     <option value="36">محامين</option>
                     <option value="45">مهندسين</option>
                     <option value="66">اطباء</option>
                   </select>

               </div>
               <div class="form-group">
                 <label for="inputAddress2">اللجان</label>

                 <select class="SelectWithSearch full-width" multiple="multiple">
                     <option value="1">ثانوية بيبي السالم الصباح للبنات</option>
                     <option value="55">مدرسة امنه الابتدائيه للبنات</option>
                     <option value="96">ثانوية أحمد البشر الرومي للبنين</option>
                     <option value="96">مدرسة ابن سينا الابتدائية للبنين</option>
                     <option value="96">مدرسة مهلهل محمد المضف  المتوسطة للبنين</option>

                   </select>

               </div>

               <button type="submit" class="btn general_btn btn_1" data-dismiss="modal">اغلاق</button>
               <button type="submit" onclick="return toast('عملية ناجحة','تم تعديل المستخدم','success')"  data-dismiss="modal" class="btn general_btn btn_1">حفظ</button>
             </form>
       </div>
     </div>
   </div>
 </div>
<!-- edit user Modal -->
<div class="modal" id="ModalEditUser">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header pl-0">
         <h5 class="modal-title">تعديل اسم المستخدم</h5>
         <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
           <form>
               <div class="form-row">
                 <div class="form-group col-md-6">
                   <label>اسم المستخدم <span class="redstar">*</span></label>
                   <input type="text" class="form-control" placeholder="اسم المستخدم">
                 </div>
                 <div class="form-group col-md-6">
                   <label>البريد الالكترونى</label>
                   <input type="email" class="form-control" placeholder="البريد الالكترونى">
                 </div>
               </div>
               <div class="form-row">
                 <div class="form-group col-md-6">
                   <label>الاسم الاول</label>
                   <input type="text" class="form-control" placeholder="الاسم الاول">
                 </div>
                 <div class="form-group col-md-6">
                   <label>الاسم الاخير</label>
                   <input type="text" class="form-control" placeholder="الاسم الاخير">
                 </div>
               </div>
               <div class="form-row">
                 <div class="form-group col-md-6">
                   <label>رقم الهاتف</label>
                   <input type="tel" class="form-control" placeholder="رقم الهاتف">
                 </div>
               </div>

               <div class="form-group">
                 <label for="inputAddress">المجموعات التى يستطيع المستخدم الاطلاع عليها</label>

                 <select class="SelectWithSearch full-width" multiple="multiple">
                     <option value="36">محامين</option>
                     <option value="45">مهندسين</option>
                     <option value="66">اطباء</option>
                   </select>

               </div>
               <button  class="btn general_btn btn_1" onclick="return toast('عملية ناجحة','تم تعديل المستخدم','success')" data-dismiss="modal">اغلاق</button>
               <button  onclick="return toast('عملية ناجحة','تم تعديل المستخدم','success')" data-dismiss="modal" class="btn general_btn btn_1">حفظ</button>
             </form>
       </div>
     </div>
   </div>
 </div>
