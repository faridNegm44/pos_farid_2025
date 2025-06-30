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
                <input type="hidden" id="res_id" value="" />               

                <div class="pd-30 pd-sm-40 bg-gray-100">
                    <div class="row row-xs">
                        <div class="col-md-3">
                            <label for="name">اسم المستخدم</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="text" class="form-control dataInput" placeholder="اسم المستخدم" id="name" name="name">
                            </div>
                            <bold class="text-danger" id="errors-name" style="display: none;"></bold>
                        </div>

                        <div class="col-md-3">
                            <label for="email">البريد الإلكتروني</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="email" class="form-control dataInput" placeholder="مهم جدا لتسجيل الدخول" id="email" name="email">
                            </div>
                            <bold class="text-danger" id="errors-email" style="display: none;"></bold>
                        </div>

                        <div class="col-md-3">
                            <label for="password">كلمة المرور</label>
                            <i class="fas fa-star require_input"></i>
                            <div style="position: relative;">
                                <input type="password" class="form-control dataInput" placeholder="كلمة المرور" id="password" name="password">
                                <i class="fa fa-eye show_pass" style="position: absolute;top: 8px;left: 10px;font-size: 16px;cursor: pointer;"></i>
                            </div>
                            <bold class="text-danger" id="errors-password" style="display: none;"></bold>
                        </div>

                        <div class="col-md-3">
                            <label for="confirmed_password">تاكيد كلمة المرور</label>
                            <i class="fas fa-star require_input"></i>
                            <div style="position: relative;">
                                <input type="password" class="form-control dataInput" placeholder="تاكيد كلمة المرور" id="confirmed_password" name="confirmed_password">
                                <i class="fa fa-eye show_pass" style="position: absolute;top: 8px;left: 10px;font-size: 16px;cursor: pointer;"></i>
                            </div>
                            <bold class="text-danger" id="errors-confirmed_password" style="display: none;"></bold>
                        </div>

                    </div>
                    
                    <div class="row row-xs">
                        <div class="col-md-3">
                            <label for="gender">النوع</label>
                            <div>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="ذكر">ذكر</option>
                                    <option value="انثي">انثي</option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-gender" style="display: none;"></bold>
                        </div>

                        <div class="col-md-3">
                            <label for="phone">رقم التليفون</label>
                            {{--<i class="fas fa-star require_input"></i>--}}
                            <div>
                                <input type="number" class="form-control dataInput" placeholder="رقم التليفون" id="phone" name="phone">
                            </div>
                            <bold class="text-danger" id="errors-phone" style="display: none;"></bold>
                        </div>

                        <div class="col-md-3">
                            <label for="nat_id">الرقم القومي</label>
                            {{--<i class="fas fa-star require_input"></i>--}}
                            <div>    
                                <input type="number" class="form-control dataInput" placeholder="الرقم القومي" id="nat_id" name="nat_id">
                            </div>
                            <bold class="text-danger" id="errors-nat_id" style="display: none;"></bold>
                        </div>
                       
                        <div class="col-md-3">
                            <label for="status">الحالة</label>
                            <div>    
                                <select name="status" id="status" class="form-control">
                                    <option value="1">نشط</option>
                                    <option value="0">معطل</option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-status" style="display: none;"></bold>
                        </div>
                        
                    </div>


                    <div class="row row-xs">                        
                        <div class="col-md-3">
                            <label for="role">التراخيص</label>
                            <i class="fas fa-star require_input"></i>
                            <div>    
                                <select name="role" id="role" class="form-control">
                                    @foreach ($permissions as $item)
                                        <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-role" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="birth_date">تاريخ الميلاد</label>
                            {{--<i class="fas fa-star require_input"></i>--}}
                            <div>    
                                <input type="date" class="form-control dataInput" id="birth_date" name="birth_date">
                            </div>
                            <bold class="text-danger" id="errors-birth_date" style="display: none;"></bold>
                        </div>

                        <div class="col-md-6">
                            <label for="address">العنوان </label>
                            {{--<i class="fas fa-star require_input"></i>--}}
                            <div>    
                                <input type="text" class="form-control dataInput" placeholder="العنوان " id="address" name="address">
                            </div>
                            <bold class="text-danger" id="errors-address" style="display: none;"></bold>
                        </div>                        
                    </div>
                    
                    <div class="row row-xs">
                        <div class="col-md-8" id="file_upload">
                            <div class="custom-file-container fileinput_fileinput" data-upload-id="file_upload" style="margin-top: 12px;">
                                <label style="color: #555;"> صورة
                                    <a href="javascript:void(0)" class="custom-file-container__image-clear clear_image" title="Clear Image">
                                        <i class="fa fa-trash-alt" style="color: rgb(221, 7, 7);font-size: 15px;position: relative;top: 3px;margin: 0px 15px 10px;"></i>
                                    </a>
                                </label>
                                <label class="custom-file-container__custom-file" >
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input dataInput" name="image">
                                    <input type="hidden" name="image_hidden" id="image_hidden"/>
                                    <span class="custom-file-container__custom-file__custom-file-control heading_title text-center" style="background: #fff;font-size: 12px;"></span>
                                </label>

                                <div id="custom-file-container__image-preview">
                                    <div class="custom-file-container__image-preview" style="position: relative;top: -48px;"></div>
                                </div>
                                <bold class="text-danger" id="errors-image" style="display: none;position: relative;top: -60px;"></bold>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-xs-12">
                            <img id="image_preview_form" class="img-responsive img-thumbnail" src="{{ url('back/images/users/df_image.png') }}" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">                                               
                    <button type="button" id="save" class="btn btn-primary btn-rounded" style="display: none;">
                      حفظ
                      <span class="spinner-border spinner-border-sm spinner_request" role="status" aria-hidden="true"></span>
                    </button>
  
                    <button type="button" id="update" class="btn btn-success btn-rounded" style="display: none;">
                      تعديل
                      <span class="spinner-border spinner-border-sm spinner_request2" role="status" aria-hidden="true"></span>
                    </button>
                    
                    <button id="closeModal" type="button" class="btn btn-outline-secondary btn-rounded" data-dismiss="modal">اغلاق</button>
                </div> 

            </form>            
        </div>
      </div>
    </div>
</div>
