<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            <form class="" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="res_id" value="" />               
                
                <div class="pd-30 pd-sm-40 bg-gray-100">
                  <h5 style="text-decoration: underline;">بيانات أساسية</h5>
                  <div class="row row-xs">
                    <div class="col-lg-1 col-md-6 col-12">
                      <label for="type">نوع السلعة/الخدمة</label>
                        <div>    
                            <select name="type" class="type form-control" id="type">
                                <option value="سلعة">سلعة</option>
                                <option value="خدمي">خدمي</option>
                            </select>
                        </div>
                      <bold class="text-danger" id="errors-type" style="display: none;"></bold>
                    </div> 
                    
                    <div class="col-lg-3 col-md-6 col-12">
                      <label for="nameAr">إسم السلعة/الخدمة بالعربية</label>
                      <i class="fas fa-star require_input"></i>
                      <div>
                          <input type="text" class="form-control dataInput" placeholder="إسم السلعة/الخدمة بالعربية" id="nameAr" name="nameAr" data-autofocus >
                      </div>
                      <bold class="text-danger" id="errors-nameAr" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-2 col-md-6 col-12">
                        <label for="nameEn">إسم السلعة/الخدمة بالأجنبية</label>
                        <div>
                            <input type="text" class="form-control dataInput" placeholder="إسم السلعة/الخدمة بالأجنبية" id="nameEn" name="nameEn" >
                        </div>
                        <bold class="text-danger" id="errors-nameEn" style="display: none;"></bold>
                    </div>

                    <div class="col-lg-1 col-md-6 col-12">
                        <label for="shortCode">ك مختصر</label>
                        <div>
                            <input type="text" class="form-control dataInput" placeholder="ك مختصر" id="shortCode" name="shortCode" >
                        </div>
                        <bold class="text-danger" id="errors-shortCode" style="display: none;"></bold>
                    </div>                        
                    
                    <div class="col-lg-2 col-md-6 col-12">
                        <label for="natCode">ك دولي</label>
                        <div>
                            <input type="text" class="form-control dataInput" placeholder="ك دولي" id="natCode" name="natCode" >
                        </div>
                        <bold class="text-danger" id="errors-natCode" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-1 col-md-6 col-12">
                      <label for="status">الحالة</label>
                        <div>    
                            <select name="status" class="status form-control" id="status">
                                <option value="1">نشط</option>
                                <option value="0">معطل</option>
                            </select>
                        </div>
                      <bold class="text-danger" id="errors-status" style="display: none;"></bold>
                    </div>  

                    <div class="col-lg-2 col-md-6 col-12">
                      <label for="image">صورة السلعة/الخدمة</label>
                      <div>
                          <input type="file" class="form-control dataInput" placeholder="صورة السلعة/الخدمة" id="image" name="image" >
                          <input type="hidden" class="dataInput" id="image_hidden" name="image_hidden" >
                      </div>
                      <bold class="text-danger" id="errors-image" style="display: none;"></bold>
                    </div> 

                    <div class="col-lg-2 col-md-6 col-12">
                      <label for="store">المخزن</label>
                      <i class="fas fa-star require_input"></i>
                      <div>    
                          <select  name="store" class="store selectize" id="store">
                            <option value="" selected>المخزن</option>                              
                            @foreach ($stores as $index => $store)
                              <option value="{{ $store->id }}" {{ $index == 0 ? 'selected' : '' }}>{{ $store->name }}</option>                              
                            @endforeach
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-store" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-2 col-md-6 col-12">
                      <label for="category">اقسام السلع والخدمات الرئيسية</label>
                      <div>    
                          <select  name="category" class="category form-control" id="category">
                            <option value="" selected>اقسام السلع والخدمات الرئيسية</option>                              
                            @foreach ($productCategoys as $categoy)
                              <option value="{{ $categoy->id }}">{{ $categoy->name }}</option>                              
                            @endforeach
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-category" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-2 col-md-6 col-12">
                      <label for="sub_category">اقسام السلع والخدمات الفرعية</label>
                      <div>    
                          <select  name="sub_category" class="sub_category form-control" id="sub_category"></select>
                      </div>
                      <bold class="text-danger" id="errors-sub_category" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-2 col-md-6 col-12">
                      <label for="company">الشركة المصنعة</label>
                      <div>    
                          <select  name="company" class="company selectize" id="company">
                            <option value="" selected>الشركة المصنعة</option>
                            @foreach ($companys as $company)
                              <option value="{{ $company->id }}">{{ $company->name }}</option>                              
                            @endforeach
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-company" style="display: none;"></bold>
                    </div>                                            

                    <div class="col-lg-2 col-md-6 col-12">
                      <label for="stockAlert">الحد الأدني للطلب</label>
                      <div>
                          <input type="number" class="form-control dataInput" placeholder="الحد الأدني للطلب" id="stockAlert" name="stockAlert" min="0">
                      </div>
                      <bold class="text-danger" id="errors-stockAlert" style="display: none;"></bold>
                    </div> 

                    <div class="col-lg-2 col-md-6 col-12">
                      <label for="desc">وصف السلعة/الخدمة</label>
                      <div>
                          <input type="text" class="form-control dataInput" placeholder="وصف المنتج" id="desc" name="desc" >
                      </div>
                      <bold class="text-danger" id="errors-desc" style="display: none;"></bold>
                    </div>   
                  </div>
                  <hr>


                  <h5 style="text-decoration: underline;">بيانات السعر والوحدات</h5>
                  <div class="row row-xs">
                    <div class="col-lg-4 col-md-6 col-md-4 col-12">
                      <label for="bigUnit">الوحدة الكبري</label>
                      <div>    
                          <select  name="bigUnit" class="bigUnit selectize" id="bigUnit">
                            <option value="" selected>الوحدة الكبري</option>
                            @foreach ($units as $unit)
                              <option value="{{ $unit->id }}">{{ $unit->name }}</option>                              
                            @endforeach
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-bigUnit" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-4 col-md-6 col-md-4 col-12">
                      <label for="smallUnit">الوحدة الصغري</label>
                      <div>    
                          <select  name="smallUnit" class="smallUnit selectize" id="smallUnit">
                            <option value="" selected>الوحدة الصغري</option>
                            @foreach ($units as $unit)
                              <option value="{{ $unit->id }}">{{ $unit->name }}</option>                              
                            @endforeach
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-smallUnit" style="display: none;"></bold>
                    </div> 

                    <div class="col-lg-4 col-md-6 col-md-4 col-12" id="small_unit_numbers_section">
                      <label for="small_unit_numbers">عدد وحدات الصغري</label>
                      <i class="fas fa-info-circle text-primary" data-bs-toggle="tooltip" title="عدد الوحدات الصغرى التي تُكوِّن وحدة كبرى واحدة من هذا المنتج (مثال: 1 كرتونة = 12 علبة)"></i>
                      <i class="fas fa-star require_input"></i>

                      <div>
                          <input type="number" class="form-control dataInput" placeholder="عدد وحدات الصغري" id="small_unit_numbers" name="small_unit_numbers" min="1">
                      </div>
                      <bold class="text-danger" id="errors-small_unit_numbers" style="display: none;"></bold>
                    </div>  

                    <div class="col-lg-4 col-md-6 col-md-4 col-12">
                        <label for="last_cost_price_small_unit">س الشراء</label>
                        <div>
                            <input type="number" class="form-control dataInput" placeholder="س الشراء" id="last_cost_price_small_unit" name="last_cost_price_small_unit" min="0">
                        </div>
                        <bold class="text-danger" id="errors-last_cost_price_small_unit" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-4 col-md-6 col-md-4 col-12">
                      <label for="sell_price_small_unit">سعر البيع</label>
                      <i class="fas fa-info-circle text-primary" data-bs-toggle="tooltip" title="هذا السعر مخصص لبيع أصغر وحدة ممكنة من هذا المنتج، مثل العبوة أو القطعة أو الجرام بحسب طبيعة المنتج"></i>

                      <div>
                          <input type="number" class="form-control dataInput" placeholder="سعر البيع" id="sell_price_small_unit" name="sell_price_small_unit" min="0">
                      </div>
                      <bold class="text-danger" id="errors-sell_price_small_unit" style="display: none;"></bold>
                    </div>  

                    <div class="col-lg-2 col-md-6 col-md-4 col-12">
                      <label for="type_tax">نوع الضريبة</label>
                        <div>    
                            <select name="type_tax" class="type_tax form-control" id="type_tax">
                                <option value="نسبة">نسبة</option>
                                {{--<option value="قيمة">قيمة</option>--}}
                            </select>
                        </div>
                      <bold class="text-danger" id="errors-type_tax" style="display: none;"></bold>
                    </div>   
                    
                    <div class="col-lg-2 col-md-6 col-md-4 col-12">
                      <label for="tax">الضريبة</label>
                      <div>
                          <input type="number" class="form-control dataInput" placeholder="الضريبة" id="tax" name="tax" min="0">
                      </div>
                      <bold class="text-danger" id="errors-tax" style="display: none;"></bold>
                    </div>   
                    
                    <div class="col-lg-4 col-md-6 col-md-4 col-12">
                      <label for="discountPercentage">أقصي نسبة خصم %</label>
                      <div>
                          <input type="number" class="form-control dataInput" placeholder="أقصي نسبة خصم %" id="discountPercentage" name="discountPercentage" min="0">
                      </div>
                      <bold class="text-danger" id="errors-discountPercentage" style="display: none;"></bold>
                    </div>
                  
                    <div class="col-lg-4 col-md-6 col-md-4 col-12">
                        <label for="max_sale_quantity">أقصي كمية بيع</label>
                        <div>
                            <input type="number" class="form-control dataInput" placeholder="أقصي كمية بيع" id="max_sale_quantity" name="max_sale_quantity" min="0">
                        </div>
                        <bold class="text-danger" id="errors-max_sale_quantity" style="display: none;"></bold>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12" id="firstPeriodCountSection">
                      <label for="firstPeriodCount">رصيد أول مدة</label>
                      <i class="fas fa-info-circle text-primary" data-bs-toggle="tooltip" title="يرجى إدخال رصيد أول المدة لهذا السلعة/الخدمة بعدد الوحدات الصغرى فقط، مثلًا: إذا كانت الكرتونة تحتوي على 12 قطعة، يتم إدخال 12."></i>

                      <div>
                          <input type="number" class="form-control dataInput" placeholder="رصيد أول مدة" id="firstPeriodCount" name="firstPeriodCount" min="0">
                      </div>
                      <bold class="text-danger" id="errors-firstPeriodCount" style="display: none;"></bold>
                    </div>  
                  </div>
                  
                  
                  
                  
                  {{--<hr>--}}
                  {{-- <h5 style="text-decoration: underline;">س ترويجي للسلعة/خدمة</h5> --}}
                  {{--<div class="row">
                    <div class="col-lg-12 col-md-6 col-lg-12 col-md-6 col-12">
                      <div class="card overflow-hidden">
                        <div class="card-body">
                          <div class="panel-group1" id="accordion11">
                            <div class="panel panel-default  mb-4">
                              <div class="panel-heading1 bg bg-warning-gradient ">
                                <h4 class="panel-title1">
                                  <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11" href="#collapseFour1" aria-expanded="false">س ترويجي للسلعة/خدمة</a>
                                </h4>
                              </div>
                              <div id="collapseFour1" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="">
                                <div class="panel-body border">
                                  <div class="row row-xs">
                                    <div class="col-lg-3 col-md-6 col-12">
                                      <label for="offerDiscountStatus">حالة السعر الترويجي</label>
                                      <div>
                                          <select  name="offerDiscountStatus" class="offerDiscountStatus form-control" id="offerDiscountStatus">
                                              <option value="0">معطل</option>
                                              <option value="1">نشط</option>
                                          </select>
                                      </div>
                                      <bold class="text-danger" id="errors-offerDiscountStatus" style="display: none;"></bold>
                                    </div>                        
                
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="offerDiscountPercentage">خصم % </label>
                                        <div>
                                            <input type="text" class="form-control dataInput" placeholder="خصم % " id="offerDiscountPercentage" name="offerDiscountPercentage" >
                                        </div>
                                        <bold class="text-danger" id="errors-offerDiscountPercentage" style="display: none;"></bold>
                                    </div>                        
                                    
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="offerStart">بداية العرض الترويجي</label>
                                        <div>
                                            <input type="text" class="form-control datePicker dataInput" placeholder="بداية العرض الترويجي" id="offerStart" name="offerStart" >
                                        </div>
                                        <bold class="text-danger" id="errors-offerStart" style="display: none;"></bold>
                                    </div>                        
                
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <label for="offerEnd">نهاية العرض الترويجي</label>
                                        <div>
                                            <input type="text" class="form-control datePicker dataInput" placeholder="نهاية العرض الترويجي" id="offerEnd" name="offerEnd" >
                                        </div>
                                        <bold class="text-danger" id="errors-offerEnd" style="display: none;"></bold>
                                    </div>                        
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>--}}




                </div> {{-- pd-30 pd-sm-40 bg-gray-100 --}}

                <div class="modal-footer bg bg-dark">                                               
                    <button type="button" id="save" class="btn btn-success" style="display: none;">
                      حفظ
                      <span class="spinner-border spinner-border-sm spinner_request" role="status" aria-hidden="true"></span>
                    </button>

                    <button type="button" id="update" class="btn btn-success" style="display: none;">
                      تعديل
                      <span class="spinner-border spinner-border-sm spinner_request2" role="status" aria-hidden="true"></span>
                    </button>
                    
                    <button id="closeModal" type="button" class="btn btn-light" data-dismiss="modal">اغلاق</button>
                </div> 

            </form>            
        </div>
      </div>
    </div>
</div>
