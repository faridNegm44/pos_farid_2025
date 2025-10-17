<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{ $pageNameAr }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            <form class="" id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="res_id" value=""/>               
                
                <div class="panel panel-primary tabs-style-2">
                  <div class=" tab-menu-heading">
                    <div class="tabs-menu1">
                      <!-- Tabs -->
                      <ul class="nav panel-tabs main-nav-line" style="justify-content: center;margin-bottom: 10px;text-decoration: underline;">
                        <li><a href="#general" class="nav-link active" data-toggle="tab">عام</a></li>
                        <li><a href="#images" class="nav-link" data-toggle="tab">الصور</a></li>
                        {{--  <li><a href="#mail" class="nav-link" data-toggle="tab">البريد الإلكتروني</a></li>  --}}
                        {{--<li><a href="#social" class="nav-link" data-toggle="tab">التواصل الإجتماعي</a></li>
                        <li><a href="#others" class="nav-link" data-toggle="tab">أخري</a></li>--}}
                      </ul>
                    </div>
                  </div>
                  <div class="panel-body tabs-menu-body border bg-gray-100" style="padding: 30px 30px 50px;">
                    <div class="tab-content">
                        


                        {{--------------------- tab 1 general  ---------------------}}
                        <div class="tab-pane active" id="general">

                          <h5 style="text-decoration: underline;">معلومات أساسية</h5>
                          <div class="row row-xs">
                            <div class="col-lg-4">
                              <label for="app_name" class="main-content-label tx-11 tx-medium tx-gray-600">اسم البرنامج</label>
                              <i class="fas fa-star require_input"></i>
                              <input type="text" class="form-control" placeholder="اسم البرنامج" id="app_name" name="app_name" value="{{ $find['app_name'] }}">
                              <div>
                                <bold class="text-danger" id="errors-app_name" style="display: none;"></bold>
                              </div>
                            </div>
                                
                            <div class="col-lg-8">
                              <label for="description" class="main-content-label tx-11 tx-medium tx-gray-600">الوصف </label>
                              <input type="text" class="form-control" placeholder="الوصف " id="description" name="description" value="{{ $find['description'] }}">
                            </div>                         

                            <div class="col-lg-6">
                              <label for="footer_text" class="main-content-label tx-11 tx-medium tx-gray-600">نص الفوتر</label>
                              <input type="text" class="form-control" placeholder="نص الفوتر" id="footer_text" name="footer_text" value="{{ $find['footer_text'] }}">
                            </div>

                            <div class="col-lg-6">
                              <label for="address" class="main-content-label tx-11 tx-medium tx-gray-600">العنوان</label>
                              <input type="text" class="form-control" placeholder="العنوان" id="address" name="address" value="{{ $find['address'] }}">
                              <div>
                                <bold class="text-danger" id="errors-address" style="display: none;"></bold>
                              </div>
                            </div>

                          </div>                         


                         

                          <br>
                          <h5 style="text-decoration: underline;">معلومات الإتصال</h5>
                          <div class="row row-xs">
                            <div class="col-lg-4">
                              <label for="email" class="main-content-label tx-11 tx-medium tx-gray-600">البريد الإلكتروني</label>
                              <input type="text" class="form-control" placeholder="البريد الإلكتروني" id="email" name="email" value="{{ $find['email'] }}">
                              <div>
                                <bold class="text-danger" id="errors-email" style="display: none;"></bold>
                              </div>
                            </div>
                            
                            <div class="col-lg-4">
                              <label for="phone1" class="main-content-label tx-11 tx-medium tx-gray-600">رقم التلفون الأول</label>
                              <input type="text" class="form-control" placeholder="رقم التلفون الأول" id="phone1" name="phone1" value="{{ $find['phone1'] }}">
                              <div>
                                <bold class="text-danger" id="errors-phone1" style="display: none;"></bold>
                              </div>
                            </div>
                            
                            <div class="col-lg-4">
                              <label for="phone2" class="main-content-label tx-11 tx-medium tx-gray-600">رقم التلفون الثاني</label>
                              <input type="text" class="form-control" placeholder="رقم التلفون الثاني" id="phone2" name="phone2" value="{{ $find['phone2'] }}">
                              <div>
                                <bold class="text-danger" id="errors-phone2" style="display: none;"></bold>
                              </div>
                            </div>
                          </div>
                          
                          
                          
                          
                          <br>
                          <h5 style="text-decoration: underline;">معلومات أخري</h5>
                          <div class="col-lg-12">
                            <label for="policy" class="main-content-label tx-11 tx-medium tx-gray-600">سياسة مكتوبة بالريسيت</label>
                            <textarea name="policy" class="form-control" placeholder="سياسة مكتوبة بالريسيت" style="min-height: 100px;">{!! $find['policy'] !!}</textarea>
                            <div>
                              <bold class="text-danger" id="errors-policy" style="display: none;"></bold>
                            </div>
                          </div>
                          
                          {{--<h5 style="text-decoration: underline;">معلومات أخري</h5>
                          <div class="row row-xs">
                            <div class="col-lg-3">
                              <label for="cost_price" class="main-content-label tx-11 tx-medium tx-gray-600">طريقه حساب التكلفة</label>

                              <select class="form-control" placeholder="طريقه حساب التكلفة" id="cost_price" name="cost_price">
                                <option value="1" {{ $find['cost_price'] == 1 ? 'selected' : '' }}>أخر سعر تكلفة</option>
                                <option value="2" {{ $find['cost_price'] == 2 ? 'selected' : '' }}>متوسط سعر تكلفة</option>
                              </select>
                              <div>
                                <bold class="text-danger" id="errors-cost_price" style="display: none;"></bold>
                              </div>
                            </div>
                            
                          </div>--}}
                        </div>







                        {{--------------------- tab 2 images ---------------------}}
                        <div class="tab-pane" id="images">
                          <h5 style="text-decoration: underline;">الصور</h5>
                          <div class="row row-xs">
                            <div class="col-lg-6">
                              <label for="logo" class="main-content-label tx-11 tx-medium tx-gray-600">صورة لوحة التحكم</label>
                              <i class="fas fa-star require_input"></i>
                              <input type="file" class="form-control" id="logo" name="logo">
                              <input type="hidden"  name="logo_hidden" value="{{ $find['logo'] }}">
                              <img class="w-100" src="{{ url('back/images/settings/'.$find['logo']) }}" height="300" alt="logo">
                              
                              <div style="padding: 7px 0;">
                                <bold class="text-danger" id="errors-logo" style="display: none;"></bold>
                              </div>
                            </div>
                            
                            <div class="col-lg-6">
                              <label for="fav_icon" class="main-content-label tx-11 tx-medium tx-gray-600">fav icon</label>
                              <i class="fas fa-star require_input"></i>
                              <input type="file" class="form-control"  id="fav_icon" name="fav_icon">
                              <input type="hidden"  name="fav_icon_hidden" value="{{ $find['fav_icon'] }}">
                              <img class="w-100" src="{{ url('back/images/settings/'.$find['fav_icon']) }}" height="300" alt="fav_icon">
                              
                              <div style="padding: 7px 0;">
                                <bold class="text-danger" id="errors-fav_icon" style="display: none;"></bold>
                              </div>
                            </div>
                          </div>
                        </div>



                        

                      
                        {{--------------------- tab 3 mail ---------------------}}
                        {{--  <div class="tab-pane" id="mail">
                          
                          
                        </div>  --}}






                        {{--------------------- tab 4 social ---------------------}}
                        {{--<div class="tab-pane" id="social">
                          <h5 style="text-decoration: underline;">التواصل الإجتماعي</h5>
                          <div class="row row-xs">
                            <div class="col-lg-6">
                              <label for="facebook" class="main-content-label tx-11 tx-medium tx-gray-600">فيس بوك</label>
                              <input type="text" class="form-control" placeholder="فيس بوك" id="facebook" name="facebook" value="{{ $find['facebook'] }}">
                              <div>
                                <bold class="text-danger" id="errors-facebook" style="display: none;"></bold>
                              </div>
                            </div>
                            
                            <div class="col-lg-6">
                              <label for="instagram" class="main-content-label tx-11 tx-medium tx-gray-600">انستجرام</label>
                              <input type="text" class="form-control" placeholder="انستجرام" id="instagram" name="instagram" value="{{ $find['instagram'] }}">
                              <div>
                                <bold class="text-danger" id="errors-instagram" style="display: none;"></bold>
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <label for="tiktok" class="main-content-label tx-11 tx-medium tx-gray-600">تيك توك</label>
                              <input type="text" class="form-control" placeholder="تيك توك" id="tiktok" name="tiktok" value="{{ $find['tiktok'] }}">
                              <div>
                                <bold class="text-danger" id="errors-tiktok" style="display: none;"></bold>
                              </div>
                            </div>
                            
                            <div class="col-lg-6">
                              <label for="twitter" class="main-content-label tx-11 tx-medium tx-gray-600">تويتر</label>
                              <input type="text" class="form-control" placeholder="تويتر" id="twitter" name="twitter" value="{{ $find['twitter'] }}">
                              <div>
                                <bold class="text-danger" id="errors-twitter" style="display: none;"></bold>
                              </div>
                            </div>
                                                      
                            <div class="col-lg-6">
                              <label for="google" class="main-content-label tx-11 tx-medium tx-gray-600">جوجل</label>
                              <input type="text" class="form-control" placeholder="جوجل" id="google" name="google" value="{{ $find['google'] }}">
                              <div>
                                <bold class="text-danger" id="errors-google" style="display: none;"></bold>
                              </div>
                            </div>                        
                            
                            <div class="col-lg-6">
                              <label for="youtube" class="main-content-label tx-11 tx-medium tx-gray-600">يوتيوب</label>
                              <input type="text" class="form-control" placeholder="يوتيوب" id="youtube" name="youtube" value="{{ $find['youtube'] }}">
                              <div>
                                <bold class="text-danger" id="errors-youtube" style="display: none;"></bold>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                        --}}
                        
                        
                        
                        {{--------------------- tab 5 others ---------------------}}
                        {{--<div class="tab-pane" id="others">
                          <h5 style="text-decoration: underline;">أخري</h5>
                          <div class="row row-xs">
                            <div class="col-lg-6" style="margin-bottom: 10px;">
                              <label for="enable_reviews" class="main-content-label tx-11 tx-medium tx-gray-600">التعليقات والتقيمات</label>
                              <div>
                                <input type="checkbox" class="form-control" id="enable_reviews" name="enable_reviews" {{ $find['enable_reviews'] == 1 ? 'checked' :  '' }} style="width: 20px;height: 20px;display: inline;position: relative;top: 5px;margin-left: 5px;">
                                <span>السماح للعملاء بإعطاء المراجعات والتقييمات</span>
                              </div>
                            </div>
                            
                            <div class="col-lg-6" style="margin-bottom: 10px;">
                              <label for="auto_approve_reviews" class="main-content-label tx-11 tx-medium tx-gray-600">الموافقة التلفائية علي المراجعات</label>
                              <div>
                                <input type="checkbox" class="form-control" id="auto_approve_reviews" name="auto_approve_reviews" {{ $find['auto_approve_reviews'] == 1 ? 'checked' :  '' }} style="width: 20px;height: 20px;display: inline;position: relative;top: 5px;margin-left: 5px;">
                                <span>ستتم الموافقة على مراجعات العملاء تلقائيًا</span>
                              </div>
                            </div>
                            
                            <div class="col-lg-6" style="margin-bottom: 10px;">
                              <label for="accept_cookies" class="main-content-label tx-11 tx-medium tx-gray-600">ملفات ال cookies</label>
                              <div>
                                <input type="checkbox" class="form-control" id="accept_cookies" name="accept_cookies" {{ $find['accept_cookies'] == 1 ? 'checked' :  '' }} style="width: 20px;height: 20px;display: inline;position: relative;top: 5px;margin-left: 5px;">
                                <span>إظهار شريط ملفات تعريف الارتباط في موقع الويب الخاص بك</span>
                              </div>
                            </div>
                            
                            <div class="col-lg-6" style="margin-bottom: 10px;">
                              <label for="maintenance_mode" class="main-content-label tx-11 tx-medium tx-gray-600">وضع الصيانة</label>
                              <div>
                                <input type="checkbox" class="form-control" id="maintenance_mode" name="maintenance_mode" {{ $find['maintenance_mode'] == 1 ? 'checked' :  '' }} style="width: 20px;height: 20px;display: inline;position: relative;top: 5px;margin-left: 5px;">
                                <span>ضع التطبيق في وضع الصيانة</span>
                              </div>
                            </div>
                          </div>

                          <br>
                          <h5 style="text-decoration: underline;">لينك الخريطة</h5>
                          <div class="row row-xs">
                            <div class="col-12">
                              <label for="map_location" class="main-content-label tx-11 tx-medium tx-gray-600">لينك الخريطة</label>
                              <textarea class="form-control" placeholder="لينك الخريطة" id="map_location" name="map_location" rows="5">{{ $find['map_location'] }}</textarea>
                              <div>
                                <bold class="text-danger" id="errors-map_location" style="display: none;"></bold>
                              </div>
                            </div>
                                                        
                          </div>
                          
                        </div>--}}


                    </div>
                  </div>
                </div>
              

                <div class="modal-footer bg bg-dark">                                               
                  <button type="button" id="update" class="btn btn-success">
                      حفظ
                      <span class="spinner-border spinner-border-sm spinner_request2" role="status" aria-hidden="true"></span>
                    </button>
                          
                    <button id="closeModal" type="button" class="btn btn-light" data-dismiss="modal">اغلاق</button>
              </div>

            </form>            
        </div>
      </div>
    </div>
</div>
