<div class="modal fade" id="modal_dismissal_notices" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">مصروفات الإذن</h5>
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;left: 4px;color: red;">&times;</button>
            </div>
            <div class="modal-body text-center">
                <table class="table table-responsive table-bordered">

                    <thead class="table-dark">
                    <tr>
                        <th>مصروف الإذن</th>
                        <th>تكلفة المصروف</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style="width: 60%;">
                                <input type="text" readonly class="form-control text-center" value="دليفري" />
                                <input type="hidden" name="dismissal_notices[]" id="dismissal_notices" value="2">
                            </th>
                            <td>
                                <input type="text" class="form-control text-center dismissal_notices_amount numValidate focused" name="dismissal_notices_amount[]" id="dismissal_notices" placeholder="تكلفة المصروف" value="0.00" style="font-weight: bold;color: red;text-align: right;">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>