<div class="modal fade" id="modal_save_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="position: relative;">
                <h6 class="modal-title">
                    حفظ فاتورة المشتريات
                    <span style="color: red;font-size: 11px;margin: 0 5px;">
                        ( يجب اختيار مورد وخزينة لعرض خانة المبلغ المدفوع وإظهار تفاصيل المورد )
                    </span>
                </h6>
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;left: 4px;color: red;">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label for="treasuries">خزائن النظام</label>
                            <div>    
                                <select name="treasuries" class="form-control treasuries" id="treasuries">
                                    <option value="" selected>اختر خزينة</option>
                                    @foreach ($treasuries as $treasury)
                                      <option value="{{ $treasury->id }}">{{ $treasury->name }} - {{ $treasury->money }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-treasuries" style="display: none;"></bold>
                        </div>
                        
                        <div id="amount_paid">
                            <label for="amount_paid">المبلغ المدفوع</label>
                            <div>    
                                <input type="text" name="amount_paid" class="form-control amount_paid" placeholder="المبلغ المدفوع" style="font-size: 18px !important;text-align: center;">
                            </div>
                            <bold class="text-danger" id="errors-amount_paid" style="display: none;"></bold>
                        </div>
                        
                        <div class="">
                            <label for="status">ملاحظات</label>
                            <div>    
                                <input type="text" name="status" class="form-control status" id="status" placeholder="ملاحظات">
                            </div>
                            <bold class="text-danger" id="errors-status" style="display: none;"></bold>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">    
                        <div class="text-center" id="supplier_div" style="margin-bottom: 10px;display: none;">
                            مورد: <span>ايهاب مسلم</span>

                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>دائن (له)</th>
                                        <th>مدين (علية)</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>10.000</td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12" style="margin-top: 25px;">
                        <div class="row justify-content-center">
                            <button class="col-lg-6 col-12 btn btn-success btn-rounded" id="save_bill" >
                                <i class="fas fa-check-double"></i> 
                                <span>حفظ الفاتورة</span>
                            </button>
            
                            <button class="col-lg-6 col-12 btn btn-primary btn-rounded refresh_page">
                                <i class="fas fa-trash-alt"></i> 
                                <span>حفظ وطباعة</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

