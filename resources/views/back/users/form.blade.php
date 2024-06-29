<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            <form class="" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="row_id" value="" />               

                <div class="pd-30 pd-sm-40 bg-gray-100">
                    <div class="row row-xs">
                        <div class="col-md-4">
                            <label for="login_name">اسم المستخدم</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="text" class="form-control" placeholder="مهم جدا لتسجيل الدخول" id="login_name" name="login_name">
                            </div>
                            <bold class="text-danger" id="errors-user_name" style="display: none;"></bold>
                        </div>

                        <div class="col-md-4">
                            <label for="email">البريد الإلكتروني</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="email" class="form-control" placeholder="مهم جدا لتسجيل الدخول" id="email" name="email">
                            </div>
                            <bold class="text-danger" id="errors-email" style="display: none;"></bold>
                        </div>

                        <div class="col-md-4">
                            <label for="gender">النوع</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <select id="gender" name="gender" class="selectize">
                                    <option value="ذكر">ذكر</option>
                                    <option value="انثي">انثي</option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-gender" style="display: none;"></bold>
                        </div>

                    </div>
                    
                    <div class="row row-xs">
                        <div class="col-md-4">
                            <label for="phone">رقم التليفون</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="number" class="form-control" placeholder="رقم التليفون" id="phone" name="phone">
                            </div>
                            <bold class="text-danger" id="errors-phone" style="display: none;"></bold>
                        </div>

                        <div class="col-md-4">
                            <label for="password">كلمة المرور</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="password" class="form-control" placeholder="كلمة المرور" id="password" name="password">
                            </div>
                            <bold class="text-danger" id="errors-password" style="display: none;"></bold>
                        </div>
                        <div class="col-md-4">
                            <label for="confirmed_password">تاكيد كلمة المرور</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="password" class="form-control" placeholder="تاكيد كلمة المرور" id="confirmed_password" name="confirmed_password">
                            </div>
                            <bold class="text-danger" id="errors-confirmed_password" style="display: none;"></bold>
                        </div>
                    </div>

                    <hr>

                    <div class="row row-xs">                        
                        <div class="col-md-4">
                            <label for="birth_date">تاريخ الميلاد</label>
                            <i class="fas fa-star require_input"></i>
                            <div>    
                                <input type="date" class="form-control" id="birth_date" name="birth_date">
                            </div>
                            <bold class="text-danger" id="errors-birth_date" style="display: none;"></bold>
                        </div>

                        <div class="col-md-4">
                            <label for="nat_id">الرقم القومي</label>
                            <i class="fas fa-star require_input"></i>
                            <div>    
                                <input type="number" class="form-control" placeholder="الرقم القومي" id="nat_id" name="nat_id">
                            </div>
                            <bold class="text-danger" id="errors-nat_id" style="display: none;"></bold>
                        </div>
                       
                        <div class="col-md-4">
                            <label for="status">الحالة</label>
                            <div>    
                                <select  name="status" class="status">
                                    <option value="1">نشط</option>
                                    <option value="0">غير نشط</option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-status" style="display: none;"></bold>
                        </div>

                        <div class="col-md-12">
                            <label for="address">العنوان </label>
                            <i class="fas fa-star require_input"></i>
                            <div>    
                                <input type="text" class="form-control" placeholder="العنوان " id="address" name="address">
                            </div>
                            <bold class="text-danger" id="errors-address" style="display: none;"></bold>
                        </div>                        
                    </div>
                    
                    <div class="row row-xs">
                        <div class="col-md-12">
                            <div class="custom-file-container fileinput_fileinput" data-upload-id="file_upload" style="margin-top: 12px;">
                                <label style="color: #555;"> صورة
                                    <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">
                                        <i class="fa fa-trash-alt" style="color: rgb(221, 7, 7);font-size: 15px;position: relative;top: 3px;margin: 0px 15px 10px;"></i>
                                    </a>
                                </label>
                                <label class="custom-file-container__custom-file" >
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" name="image">
                                    <input type="hidden" name="image_hidden" />
                                    <span class="custom-file-container__custom-file__custom-file-control text-center" style="background: #fff;font-size: 12px;"></span>
                                </label>
                                <div class="custom-file-container__image-preview" style="position: relative;top: -48px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">                                               
                    <button type="button" id="save" class="btn btn-primary btn-rounded" style="display: none;">حفظ</button>
                    <button type="button" id="update" class="btn btn-success btn-rounded" style="display: none;">تعديل</button>
                    <button id="closeModal" type="button" class="btn btn-outline-secondary btn-rounded" data-dismiss="modal">اغلاق</button>
                </div> 

            </form>            
        </div>
      </div>
    </div>
</div>
