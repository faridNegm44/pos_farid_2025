<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">اضافة تحويل من خزينة لأخري</h5>
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

                        <div class="col-lg-5">
                            <label for="transaction_from">
                              تحويل من خزينة
                              <i class="fas fa-arrow-left" style="margin: 0 10px;color: blue;font-size: 15px;"></i>
                            </label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                              <select class="form-control" id="transaction_from" name="transaction_from">
                                <option value="" >-- اختر خزينة التحويل من --</option>
                                  @foreach ($treasuries as $treasury)
                                      <option value="{{ $treasury->id }}">{{ $treasury->name }} - {{ $treasury->treasury_money_after }}</option>
                                  @endforeach
                              </select>
                            </div>
                            <bold class="text-danger" id="errors-transaction_from" style="display: none;"></bold>
                        </div>                        

                        <div class="col-lg-5">
                            <label for="transaction_to">
                              تحويل الي خزينة
                              <i class="fas fa-arrow-right" style="margin: 0 10px;color: blue;font-size: 15px;"></i>
                            </label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                              <select class="form-control" id="transaction_to" name="transaction_to">
                                <option value="" >-- اختر خزينة التحويل الي --</option>
                                  @foreach ($treasuries as $treasury)
                                      <option value="{{ $treasury->id }}">{{ $treasury->name }} - {{ $treasury->treasury_money_after }}</option>
                                  @endforeach
                              </select>
                            </div>
                            <bold class="text-danger" id="errors-transaction_to" style="display: none;"></bold>
                        </div>                        

                        <div class="col-lg-2">
                            <label for="value">مبلغ التحويل</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="number" class="form-control dataInput" placeholder="مبلغ التحويل" id="value" name="value" value="0">
                            </div>
                            <bold class="text-danger" id="errors-value" style="display: none;"></bold>
                        </div>                                               
                    </div>


                    <div class="row row-xs mt-3">
                        <div class="col-lg-6">
                            <label for="transaction_from_money_total">المتبقي في خزنة التحويل</label>
                            <div class="text-center" id="transaction_from_money_total" style="background-color: #a8cdad;padding: 10px 0;font-size: 13px;">
                                0
                            </div>
                            <bold class="text-danger" id="errors-transaction_from_money_total" style="display: none;"></bold>
                        </div>                        
                        
                        <div class="col-lg-6">
                            <label for="transaction_to_money_total">الإجمالي في الخزنة المحول اليها</label>
                            <div class="text-center" id="transaction_to_money_total" style="background-color: #b9a3a3;padding: 10px 0;font-size: 13px;">
                                0
                            </div>
                            <bold class="text-danger" id="errors-transaction_to_money_total" style="display: none;"></bold>
                        </div>                                                                     
                    </div>
                    

                    <div class="row row-xs  mt-3">                     
                        <div class="col-lg-12">
                          <label for="notes">ملاحظات</label>
                          <div>    
                            <input type="text" class="form-control dataInput" placeholder="ملاحظات" id="notes" name="notes">
                          </div>
                          <bold class="text-danger" id="errors-notes" style="display: none;"></bold>
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
