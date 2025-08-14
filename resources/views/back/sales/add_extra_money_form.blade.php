<div class="modal fade" id="addExtraMoney" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">إضافة مصاريف للفاتورة ➕💰</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            <form class="" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="res_id_extra_money" value="" />               
                
                <div class="pd-30 pd-sm-40 bg-gray-100">
                    <div class="row row-xs">

                        <div class="col-md-12">
                            <label for="status">الحالة</label>
                            <div>    
                                <select class="form-control" name="extra_money_type" id="extra_money_type">
                                    <option value="" selected>اختر مصروف إضافي</option>
                                    @foreach ($extra_expenses as $item)
                                        <option value="{{ $item->id }}">{{ $item->expense_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-status" style="display: none;"></bold>
                        </div>                        

                        <div class="col-md-12">
                          <label for="extra_money">مبلغ المصروف</label>
                          <div>
                              <input autocomplete="off" type="number" class="form-control text-center numValid focus_input" id="extra_money" name="extra_money" placeholder="مبلغ المصروف" min="0" />
                          </div>
                          <bold class="text-danger" id="errors-extra_money" style="display: none;"></bold>
                      </div>                        

                    </div>
                </div>

                <div class="modal-footer">                                               
                    <button type="button" id="update" class="btn btn-primary btn-rounded">
                      حفظ المصروف 
                      <span class="spinner-border spinner-border-sm spinner_request" role="status" aria-hidden="true"></span>
                    </button>
                    
                    <button id="closeModal" type="button" class="btn btn-outline-secondary btn-rounded" data-dismiss="modal">اغلاق</button>
                </div> 

            </form>            
        </div>
      </div>
    </div>
</div>
