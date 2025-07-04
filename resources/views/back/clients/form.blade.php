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
                        
                        {{--<div class="col-lg-1 col-md-4">
                            <label for="code">كود العميل</label>
                            <div>
                                <input type="text" readonly class="form-control" id="code" name="code" value="{{ ($latestId) }}" style="font-size: 17px;">
                            </div>
                            <bold class="text-danger" id="errors-code" style="display: none;"></bold>
                        </div>--}}

                        <div class="col-lg-2 col-md-8">
                            <label for="client_supplier_type">نوع العميل</label>
                            <div>
                                <select id="client_supplier_type" name="client_supplier_type" class="form-control">
                                    <option value="3">عميل</option>
                                    <option value="4">عميل داخلي</option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-client_supplier_type" style="display: none;"></bold>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="name">اسم العميل</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="text" class="form-control dataInput" placeholder="اسم العميل" id="name" name="name">
                            </div>
                            <bold class="text-danger" id="errors-name" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="phone">موبايل العميل</label>
                            <div>
                                <input type="number" class="form-control dataInput numValid" placeholder="موبايل العميل" id="phone" name="phone">
                            </div>
                            <bold class="text-danger" id="errors-phone" style="display: none;"></bold>
                        </div>
                    
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="status">حالة العميل</label>
                            <div>
                                <select id="status" name="status" class="form-control">
                                    <option value="1">نشط</option>
                                    <option value="0">غير نشط</option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-status" style="display: none;"></bold>
                        </div>

                        <div class="col-lg-2 col-md-12">
                            <label for="type_payment">
                                طريقة التعامل
                                <i class="fas fa-info-circle text-danger" data-bs-toggle="tooltip" title="⚠️ عند اختيارك لطريقة التعامل بالآجل، سيكون العميل قادراً على استلام السلع والخدمات دون سداد قيمتها في الوقت الحالي. يُرجى التأكد من أهلية العميل لهذا النوع من التعامل."></i>
                            </label>
                            <div>
                                <select id="type_payment" name="type_payment" class="form-control">
                                    <option value="" selected disabled>اختر طريقة تعامل</option>
                                    <option value="كاش">كاش</option>
                                    <option value="آجل">آجل</option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-type_payment" style="display: none;"></bold>
                        </div>
                    </div>
                    
                    <div class="row row-xs">                       

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="email">ايميل العميل</label>
                            <div>
                                <input type="email" class="form-control dataInput" placeholder="ايميل العميل" id="email" name="email">
                            </div>
                            <bold class="text-danger" id="errors-email" style="display: none;"></bold>
                        </div>

                        <div class="col-lg-5 col-md-12">
                            <label for="address">عنوان العميل</label>
                            <div>
                                <input type="text" class="form-control dataInput" placeholder="عنوان العميل" id="address" name="address">
                            </div>
                            <bold class="text-danger" id="errors-address" style="display: none;"></bold>
                        </div>

                        <div class="col-lg-4">
                            <label for="note">ملاحظات</label>
                            <div>    
                                <input type="text" class="form-control dataInput" placeholder="ملاحظات" id="note" name="note">
                            </div>
                            <bold class="text-danger" id="errors-note" style="display: none;"></bold>
                        </div>
                    </div>
                    
                    
                    <hr>
                    <div class="row row-xs justify-content-center" id="hide_cash" style="display: none;">                        

                        <div class="col-lg-3 col-md-6 col-sm-12" id="debtor_max">
                            <label for="debit_limit">
                                الحد الآقصي لـ مدين (عليه)
                                <i class="fas fa-info-circle text-danger" data-bs-toggle="tooltip" title="⚠️ الحد الأقصى المسموح به لمديونية العميل مقابل مسحوباته يُرجى مراجعة حد المديونية المسموح به قبل إتمام عملية الحفظ."></i>
                            </label>
                            <div>    
                                <input type="text" class="form-control dataInput numValid focused hide_cash" placeholder="الحد الآقصي لـ مدين (عليه)" id="debit_limit" name="debit_limit">
                            </div>
                            <bold class="text-danger" id="errors-debit_limit" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-12"  id="debtor_value">
                            <label for="money_on_him">مدين (عليه)
                                <i class="fas fa-info-circle text-danger" data-bs-toggle="tooltip" title="💳 هذا الحقل مخصّص لإدخال الرصيد الافتتاحي للعميل في حال كان عليه مبلغ مالي مستحق (مدين) لصالحك. مثال: إذا كان على العميل 300 جنيه، أدخل:"></i>

                            </label>
                            <div>    
                                <input type="text" class="form-control dataInput numValid focused hide_cash" placeholder="مدين (عليه)" id="money_on_him" name="money_on_him">
                            </div>
                            <bold class="text-danger" id="errors-money_on_him" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-3 col-md-12" id="creditor_value">
                            <label for="money_for_him">دائن (له)
                                <i class="fas fa-info-circle text-danger" data-bs-toggle="tooltip" title="💰 هذا الحقل مخصّص لإدخال الرصيد الافتتاحي للعميل في حال كان له مبلغ مالي مستحق (دائن) عندك. مثال: إذا كان للعميل 500 جنيه، أدخل: 500"></i>

                            </label>
                            <div>    
                                <input type="text" class="form-control dataInput numValid focused hide_cash" placeholder="دائن (له)" id="money_for_him" name="money_for_him">
                            </div>
                            <bold class="text-danger" id="errors-money_for_him" style="display: none;"></bold>
                        </div>
                       
                    </div>
                    
                    <hr>

                    <div class="row row-xs">                        
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="commercial_register">ك السجل التجاري</label>
                            <div>    
                                <input type="text" class="form-control dataInput" placeholder="ك السجل التجاري" id="commercial_register" name="commercial_register">
                            </div>
                            <bold class="text-danger" id="errors-commercial_register" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="tax_card">ك البطاقة الضريبية</label>
                            <div>    
                                <input type="text" class="form-control dataInput" placeholder="ك البطاقة الضريبية" id="tax_card" name="tax_card">
                            </div>
                            <bold class="text-danger" id="errors-tax_card" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="vat_registration_code">ك التسجيل ض.ق.م</label>
                            <div>    
                                <input type="text" class="form-control dataInput" placeholder="ك التسجيل ض.ق.م" id="vat_registration_code" name="vat_registration_code">

                            </div>
                            <bold class="text-danger" id="errors-vat_registration_code" style="display: none;"></bold>
                        </div>                        
                        
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="name_of_commissioner">اسم المفوض</label>
                            <div>    
                                <input type="text" class="form-control dataInput" placeholder="اسم المفوض" id="name_of_commissioner" name="name_of_commissioner">
                            </div>
                            <bold class="text-danger" id="errors-name_of_commissioner" style="display: none;"></bold>
                        </div>
                        
                        <div class="col-lg-3 col-md-12">
                            <label for="phone_of_commissioner">تليفون المفوض</label>
                            <div>    
                                <input type="text" class="form-control dataInput numValid" placeholder="تليفون المفوض" id="phone_of_commissioner" name="phone_of_commissioner">
                            </div>
                            <bold class="text-danger" id="errors-phone_of_commissioner" style="display: none;"></bold>
                        </div>                                          
                    </div>

                    <div class="row row-xs">
                        <div class="col-lg-8">
                            <div class="custom-file-container fileinput_fileinput" data-upload-id="file_upload" style="margin-top: 12px;">
                                <label style="color: #555;"> صورة
                                    <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">
                                        <i class="fa fa-trash-alt" style="color: rgb(221, 7, 7);font-size: 15px;position: relative;top: 3px;margin: 0px 15px 10px;"></i>
                                    </a>
                                </label>
                                <label class="custom-file-container__custom-file" >
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" name="image">
                                    <input type="hidden" name="image_hidden" id="image_hidden" />
                                    <span class="custom-file-container__custom-file__custom-file-control text-center" style="background: #fff;font-size: 12px;"></span>
                                </label>
                                <div class="custom-file-container__image-preview" style="position: relative;top: -48px;"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <img id="image_preview_form" class="img-responsive img-thumbnail" src="{{ url('back/images/df_image.png') }}" />
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
