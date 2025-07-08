<div class="modal fade client_modal" id="client_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">اضافة عميل جديد</h5>
        </div>
        
        <div class="modal-body" style="background: #efefef;padding: 35px 30px 30px;">
            <form>
                @csrf                    
                <div class="col-12">
                    <label for="client_modal_name" class="form-label">
                        اسم العميل
                        <i class="fas fa-star" style="color: red;margin: 0 10px;font-size: 11px;"></i>
                    </label>
                    <div>
                        <input type="text" class="form-control" name="client_modal_name" id="client_modal_name" placeholder="اسم العميل">
                    </div>
                    <bold class="text-danger" id="errors-client_modal_name" style="display: none;"></bold>
                </div>
                
                <div class="col-12">
                    <label for="client_modal_phone" class="form-label">
                        تليفون العميل
                    </label>
                    <div>
                        <input type="number" class="form-control" placeholder="تليفون العميل" id="client_modal_phone" name="client_modal_phone">
                    </div>
                    <bold class="text-danger" id="errors-client_modal_phone" style="display: none;"></bold>
                </div>     
                
                <div class="col-12">
                    <label for="client_modal_address" class="form-label">
                        عنوان العميل
                    </label>
                    <div>
                        <input type="text" class="form-control" placeholder="عنوان العميل" id="client_modal_address" name="client_modal_address">
                    </div>
                    <bold class="text-danger" id="errors-client_modal_address" style="display: none;"></bold>
                </div>     
                
                <div class="col-12">
                    <label for="client_modal_type_payment">
                        طريقة التعامل
                        <i class="fas fa-info-circle" style="color: red;margin: 0 10px;display: inline;" data-bs-toggle="tooltip" title="⚠️ عند اختيارك لطريقة التعامل بالآجل، سيكون العميل قادراً على استلام السلع والخدمات دون سداد قيمتها في الوقت الحالي. يُرجى التأكد من أهلية العميل لهذا النوع من التعامل."></i>
                    </label>
                    <div>
                        <select id="client_modal_type_payment" name="client_modal_type_payment" class="form-control">
                            <option value="" selected disabled>اختر طريقة تعامل</option>
                            <option value="كاش">كاش</option>
                            <option value="آجل">آجل</option>
                        </select>
                    </div>
                    <bold class="text-danger" id="errors-client_modal_type_payment" style="display: none;"></bold>
                </div>
            </form>
        </div>

        <div class="modal-footer">                                               
            <button type="button" id="save" class="btn btn-primary btn-block">
              حفظ
              <span class="spinner-border spinner-border-sm spinner_request" role="status" aria-hidden="true"></span>
            </button>
        </div> 

      </div>
    </div>
</div>
