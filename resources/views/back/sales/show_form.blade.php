<div class="modal fade" id="showProductsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body" style="display: none;">
              <div id="header">
                <div class="row">
                  <div class="col-md-6 col-12">
                    <ul class="invoice-info">
                      <li><span>رقم فاتورة:</span> <span class='header_span' id="id"></span></li>
                      <li><span>رقم مخصص:</span> <span class='header_span' id="custom_bill_num"></span></li>
                      <li><span>اذن الخزينة:</span> <span class='header_span' id="treasury_type"></span></li>
                      <li><span>اذن الفاتورة:</span> <span class='header_span' id="bill_type"></span></li>
                      <li><span>عدد أصناف الفاتورة:</span> <span class='header_span' id="count_items"></span></li>
                      <li><span>خصم الفاتورة:</span> <span class='header_span' id="bill_discount"></span></li>                      
                      <li><span>مصاريف إضافية:</span> <span class='header_span' id="extra_money"></span></li>                      
                      <li><span>إجمالي فاتورة قبل:</span> <span class='header_span' id="total_bill_before"></span></li>
                      <li><span>إجمالي فاتورة بعد:</span> <span class='header_span badge badge-primary' id="total_bill_after" style="font-size: 22px;padding: 3px 20px !important;"></span></li>
                      
                    </ul>
                  </div>

                  <div class="col-md-6 col-12">
                    <ul class="invoice-info">
                      <li><span>العميل:</span> <span class='header_span' id="clientName"></span></li>
                      <li><span>الخزينة:</span> <span class='header_span' id="treasuryName"></span></li>
                      <li><span>مبلغ مدفوع:</span> <span class='header_span' id="amount_money"></span></li>
                      {{--<li><span>رصيد العميل بعد:</span> <span class='header_span' id="remaining_money"></span></li>--}}
                      <li><span>رصيد الخزينة بعد:</span> <span class='header_span' id="treasury_money_after"></span></li>
                      <li><span>تاريخ الإنشاء:</span> <span class='header_span' id="created_at"></span></li>
                      <li><span>تاريخ آخر:</span> <span class='header_span' id="custom_date"></span></li>
                      <li><span>مستخدم الإضافة:</span> <span class='header_span' id="userName"></span></li>
                      <li><span>ملاحظات:</span> <span class='header_span' id="notes"></span></li>
                    </ul>
                  </div>
                </div>
              </div>  
              
              <br>

              <div id="content">
                <div class="table-responsive" style="width: 100%;">
                  <table class="table table-bordered table-striped text-center">
                    <thead class="bg bg-black-5">
                      <tr>
                        <th>رقم المنتج</th>
                        <th>اسم المنتج</th>
                        <th>كمية بالوحدة ك</th>
                        <th>كمية بالوحدة ص</th>
                        @if (userPermissions()->cost_price_view)
                          <th>سعر التكلفة</th>
                        @endif
                        <th>سعر البيع</th>
                        <th>الخصم</th>
                        <th>الضريبة</th>
                        <th>الإجمالي قبل</th>
                        <th>الإجمالي بعد</th>
                      </tr>
                    </thead>
  
                    <tbody></tbody>
                  </table>
                </div>
                
              </div>
          
              <div class="modal-footer">                                               
                  <button type="button" class="btn btn-primary btn-rounded print">طباعة</button>
                  <button id="closeModal" type="button" class="btn btn-outline-secondary btn-rounded" data-dismiss="modal">اغلاق</button>
              </div> 
        </div>
      </div>
    </div>
</div>
