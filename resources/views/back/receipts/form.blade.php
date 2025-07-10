<div class="modal fade exampleModalCenter" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                  <div class="col-md-12">
                      <label for="payer_type">الجهة</label>
                      <i class="fas fa-star require_input"></i>
                      <div>
                          <select name="payer_type" class="payer_type form-control" id="payer_type">
                            <option value="" selected disabled>اختر الجهة</option>                              
                            <option value="عميل">عميل</option>                              
                            <option value="مورد">مورد</option>                              
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-payer_type" style="display: none;"></bold>
                  </div> 

                  <div class="row row-xs" id="hide_section" style="display: none;">
                    <div class="col-lg-4 col-12">
                      <label for="payer_id">أشخاص الجهة</label>
                      <div>
                          <select name="payer_id" class="payer_id" id="payer_id">
                            
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-payer_id	" style="display: none;"></bold>
                    </div>  

                    <div class="col-lg-4 col-12">
                      <label for="current_remaining_money">
                        رصيد الجهة الحالي
                        <span class="text-danger" id="clientSupplierStatus" style='margin: 0 5px;'></span>
                      </label>
                      <div>
                          <input type="number" disabled class="form-control dataInput text-center" placeholder="رصيد الجهة الحالي" id="current_remaining_money" name="current_remaining_money" value="" style="font-size: 20px;">
                      </div>
                      <bold class="text-danger" id="errors-current_remaining_money" style="display: none;"></bold>
                    </div>  
                    
                    <div class="col-lg-4 col-12">
                      <label for="amount">مبلغ المطالبة</label>
                      <div>
                          <input type="number" class="form-control dataInput text-center" placeholder="مبلغ المطالبة" id="amount" name="amount" style="font-size: 20px;" />
                      </div>
                      <bold class="text-danger" id="errors-amount" style="display: none;"></bold>
                    </div>  
                    
                    <div class="col-lg-4 col-12">
                      <label for="receipt_date">تاريخ الإيصال</label>
                      <div>
                          <input type="date" class="form-control dataInput text-center datePicker" placeholder="تاريخ الإيصال" id="receipt_date" name="receipt_date" />
                      </div>
                      <bold class="text-danger" id="errors-receipt_date" style="display: none;"></bold>
                    </div>  
                    
                    <div class="col-lg-8 col-12">
                      <label for="notes">ملاحظات</label>
                      <div>    
                          <input type="text" class="form-control dataInput" placeholder="ملاحظات" id="notes" name="notes">
                      </div>
                      <bold class="text-danger" id="errors-notes" style="display: none;"></bold>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">                                               
                    <button type="button" id="save" class="btn btn-primary btn-rounded">
                      حفظ
                      <span class="spinner-border spinner-border-sm spinner_request" role="status" aria-hidden="true"></span>
                    </button>

                    <button id="closeModal" type="button" class="btn btn-outline-secondary btn-rounded" data-dismiss="modal">اغلاق</button>
                </div> 

            </form>            
        </div>
      </div>
    </div>
</div>
