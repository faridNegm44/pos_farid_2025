<div class="modal fade takeMoneyModal" id="takeMoneyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLongTitle" style="font-weight: bold;">تحصيل الايصال ✅</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            <form class="" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="res_id_take_money" value="" />               
                
                <div class="pd-30 pd-sm-40 bg-gray-100">
                    <div class="row row-xs">

                      <div class="col-lg-12">
                        <label for="treasury">الخزينة</label>
                        <i class="fas fa-star require_input"></i>
                        <div>
                          <select class="form-control" id="treasury" name="treasury">
                            <option value="" selected disabled>اختر خزينة</option>
                              @foreach ($treasuries as $treasury)
                                  <option value="{{ $treasury->id }}">{{ $treasury->name }} - {{ display_number($treasury->treasury_money_after) }}</option>
                              @endforeach
                          </select>
                        </div>
                        <bold class="text-danger" id="errors-treasury" style="display: none;"></bold>
                      </div>                       
                    </div>
                </div>

                <div class="modal-footer">                                               
                    <button type="button" id="save" class="btn btn-primary btn-rounded save">
                      تحصيل الايصال
                      <span class="spinner-border spinner-border-sm spinner_request" role="status" aria-hidden="true"></span>
                    </button>                    
                    <button id="closeModal" type="button" class="btn btn-outline-secondary btn-rounded" data-dismiss="modal">اغلاق</button>
                </div> 

            </form>            
        </div>
      </div>
    </div>
</div>
