<div class="modal fade" id="modal_search_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">بحث عن صنف</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form class="mb-2">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <input type="text" class="form-control form-control-sm mb-2" id="searchField" placeholder="أدخل الكود أو الاسم">
                        </div>
                        <div class="col-auto">
                            <select class="form-control form-control-sm mb-2" id="categorySelect">
                                <option>الاسم</option>
                                <option>الكود</option>
                                <option>الاسم (En)</option>
                                <option>الأصناف العامة</option>
                                <option>الأصناف الغير محلية</option>
                                <option>الأدوية الخاصة</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-sm mb-2">بحث</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>الكود</th>
                            <th>الاسم</th>
                            <th>الاسم (En)</th>
                            <th>السعر</th>
                            <th>الشركة المصنعة</th>
                            <th>الكود الداخلي</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>21061</td>
                            <td>ACCU-CHEK SOFTCLIX 200 L</td>
                            <td>ACCU-CHEK SOFTCLIX 200 L</td>
                            <td>250.00</td>
                            <td>Hoffmann-La Roche</td>
                            <td>49928</td>
                        </tr>
                        <tr>
                            <td>12345</td>
                            <td>Example Item 1</td>
                            <td>Example Item 1 (En)</td>
                            <td>100.00</td>
                            <td>Company 1</td>
                            <td>67890</td>
                        </tr>
                        <tr>
                            <td>21061</td>
                            <td>ACCU-CHEK SOFTCLIX 200 L</td>
                            <td>ACCU-CHEK SOFTCLIX 200 L</td>
                            <td>250.00</td>
                            <td>Hoffmann-La Roche</td>
                            <td>49928</td>
                        </tr>
                        <tr>
                            <td>12345</td>
                            <td>Example Item 1</td>
                            <td>Example Item 1 (En)</td>
                            <td>100.00</td>
                            <td>Company 1</td>
                            <td>67890</td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-row mt-2">
                    <div class="col-auto">
                        <input type="number" class="form-control form-control-sm" placeholder="الكمية">
                    </div>
                    <div class="col-auto">
                        <input type="text" class="form-control form-control-sm" placeholder="سعر الوحدة">
                    </div>
                    <div class="col-auto align-self-end">
                        <button type="button" class="btn btn-success btn-sm">تنفيذ</button>
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
