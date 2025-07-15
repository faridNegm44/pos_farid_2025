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
                          <label for="supervisor_1">المشرف الأول</label>
                          <i class="fas fa-star require_input"></i>
                          <div>
                              <select name="supervisor_1" class="form-control" id="supervisor_1">
                                  <option value="">اختر مشرف</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>                                  
                                  @endforeach
                              </select>
                          </div>
                          <bold class="text-danger" id="errors-supervisor_1" style="display: none;"></bold>
                      </div>
                      
                      <div class="col-md-12">
                          <label for="supervisor_2">المشرف الثاني</label>
                          <div>
                              <select name="supervisor_2" class="form-control" id="supervisor_2">
                                  <option value="">اختر مشرف (اختياري)</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>                                  
                                  @endforeach
                              </select>
                          </div>
                          <bold class="text-danger" id="errors-supervisor_2" style="display: none;"></bold>
                      </div>
                      
                      <div class="col-md-12">
                          <label for="supervisor_3">المشرف الثالث</label>
                          <div>
                              <select name="supervisor_3" class="form-control" id="supervisor_3">
                                  <option value="">اختر مشرف (اختياري)</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>                                  
                                  @endforeach
                              </select>
                          </div>
                          <bold class="text-danger" id="errors-supervisor_3" style="display: none;"></bold>
                      </div>
                      
                      <div class="col-md-12">
                        <label for="date">تاريخ اخر للجرد</label>
                        <div>
                            <input type="date" class="form-control dataInput" id="date" name="date">
                        </div>
                        <bold class="text-danger" id="errors-date" style="display: none;"></bold>
                      </div>
                      
                      <div class="col-md-12">
                          <label for="notes">ملاحظات</label>
                          <div>
                              <textarea class="form-control dataInput" id="notes" name="notes" placeholder="أدخل ملاحظات إن وجدت"></textarea>
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
