<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
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

                        <div class="col-md-8">
                            <label for="expense_type">نوع المصروف</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="text" class="form-control dataInput" placeholder="نوع المصروف" id="expense_type" name="expense_type" data-autofocus>
                            </div>
                            <bold class="text-danger" id="errors-expense_type" style="display: none;"></bold>
                        </div>                        
                        
                        <div class="col-md-4">
                            <label for="amount">سعر المصروف</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="number" class="form-control dataInput" placeholder="سعر المصروف" id="amount" name="amount" min="0" value="0"/>
                            </div>
                            <bold class="text-danger" id="errors-amount" style="display: none;"></bold>
                        </div>                        
                                              
                        <div class="col-md-12">
                          <label for="notes">ملاحظات</label>
                          <div>
                              <input type="text" class="form-control dataInput" placeholder="ملاحظات" id="notes" name="notes" >
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
