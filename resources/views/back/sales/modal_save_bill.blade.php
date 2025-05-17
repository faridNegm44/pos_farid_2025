<div class="modal fade" id="modal_save_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="position: relative;">
                <h6 class="modal-title">
                    حفظ فاتورة المبيعات
                    <span style="color: red;font-size: 11px;margin: 0 5px;">
                        ( يجب اختيار عميل وخزينة لعرض خانة المبلغ المستحق دفعة )
                    </span>
                </h6>
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;left: 4px;color: red;">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="">
                            <label for="treasuries">خزائن النظام</label>
                            <div>    
                                <select name="treasury_id" class="form-control treasuries" id="treasuries">
                                    <option value="" selected>اختر خزينة</option>
                                    @foreach ($treasuries as $treasury)
                                      <option value="{{ $treasury->id }}">{{ $treasury->name }} - {{ $treasury->treasury_money_after }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-treasuries" style="display: none;"></bold>
                        </div>
                        
                        <div id="amount_paid">
                            <label for="amount_paid">المبلغ المدفوع</label>
                            <div>    
                                <input type="text" name="amount_paid" class="form-control focus_input numValid amount_paid" placeholder="المبلغ المدفوع" style="font-size: 18px !important;text-align: center;">
                            </div>
                            <bold class="text-danger" id="errors-amount_paid" style="display: none;"></bold>
                        </div>
                        
                        <div class="">
                            <label for="custom_date">تاريخ الفاتورة</label>
                            <div>    
                                <input type="date" name="custom_date" class="form-control custom_date" id="custom_date" placeholder="تاريخ الفاتورة">
                            </div>
                            <bold class="text-danger" id="errors-custom_date" style="display: none;"></bold>
                        </div>
                        
                        <div class="" style="margin-bottom: 15px;">
                            <label for="notes">ملاحظات</label>
                            <div>    
                                <input type="text" name="notes" class="form-control notes" id="notes" placeholder="ملاحظات">
                            </div>
                            <bold class="text-danger" id="errors-notes" style="display: none;"></bold>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">    
                        <div style="border: 1px solid;padding: 30px 15px;border-radius: 10px;text-align: center;">
                            <table class="table table-bordered table-striped text-center" id="client_table_info">
                                <p class="text-start fs-5">
                                    بيانات العميل: 
                                    <span style="margin: 0 3px;display: inline;font-size: 15px;" class="text-danger" id="client_name"></span>
                                </p>
                                <thead class="thead-dark">
                                  <tr>
                                    <th>نوع الحساب</th>
                                    <th>عليه</th>
                                    <th>له</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td id="accountType"></td>
                                    <td id="on_him">0</td>
                                    <td id="for_him">0</td>
                                  </tr>
                                </tbody>
                            </table>  
                        </div>
                    </div>
                    
                    <div class="col-lg-4" style="margin-top: 11px;">    
                        {{-- style="margin-bottom: 10px;display: none;" --}}
                        <ul class="list-unstyled" style=" padding: 0 !important;">
                            <li class="alert alert-outline-info p-2 mb-2 rounded" style="color: #000;padding-bottom: 3px !important;">
                                <span style="width: 110px;"> إجمالي قبل:</span> <span style="margin: 0 10px;font-size: 15px;position: relative;top: -4px;text-decoration: line-through;" class="subtotal">0</span>
                            </li>
                            
                            <li class="bg-success-gradient p-2 mb-2 rounded" style="color: #000;padding-bottom: 3px !important;">
                                <span style="width: 110px;">المستحق دفعة:</span> <span style="margin: 0 10px;font-size: 20px;position: relative;top: -4px;" class="total_bill_after">0</span>
                            </li>                            
                                                            
                            <li class="bg-warning-gradient p-2 mb-2 rounded" style="color: #000;padding-bottom: 3px !important;">
                                <span style="width: 110px;">إجمالي المدفوع:</span> <span id="total_paid" style="margin: 0 10px;font-size: 15px;position: relative;top: -4px;">0 جنية</span>
                            </li>
                            
                            <li class="bg-danger-gradient p-2 mb-2 rounded" style="color: #000;padding-bottom: 3px !important;">
                                <span style="width: 110px;">المتبقي:</span> <span id="remaining" style="margin: 0 10px;font-size: 15px;position: relative;top: -4px;">0</span>
                            </li>
                            
                        </ul>
                    </div>                

                    <div class="col-12" style="margin-top: 25px;" id="modal_save_bill_footer">
                        <h3 class="alert-danger text-center" style="padding: 10px 20px;margin: 5px auto;display: none;">يجب اصلاح جميع أخطاء الفاتورة قبل الحفظ</h3>
                        <div class="row justify-content-center">
                            <button class="col-lg-4 col-12 btn btn-success-gradient btn-rounded" id="finally_save_bill_btn" style="font-size: 14px;color: #000;">
                                حفظ الفاتورة                            
                            </button>
            
                            <button class="col-lg-4 col-12 btn btn-primary-gradient btn-rounded" id="finally_save_bill_and_print_btn" style="font-size: 14px;color: #000;">
                                حفظ وطباعة
                            </button>

                            <button class="col-lg-4 col-12 btn btn-secondary-gradient btn-rounded" style='font-size: 14px;color: #000;' data-dismiss="modal">
                                إغلاق
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

