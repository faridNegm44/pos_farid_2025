<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
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
                  
                  <div class="row row-xs" id="hide_section">
                    <div class="col-lg-4 col-12">
                      <label for="partner_id">الشركاء</label>
                      <div>
                          <select name="partner_id" class="partner_id" id="partner_id">
                            <option value="" selected disabled>اختر شريك</option>
                            @foreach ($partners as $partner)
                              <option value="{{ $partner->id }}" data-remaining_money="{{ display_number($partner->remaining_money) }}">{{ $partner->name }} ( {{ display_number($partner->remaining_money) }} )</option>
                            @endforeach
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-partner_id	" style="display: none;"></bold>
                    </div>  

                    <div class="col-lg-4 col-12">
                      <label for="current_remaining_money">
                        رصيد الجهة الحالي
                        <span class="text-danger" id="partnerStatus" style='margin: 0 5px;'></span>
                      </label>
                      <div>
                          <input type="number" disabled class="form-control dataInput text-center" placeholder="رصيد الجهة الحالي" id="current_remaining_money" name="current_remaining_money" value="" style="font-size: 20px;">
                      </div>
                      <bold class="text-danger" id="errors-current_remaining_money" style="display: none;"></bold>
                    </div>  
                    
                    <div class="col-lg-4 col-12">
                      <label for="new_remaining_money">رصيد الجهة الجديد</label>
                      <div>
                          <input type="number" class="form-control dataInput text-center" placeholder="رصيد الجهة الجديد" id="new_remaining_money" name="new_remaining_money" style="font-size: 20px;" />
                      </div>
                      <bold class="text-danger" id="errors-new_remaining_money" style="display: none;"></bold>
                    </div>  
                    
                    <div class="col-lg-4 col-12">
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
