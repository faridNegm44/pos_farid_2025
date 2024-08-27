@include('back.layouts.app_style')
<div class="modal fade" id="calc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="width: 70%;margin: 0 auto;border: 4px solid #7878a4;border-radius: 20px;">
            <div class="modal-body">
                <div class="calculator" style="width: 100%;box-shadow: none;border-radius: 0px;margin: 0 auto;">
                    <div class="buttons">
                      <h2 id="value"></h2>
                      <span id="clear">Clear</span>
                      <span>/</span>
                      <span>*</span>
                      <span>7</span>
                      <span>8</span>
                      <span>9</span>
                      <span>-</span>
                      <span>4</span>
                      <span>5</span>
                      <span>6</span>
                      <span id="plus">+</span>
                      <span>1</span>
                      <span>2</span>
                      <span>3</span>
                      <span>0</span>
                      <span>00</span>
                      <span>.</span>
                      <span id="equal">=</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('back.layouts.general_scripts')
