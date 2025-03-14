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
                  <h5 style="text-decoration: underline;font-weight: bold;">بيانات أساسية</h5>
                  <div class="row row-xs">
                    <div class="col-lg-1 col-12">
                        <label for="last_code">ك الصنف</label>
                        <div>
                            <input type="text" readonly class="form-control" placeholder="ك الصنف" id="last_code" name="last_code" value="{{ $lastId }}">
                        </div>
                        <bold class="text-danger" id="errors-last_code" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-1 col-12">
                        <label for="shortCode">ك مختصر</label>
                        <div>
                            <input type="text" class="form-control dataInput" placeholder="ك مختصر" id="shortCode" name="shortCode" >
                        </div>
                        <bold class="text-danger" id="errors-shortCode" style="display: none;"></bold>
                    </div>                        
                    
                    <div class="col-lg-2 col-12">
                        <label for="natCode">ك دولي</label>
                        <div>
                            <input type="text" class="form-control dataInput" placeholder="ك دولي" id="natCode" name="natCode" >
                        </div>
                        <bold class="text-danger" id="errors-natCode" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-3 col-12">
                        <label for="nameAr">إسم الصنف بالعربية</label>
                        <i class="fas fa-star require_input"></i>
                        <div>
                            <input type="text" class="form-control dataInput" placeholder="إسم الصنف بالعربية" id="nameAr" name="nameAr" data-autofocus >
                        </div>
                        <bold class="text-danger" id="errors-nameAr" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-3 col-12">
                        <label for="nameEn">إسم الصنف بالأجنبية</label>
                        <div>
                            <input type="text" class="form-control dataInput" placeholder="إسم الصنف بالأجنبية" id="nameEn" name="nameEn" >
                        </div>
                        <bold class="text-danger" id="errors-nameEn" style="display: none;"></bold>
                    </div>        
                    
                    <div class="col-lg-2 col-12">
                      <label for="status">حالة الصنف</label>
                      {{-- <div>
                          <input type="text" class="form-control dataInput" placeholder="إسم الصنف بالأجنبية" id="nameEn" name="nameEn" >
                      </div> --}}

                        <div>    
                            <select  name="status" class="status form-control" id="status">
                                <option value="1">نشط</option>
                                <option value="0">معطل</option>
                            </select>
                        </div>
                      <bold class="text-danger" id="errors-status" style="display: none;"></bold>
                    </div>  

                    <div class="col-lg-2 col-12">
                      <label for="store">المخزن</label>
                      <i class="fas fa-star require_input"></i>
                      <div>    
                          <select  name="store" class="store selectize" id="store">
                            <option value="" selected>المخزن</option>                              
                            @foreach ($stores as $store)
                              <option value="{{ $store->id }}">{{ $store->name }}</option>                              
                            @endforeach
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-store" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-2 col-12">
                      <label for="category">قسم الصنف</label>
                      <div>    
                          <select  name="category" class="category selectize" id="category">
                            <option value="" selected>قسم الصنف</option>                              
                            @foreach ($productCategoys as $categoy)
                              <option value="{{ $categoy->id }}">{{ $categoy->name }}</option>                              
                            @endforeach
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-category" style="display: none;"></bold>
                    </div>                        

                    <div class="col-lg-2 col-12">
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

                    <div class="col-lg-2 col-12">
                      <label for="firstPeriodCount">رصيد أول مدة</label>
                      <div>
                          <input type="text" class="form-control dataInput" placeholder="رصيد أول مدة" id="firstPeriodCount" name="firstPeriodCount" value="0">
                      </div>
                      <bold class="text-danger" id="errors-firstPeriodCount" style="display: none;"></bold>
                  </div>    

                    <div class="col-lg-2 col-12">
                      <label for="stockAlert">الحد الأدني للطلب</label>
                      <div>
                          <input type="text" class="form-control dataInput" placeholder="الحد الأدني للطلب" id="stockAlert" name="stockAlert" value="0">
                      </div>
                      <bold class="text-danger" id="errors-stockAlert" style="display: none;"></bold>
                    </div> 

                    <div class="col-lg-2 col-12">
                      <label for="divisible">قابل للتجزئة</label>
                      <div>    
                          <select  name="divisible" class="divisible form-control" id="divisible">
                              <option value="0">لاء</option>
                              <option value="1">نعم</option>
                          </select>
                      </div>
                      <bold class="text-danger" id="errors-divisible" style="display: none;"></bold>
                    </div> 

                    <div class="col-lg-8 col-12">
                      <label for="desc">وصف الصنف</label>
                      <div>
                          <input type="text" class="form-control dataInput" placeholder="وصف المنتج" id="desc" name="desc" >
                      </div>
                      <bold class="text-danger" id="errors-desc" style="display: none;"></bold>
                    </div>   

                    <div class="col-lg-4 col-12">
                      <label for="image">صورة الصنف</label>
                      <div>
                          <input type="file" class="form-control dataInput" placeholder="صورة الصنف" id="image" name="image" >
                      </div>
                      <bold class="text-danger" id="errors-image" style="display: none;"></bold>
                    </div>   
                  </div>
                  <hr>




                  <h5 style="text-decoration: underline;font-weight: bold;">بيانات السعر والوحدات</h5>
                  <div class="row row-xs">

                    {{-- start right --}}
                    <div class="col-lg-6 col-12">
                      <div class="row row-xs">
                        <div class="col-lg-4 col-12">
                            <label for="sellPrice">س البيع</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="text" class="form-control dataInput" placeholder="س البيع" id="sellPrice" name="sellPrice" >
                            </div>
                            <bold class="text-danger" id="errors-sellPrice" style="display: none;"></bold>
                        </div>                        
                        
                        <div class="col-lg-4 col-12">
                            <label for="purchasePrice">س الشراء</label>
                            <div>
                                <input type="text" class="form-control dataInput" placeholder="س الشراء" id="purchasePrice" name="purchasePrice" >
                            </div>
                            <bold class="text-danger" id="errors-purchasePrice" style="display: none;"></bold>
                        </div>                        
    
                        <div class="col-lg-4 col-12">
                          <label for="tax">الضريبة</label>
                          <div>
                              <input type="text" class="form-control dataInput" placeholder="الضريبة" id="tax" name="tax" value="0">
                          </div>
                          <bold class="text-danger" id="errors-tax" style="display: none;"></bold>
                        </div>   
                        
                        <div class="col-lg-4 col-12">
                          <label for="discountPercentage">أقصي نسبة خصم %</label>
                          <i class="fas fa-star require_input"></i>
                          <div>
                              <input type="text" class="form-control dataInput" placeholder="أقصي نسبة خصم %" id="discountPercentage" name="discountPercentage" value="0">
                          </div>
                          <bold class="text-danger" id="errors-discountPercentage" style="display: none;"></bold>
                        </div>
                      
                        <div class="col-lg-4 col-12">
                            <label for="max_sale_quantity">أقصي كمية بيع</label>
                            <i class="fas fa-star require_input"></i>
                            <div>
                                <input type="text" class="form-control dataInput" placeholder="أقصي كمية بيع" id="max_sale_quantity" name="max_sale_quantity" value="0">
                            </div>
                            <bold class="text-danger" id="errors-max_sale_quantity" style="display: none;"></bold>
                        </div>
                        
                      </div>
                    </div>
                    {{-- end right --}}


                    {{-- start left --}}
                    <div class="col-lg-6 col-12">
                      <div class="row row-xs">
                        <div class="col-lg-4 col-12">
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
    
                        <div class="col-lg-4 col-12">
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
    
                        <div class="col-lg-4 col-12">
                          <label for="smallUnitPrice">سعر وحدة الصغري</label>
                          <div>
                              <input type="text" class="form-control dataInput" placeholder="سعر وحدة الصغري" id="smallUnitPrice" name="smallUnitPrice" >
                          </div>
                          <bold class="text-danger" id="errors-smallUnitPrice" style="display: none;"></bold>
                        </div>                        
                      
                        <div class="col-lg-4 col-12">
                          <label for="smallUnitNumbers">عدد وحدات الصغري</label>
                          <div>
                              <input type="text" class="form-control dataInput" placeholder="عدد وحدات الصغري" id="smallUnitNumbers" name="smallUnitNumbers" >
                          </div>
                          <bold class="text-danger" id="errors-smallUnitNumbers" style="display: none;"></bold>
                        </div>                    

                      </div>
                    </div>
                    {{-- end left --}}
                  
                  </div>
                  
                  
                  
                  
                  {{--<hr>--}}
                  {{-- <h5 style="text-decoration: underline;font-weight: bold;">س ترويجي للصنف</h5> --}}
                  {{--<div class="row">
                    <div class="col-lg-12 col-lg-12 col-12">
                      <div class="card overflow-hidden">
                        <div class="card-body">
                          <div class="panel-group1" id="accordion11">
                            <div class="panel panel-default  mb-4">
                              <div class="panel-heading1 bg bg-warning-gradient ">
                                <h4 class="panel-title1">
                                  <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion11" href="#collapseFour1" aria-expanded="false">س ترويجي للصنف</a>
                                </h4>
                              </div>
                              <div id="collapseFour1" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="">
                                <div class="panel-body border">
                                  <div class="row row-xs">
                                    <div class="col-lg-3 col-12">
                                      <label for="offerDiscountStatus">حالة السعر الترويجي</label>
                                      <div>
                                          <select  name="offerDiscountStatus" class="offerDiscountStatus form-control" id="offerDiscountStatus">
                                              <option value="0">معطل</option>
                                              <option value="1">نشط</option>
                                          </select>
                                      </div>
                                      <bold class="text-danger" id="errors-offerDiscountStatus" style="display: none;"></bold>
                                    </div>                        
                
                                    <div class="col-lg-3 col-12">
                                        <label for="offerDiscountPercentage">خصم % </label>
                                        <div>
                                            <input type="text" class="form-control dataInput" placeholder="خصم % " id="offerDiscountPercentage" name="offerDiscountPercentage" >
                                        </div>
                                        <bold class="text-danger" id="errors-offerDiscountPercentage" style="display: none;"></bold>
                                    </div>                        
                                    
                                    <div class="col-lg-3 col-12">
                                        <label for="offerStart">بداية العرض الترويجي</label>
                                        <div>
                                            <input type="text" class="form-control datePicker dataInput" placeholder="بداية العرض الترويجي" id="offerStart" name="offerStart" >
                                        </div>
                                        <bold class="text-danger" id="errors-offerStart" style="display: none;"></bold>
                                    </div>                        
                
                                    <div class="col-lg-3 col-12">
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
