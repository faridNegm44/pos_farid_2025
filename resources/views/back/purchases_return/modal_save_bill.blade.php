<div class="modal fade" id="modal_save_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="position: relative;">
                <h6 class="modal-title">حفظ فاتورة مرتجع المشتريات</h6>
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;left: 4px;color: red;">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="">
                            <label for="custom_date">تاريخ الفاتورة</label>
                            <div>    
                                <input type="date" name="custom_date" class="form-control custom_date" id="custom_date" placeholder="تاريخ الفاتورة" value="{{ $find[0]->custom_date }}">
                            </div>
                            <bold class="text-danger" id="errors-custom_date" style="display: none;"></bold>
                        </div>
                        
                        <div class="">
                            <label for="notes">ملاحظات</label>
                            <div>    
                                <input type="text" name="notes" class="form-control notes" id="notes" placeholder="ملاحظات" value="{{ $find[0]->notes }}">
                            </div>
                            <bold class="text-danger" id="errors-notes" style="display: none;"></bold>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">    
                        <div style="border: 1px solid;padding: 30px 15px;border-radius: 10px;text-align: center;">

                            <table class="table table-bordered table-striped text-center" id="supplier_table_info">
                                <p class="text-start fs-5">
                                    بيانات المورد: 
                                    <span style="margin: 0 3px;display: inline;font-size: 15px;" class="text-danger" id="supplier_name"></span>
                                </p>
                                <thead class="thead-dark">
                                    <tr>
                                        <th>دائن (له)</th>
                                        <th>مدين (علية)</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td id="for_him">{{ $userInfo < 0 ? display_number( $userInfo ) : 0 }}</td>
                                        <td id="on_him">{{ $userInfo >= 0 ? display_number( $userInfo ) : 0 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4" style="margin-top: 11px;">    
                        <ul class="list-unstyled" style=" padding: 0 !important;">
                            <li class="alert alert-outline-info p-2 mb-2 rounded" style="color: #000;padding-bottom: 3px !important;">
                                <span style="width: 160px;"> إجمالي المرتجعات قبل:</span> <span style="margin: 0 10px;font-size: 15px;position: relative;top: -4px;text-decoration: line-through;" class="subtotal">0</span>
                            </li>
                            
                            <li class="bg-danger-gradient p-2 mb-2 rounded" style="color: #000;padding-bottom: 3px !important;">
                                <span style="width: 160px;">إجمالي المرتجعات بعد:</span> <span style="margin: 0 10px;font-size: 20px;position: relative;top: -4px;" class="total_bill_after">0</span>
                            </li>                            
                        </ul>
                    </div>            

                    <div class="col-12" style="margin-top: 25px;" id="modal_save_bill_footer">
                        <h3 class="alert-danger text-center" style="padding: 10px 20px;margin: 5px auto;display: none;">يجب اصلاح جميع أخطاء الفاتورة قبل الحفظ</h3>
                        <div class="row justify-content-center">
                            <button class="col-lg-4 col-12 btn btn-success-gradient btn-rounded" id="finally_save_bill_btn" style="font-size: 14px;color: #000;">
                                حفظ المرتجع                            
                            </button>
            
                            <button class="col-lg-4 btn btn-secondary-gradient btn-rounded" style='font-size: 14px;color: #000;' data-dismiss="modal">
                                إغلاق
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

