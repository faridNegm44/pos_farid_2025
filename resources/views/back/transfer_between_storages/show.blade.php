<div class="modal fade" id="exampleModalCenterShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">عرض بيانات التحويل</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <div class="pd-30 pd-sm-40">
            
            <table class="table table-bordered table-striped text-center" style="margin-bottom: 25px;">
              <thead class="bg bg-black-5">
                <tr>
                  <th>رقم التحويل</th>
                  <th>تاريخ التحويل</th>
                  <th>مبلغ التحويل</th>
                  <th>مستخدم</th>
                  <th>ملاحظات</th>
                </tr>
              </thead>
              
              <tbody>
                <tr>
                  <td class="data_removed" id="num_order"></td>
                  <td class="data_removed" id="created_at" style="font-size: 11px !important;"></td>
                  <td class="data_removed" id="value"></td>
                  <td class="data_removed" id="user_id"></td>
                  <td class="data_removed" id="notes" style="font-size: 10px !important;"></td>
                </tr>
              </tbody>
            </table>


            <div class="row" >
                <div class="col-md-6" style="border: 1px solid #999;padding: 20px 10px 10px;border-radius: 5px;">
                  <h4 class="text-danger" style="margin-bottom: 20px;">خزينة التحويل</h4>
                  <ul>
                    <li id="num_order_treasure_from">اسم الخزينة: <span class="data_removed"></span></li>
                    <li id="value_treasure_from">مبلغ الخزينة بعد التحويل: <span class="data_removed"></span></li>
                  </ul>
                </div>
                
                <div class="col-md-6" style="border: 1px solid #999;padding: 20px 10px 10px;border-radius: 5px;">
                  <h4 class="text-danger" style="margin-bottom: 20px;">الخزينة المحول اليها</h4>
                  <ul>
                    <li id="num_order_treasure_to">اسم الخزينة: <span class="data_removed"></span></li>
                    <li id="value_treasure_to">مبلغ الخزينة بعد التحويل: <span class="data_removed"></span></li>
                  </ul>
                </div>
            </div>
          </div>  
        </div>
      </div>
    </div>
</div>
