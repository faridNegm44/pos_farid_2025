<div class="modal fade" id="modal_save_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="position: relative;">
                <h6 class="modal-title">دفع الآن</h6>
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;left: 4px;color: red;">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8" style="margin-bottom: 15px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="treasury_tbl" class="table table-bordered text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th style="width: 10%;">#</th>
                                            <th style="width: 30%;">اسم الخزينة</th>
                                            <th style="width: 20%;">المبلغ</th>
                                            <th style="width: 40%;">ملاحظات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>درج النقدية اليومي<input type="hidden" name="price_id[]" value="1"></td>
                                            <td><input type="text" class="form-control text-center priceCash numValidate focused" name="price_cash[]" value="0" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="price_note[]" placeholder="ملاحظات"></td>
                                        </tr>
                                    
                                        <tr>
                                            <td>2</td>
                                            <td>انستاباي ايهاب<input type="hidden" name="price_id[]" value="2"></td>
                                            <td><input type="text" class="form-control text-center priceCash numValidate focused" name="price_cash[]" value="0" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="price_note[]" placeholder="ملاحظات"></td>
                                        </tr>
                                    
                                        <tr>
                                            <td>3</td>
                                            <td>انستاباي حسام<input type="hidden" name="price_id[]" value="3"></td>
                                            <td><input type="text" class="form-control text-center priceCash numValidate focused" name="price_cash[]" value="0" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="price_note[]" placeholder="ملاحظات"></td>
                                        </tr>
                                    
                                        <tr>
                                            <td>4</td>
                                            <td>محفظة فودافون كاش<input type="hidden" name="price_id[]" value="4"></td>
                                            <td><input type="text" class="form-control text-center priceCash numValidate focused" name="price_cash[]" value="0" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="price_note[]" placeholder="ملاحظات"></td>
                                        </tr>
                                    
                                        <tr>
                                            <td>5</td>
                                            <td>درج ترحيل<input type="hidden" name="price_id[]" value="5"></td>
                                            <td><input type="text" class="form-control text-center priceCash numValidate focused" name="price_cash[]" value="0" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="price_note[]" placeholder="ملاحظات"></td>
                                        </tr>
                                
                                        <tr>
                                            <td>6</td>
                                            <td>درج فريد نجم<input type="hidden" name="price_id[]" value="6"></td>
                                            <td><input type="text" class="form-control text-center priceCash numValidate focused" name="price_cash[]" value="0" autocomplete="off"></td>
                                            <td><input type="text" class="form-control" name="price_note[]" placeholder="ملاحظات"></td>
                                        </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4" style="font-size: 14px;">
                        <div class="total_items" style="border: 1px dashed;padding: 7px 10px;margin-bottom: 10px;">
                            عدد العناصر:
                            <span style="font-size: 20px;">2</span>
                        </div>
    
                        <div class="" style="background: rgb(82, 82, 82);border: 1px dashed;color: #fff;padding: 7px 10px;margin-bottom: 10px;">
                            المستحق دفعة:
                            <span style="font-size: 23px;" id="total_amount">1491.12</span>
                        </div>
    
                        <div class="" style="border: 1px dashed;padding: 7px 10px;margin-bottom: 10px;">
                            إجمالي المدفوع:
                            <span style="font-size: 23px;" id="sumPriceCash">0</span>
                        </div>
    
                        <div class="" style="border: 1px dashed;padding: 7px 10px;margin-bottom: 10px;">
                            متبقي:
                            <span style="font-size: 20px;" id="minPriceCash">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

