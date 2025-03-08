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
                        <div class="col-md-12">
                            <label for="product_id">الأصناف</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <select  name="product_id" class="product_id selectize" id="product_id">
                                  <option value="" selected>اختر صنف</option>                              
                                  @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nameAr }}</option>                              
                                  @endforeach
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-product_id" style="display: none;"></bold>
                        </div> 
                        
                        <div class="col-lg-6 col-12">
                          <label for="current_quantity">كمية المخزن الحالية</label>
                          <div>
                              <input type="number" disabled class="form-control dataInput text-center" placeholder="كمية المخزن الحالية" id="current_quantity" name="current_quantity" value="0" style="font-size: 20px;">
                          </div>
                          <bold class="text-danger" id="errors-current_quantity" style="display: none;"></bold>
                        </div>  
                        
                        <div class="col-lg-6 col-12">
                          <label for="quantity">الكمية الجديدة</label>
                          <div>
                              <input type="number" class="form-control dataInput text-center" placeholder="الكمية الجديدة" id="quantity" name="quantity" style="font-size: 20px;" />
                          </div>
                          <bold class="text-danger" id="errors-quantity" style="display: none;"></bold>
                        </div>  
                        
                        <div class="col-12">
                          <label for="reason_id	">أسباب التسوية</label>
                          <div>
                              <select name="reason_id" class="form-control reason_id" id="reason_id">
                                @foreach ($taswea_reasons as $taswea_reason)
                                  <option value="{{ $taswea_reason->id }}">{{ $taswea_reason->name }}</option>                              
                                @endforeach
                              </select>
                          </div>
                          <bold class="text-danger" id="errors-reason_id	" style="display: none;"></bold>
                        </div>  

                        <div class="col-12">
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
