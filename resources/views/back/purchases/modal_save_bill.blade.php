<div class="modal fade" id="modal_save_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="position: relative;">
                <h6 class="modal-title">حفظ فاتورة المشتريات</h6>
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;left: 4px;color: red;">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <label for="status">خزن النظام</label>
                            <div>    
                                <select  name="status" class="form-control status" id="status">
                                    <option value="" selected>اختر خزينة</option>
                                    <option value="1">خ 1</option>
                                    <option value="0">خ2 </option>
                                </select>
                            </div>
                            <bold class="text-danger" id="errors-status" style="display: none;"></bold>
                        </div>
                        
                        <div class="">
                            <label for="status">المبلغ المدفوع</label>
                            <div>    
                                <input type="text" name="status" class="form-control status" id="status" placeholder="المبلغ المدفوع" style="font-size: 18px !important;text-align: center;">
                            </div>
                            <bold class="text-danger" id="errors-status" style="display: none;"></bold>
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
                        <div class="text-center" style="margin-bottom: 10px;">
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

                            <hr>

                            <div class="row justify-content-center">
                                <button class="col-lg-6 col-12 btn btn-success btn-rounded mb-2" id="save_bill"  data-toggle="tooltip" title="حفظ الفاتورة">
                                    <i class="fas fa-check-double"></i> 
                                    <span>حفظ الفاتورة</span>
                                </button>
                
                                <button class="col-lg-6 col-12 btn btn-primary btn-rounded mb-2 refresh_page">
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
</div>

