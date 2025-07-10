<div class="modal fade" id="modal_search_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header" style="position: relative;">
                <h6 class="modal-title">بحث عن سلعة/خدمة</h6>
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;left: 4px;color: red;">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form class="" id="search_form">
                    <div class="form-row align-items-center">
                        <div class="col-md-2 col-sm-12">
                            <select class="form-control form-control-sm" id="search_by">
                                <option selected>الاسم (ع)</option>
                                <option>الكود</option>
                                <option>الاسم (En)</option>
                            </select>
                        </div>

                        <div class="col-md-5 col-sm-12">
                            <input type="text" class="form-control form-control-sm" id="product_name" name="product_name" placeholder="اسم السلعة/الخدمة">
                        </div>

                        <div class="col-md-2 col-sm-12">
                            <input type="text" class="form-control form-control-sm" id="from" name="from" placeholder="من">
                        </div>

                        <div class="col-md-2 col-sm-12">
                            <input type="text" class="form-control form-control-sm" id="to" name="to" placeholder="الي">
                        </div>
                        
                        <div class="col-md-1 col-sm-12">
                            <button type="submit" class="btn btn-primary btn-sm btn-block">بحث</button>
                        </div>
                    </div>
                </form>

                <div id="table" class="table-responsive text-sm-center">
                    <table class="table table-bordered table-hover">
                        <thead class="bg bg-black-5">
                            <tr>
                                <th>#</th>
                                <th>الكود</th>
                                <th>الاسم</th>
                                <th>ك مخزن</th>
                                <th>السعر</th>
                                <th>القسم</th>
                                <th>ملاحظات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0;  $i < 100; $i++)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>21061</td>
                                    <td>كوشن فرو في جلد ابيض مصري</td>
                                    <td>20</td>
                                    <td style="color: red;font-size: 14px;">1200,8</td>
                                    <td>كوشنات</td>
                                    <td></td>
                                </tr>                            
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="form-row mt-2">
                    <div class="col-md-2 col-sm-12">
                        <input type="text" readonly class="form-control form-control-sm" id="from" name="from" placeholder="ك مخزن">
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <input type="text" class="form-control form-control-sm" id="from" name="from" placeholder="ك مباعة">
                    </div>
                
                    <div class="col-md-1 col-sm-12">
                        <button type="button" class="btn btn-success btn-sm btn-block">موافق</button>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">إغلاق</button>
            </div>

        </div>
    </div>
</div>
