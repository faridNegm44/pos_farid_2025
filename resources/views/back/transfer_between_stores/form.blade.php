<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">اضافة تحويلات للأصناف من مخزن لآخر</h5>
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
                            <label for="transfer_from">
                              المخزن المحول منة
                              <i class="fas fa-arrow-left" style="margin: 0 10px;color: blue;font-size: 15px;"></i>
                            </label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                              <select class="form-control" id="transfer_from" name="transfer_from">
                                <option value="" >-- اختر المخزن المحول منة  --</option>
                                  @foreach ($stores as $store)
                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                  @endforeach
                              </select>
                            </div>
                            <bold class="text-danger" id="errors-transfer_from" style="display: none;"></bold>
                        </div>                        

                        <div class="col-lg-5">
                            <label for="transfer_to">
                              المخزن المحول الية
                              <i class="fas fa-arrow-right" style="margin: 0 10px;color: blue;font-size: 15px;"></i>
                            </label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                              <select class="form-control" id="transfer_to" name="transfer_to">
                                <option value="" >-- اختر المخزن المحول منة --</option>
                                @foreach ($stores as $store)
                                  <option value="{{ $store->id }}">{{ $store->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <bold class="text-danger" id="errors-transfer_to" style="display: none;"></bold>
                        </div>                        

                        <div class="col-lg-2">
                            <label for="value">العدد المحول</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="number" class="form-control dataInput" placeholder="العدد المحول" id="value" name="value" value="0">
                            </div>
                            <bold class="text-danger" id="errors-value" style="display: none;"></bold>
                        </div>                                               
                    </div>


                    <div class="row row-xs mt-3">
                      <div class="col-lg-6">
                        <label for="products">اصناف المخزن المحول منة</label>
                        <div>    
                          <select class="form-control" id="products" name="products">
                            
                          </select>                        
                        </div>
                        <bold class="text-danger" id="errors-products" style="display: none;"></bold>
                      </div>                 
                      
                      <div class="col-lg-6">
                        <label for="notes">ملاحظات</label>
                        <div>    
                          <input type="text" class="form-control dataInput" placeholder="ملاحظات" id="notes" name="notes">
                        </div>
                        <bold class="text-danger" id="errors-notes" style="display: none;"></bold>
                      </div>                 
                
                    </div>
                    

                    <div class="row row-xs mt-3 text-center" id="stores_quantity">                     
                      <div class="col-lg-2">
                        <label for="products">حدايد وبويات</label>
                        <b>10</b>
                      </div>       
                      
                      <div class="col-lg-2">
                        <label for="products">مواسير</label>
                        <b>2</b>
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
