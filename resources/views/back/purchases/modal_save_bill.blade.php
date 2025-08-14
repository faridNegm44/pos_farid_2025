<div class="modal fade" id="modal_save_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border-radius: 18px; box-shadow: 0 4px 24px #ead29860; border: 2px solid #bda17e; background: #fffbe7;">
            <!-- Modal Header -->
            <div class="modal-header" style="position: relative; background: #bda17e; color: #fff; border-radius: 16px 16px 0 0; border-bottom: 2px solid #e1ab09;">
                <h5 class="modal-title" style="font-weight: bold; letter-spacing: 1px;">
                    <i class="fas fa-save"></i> حفظ فاتورة المشتريات
                    <span style="color: #ffe5e5;font-size: 12px;margin: 0 5px;">
                        (يجب اختيار مورد وخزينة لعرض خانة المبلغ المدفوع وإظهار تفاصيل المورد)
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;left: 4px;color: #fff;opacity: 0.8;font-size: 2rem;">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row g-3">
                    <!-- Col 1 -->
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="treasuries" class="form-label" style="color:#6d4c1c;font-weight:bold;">خزائن النظام</label>
                            <select name="treasury_id" class="form-control treasuries" id="treasuries" style="border: 1.5px solid #bda17e; background: #fff; color: #6d4c1c; font-weight: bold;">
                                <option value="" selected>اختر خزينة</option>
                                @foreach ($treasuries as $treasury)
                                  <option value="{{ $treasury->id }}">{{ $treasury->name }} - {{ display_number($treasury->treasury_money_after) }}</option>
                                @endforeach
                            </select>
                            <bold class="text-danger" id="errors-treasuries" style="display: none;"></bold>
                        </div>
                        <div id="amount_paid" class="mb-3">
                            <label for="amount_paid" class="form-label" style="color:#6d4c1c;font-weight:bold;">المبلغ المدفوع</label>
                            <input type="text" name="amount_paid" class="form-control focus_input numValid amount_paid" placeholder="المبلغ المدفوع" style="font-size: 18px !important;text-align: center; border: 1.5px solid #e1ab09; background: #fffbe7; color: #b94a00; font-weight: bold;">
                            <bold class="text-danger" id="errors-amount_paid" style="display: none;"></bold>
                        </div>
                        <div class="mb-3">
                            <label for="custom_date" class="form-label" style="color:#6d4c1c;font-weight:bold;">تاريخ الفاتورة</label>
                            <input type="date" name="custom_date" class="form-control custom_date" id="custom_date" placeholder="تاريخ الفاتورة" style="border: 1.5px solid #bda17e;">
                            <bold class="text-danger" id="errors-custom_date" style="display: none;"></bold>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label" style="color:#6d4c1c;font-weight:bold;">ملاحظات</label>
                            <input type="text" name="notes" class="form-control notes" id="notes" placeholder="ملاحظات" style="border: 1.5px solid #ead298;">
                            <bold class="text-danger" id="errors-notes" style="display: none;"></bold>
                        </div>
                    </div>
                    <!-- Col 2 -->
                    <div class="col-lg-4">
                        <div style="border: 2px solid #ead298; background: #fff; padding: 24px 10px 18px 10px; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px #ead29820;">
                            <div class="mb-2 text-start fs-5" style="font-weight: bold; color: #6d4c1c;">
                                <i class="fas fa-user-tie text-warning"></i> بيانات المورد:
                                <span style="margin: 0 3px;display: inline;font-size: 15px;" class="text-danger" id="supplier_name"></span>
                            </div>
                            <table class="table table-bordered table-striped text-center mb-0" id="supplier_table_info" style="background: #fffbe7;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>دائن (له)</th>
                                        <th>مدين (علية)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="for_him">0</td>
                                        <td id="on_him">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Col 3 -->
                    <div class="col-lg-4" style="margin-top: 11px;">
                        <ul class="list-unstyled" style="padding: 0 !important;">
                            <li class="alert alert-outline-info p-2 mb-2 rounded d-flex justify-content-between align-items-center" style="color: #000; background: #fffbe7; border: 1.5px solid #bda17e;">
                                <span><i class="fas fa-calculator text-secondary"></i> إجمالي الفاتورة قبل:</span>
                                <span class="subtotal" style="margin: 0 10px;font-size: 15px;position: relative;top: -4px;text-decoration: line-through; color: #2980b9; font-weight: bold;">0</span>
                            </li>
                            <li class="p-2 mb-2 rounded d-flex justify-content-between align-items-center" style="background: linear-gradient(90deg, #fffbe7 60%, #e1ab09 100%); color: #3d2c13; border: 1.5px solid #e1ab09;">
                                <span><i class="fas fa-money-bill-wave text-success"></i> إجمالي الفاتورة بعد:</span>
                                <span class="total_bill_after" style="margin: 0 10px;font-size: 20px;position: relative;top: -4px; font-weight: bold; color: #b94a00;">0</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Footer -->
                    <div class="col-12" style="margin-top: 25px;display: none;" id="modal_save_bill_footer">
                        <h3 class="alert-danger text-center" style="padding: 10px 20px;margin: 5px auto;display: none; border-radius: 8px;">يجب اصلاح جميع أخطاء الفاتورة قبل الحفظ</h3>
                        <div class="row justify-content-center g-2">
                            <button class="col-lg-6 col-12 btn btn-success-gradient btn-rounded" id="finally_save_bill_btn" style="font-size: 15px;color: #000; font-weight: bold;">
                                <i class="fas fa-save"></i> حفظ الفاتورة                            
                            </button>
                            <button class="col-lg-4 btn btn-secondary-gradient btn-rounded" style='font-size: 15px;color: #000; font-weight: bold;' data-dismiss="modal">
                                <i class="fas fa-times"></i> إغلاق
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

