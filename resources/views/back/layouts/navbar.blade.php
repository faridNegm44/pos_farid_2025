<!--Horizontal-main -->
<div class="sticky">
    <div class="horizontal-main hor-menu clearfix side-header">
        <div class="horizontal-mainwrapper container clearfix">
            <!--Nav-->
            <nav class="horizontalMenu clearfix">
                <ul class="horizontalMenu-list">
                    {{-- <li aria-haspopup="true"><a href="#" class="sub-icon text-primary"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/></svg> العملاء/الموردين<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <div class="horizontal-megamenu clearfix">
                            <div class="container-fluid">
                                <div class="mega-menubg hor-mega-menu">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12 link-list">
                                            <ul>
                                                <li><h3 class="fs-14 font-weight-bold mb-1 mt-2">العملاء</h3></li>
                                                <li aria-haspopup="true"><a href="alerts.html" class="slide-item text-primary">العملاء</a></li>
                                                <li aria-haspopup="true"><a href="avatar.html" class="slide-item text-primary">كشف حساب العملاء</a></li>
                                                <li aria-haspopup="true"><a href="breadcrumbs.html" class="slide-item text-primary">تقرير حساب العملاء</a></li>
                                                <li aria-haspopup="true"><a href="buttons.html" class="slide-item text-primary">المدغوعات الشهرية للعملاء</a></li>
                                            </ul>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-12 col-xs-12 link-list">
                                            <ul>
                                                <li><h3 class="fs-14 font-weight-bold mb-1 mt-2">الموردين</h3></li>
                                                <li aria-haspopup="true"><a href="alerts.html" class="slide-item text-primary">الموردين</a></li>
                                                <li aria-haspopup="true"><a href="avatar.html" class="slide-item text-primary">كشف حساب الموردين</a></li>
                                                <li aria-haspopup="true"><a href="breadcrumbs.html" class="slide-item text-primary">تقرير حساب الموردين</a></li>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> --}}

                  
                    <li aria-haspopup="true"><a href="{{ url('products') }}" class="sub-icon text-primary">الأصناف/المخازن<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('products') }}" class="slide-item text-primary">الأصناف</a></li>
                            <li aria-haspopup="true"><a href="{{ url('productsCategories') }}" class="slide-item text-primary">أقسام الأصناف</a></li>
                            <li aria-haspopup="true"><a href="{{ url('units') }}" class="slide-item text-primary">وحدات الأصناف</a></li>
                            <li aria-haspopup="true"><a href="{{ url('companies') }}" class="slide-item text-primary">شركات الأصناف</a></li>
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('stores') }}" class="slide-item text-primary">المخازن</a></li>
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('transfer_between_stores') }}" class="slide-item text-primary">تحويلات الأصناف بين المخازن</a></li>
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('taswea_products') }}" class="slide-item text-primary">الهالك / تسوية أصناف</a></li>
                            {{--<li aria-haspopup="true"><a href="chart-echart.html" class="slide-item text-primary">المواد الخام</a></li>--}}
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('products/report') }}" class="slide-item text-primary">تقرير عن حركة صنف</a></li>
                        </ul>
                    </li>

                    <li aria-haspopup="true">
                        <a href="#" class="sub-icon text-primary">الأشخاص<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('clients') }}" class="slide-item text-primary">العملاء</a></li>
                            <li aria-haspopup="true"><a href="{{ url('suppliers') }}" class="slide-item text-primary">الموردين</a></li>
                        </ul>
                    </li>
                    
                    <li aria-haspopup="true"><a href="#" class="sub-icon text-primary">الحسابات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">                            
                            <li aria-haspopup="true"><a href="{{ url('financial_treasury') }}" class="slide-item text-primary">الخزائن المالية</a></li>
                            <li aria-haspopup="true"><a href="{{ url('transfer_between_storages') }}" class="slide-item text-primary">التحويل من خزنة لآخري</a></li>
                            <li aria-haspopup="true"><a href="{{ url('financial_treasury') }}" class="slide-item text-primary">مسحوبات شخصية</a></li>
                            <li aria-haspopup="true"><a href="{{ url('expenses') }}" class="slide-item text-primary">مصاريف عامة</a></li>
                            <li aria-haspopup="true"><a href="{{ url('financial_treasury') }}" class="slide-item text-primary">إغلاق وردية</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('treasury_bills') }}" class="slide-item text-primary">معاملات الخزينة المالية</a></li>
                            <li aria-haspopup="true"><a href="{{ url('treasury_bills/create') }}" class="slide-item text-primary">أجراء معاملة في الخزينة المالية</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('treasury_bills/report') }}" class="slide-item text-primary">تقرير عن حركة الخزائن المالية</a></li>
                        </ul>
                    </li>

                    <li aria-haspopup="true"><a href="{{ url('/') }}" class="sub-icon text-primary">مبيعات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">                                          
                            <li aria-haspopup="true"><a href="#" class="slide-item text-primary">العملاء</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-primary">حسابات العملاء</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-primary">تصدير العملاء إلي ملف إكسيل</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-primary">إستيراد العملاء من ملف إكسيل</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-primary">تصدير ديون العملاء إلي ملف إكسيل</a></li>

                            <hr class="navbar_hr"/>

                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-primary">فاتورة مبيعات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-primary">تعديل فاتورة مبيعات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-primary">مرتجع بيع</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-primary">مرتجع بيع بدون فاتورة</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-primary">تعديل مرتجع مبيعات</a></li>
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('products/report/stock_alert') }}" class="slide-item text-primary">كشكول النواقص</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-primary">عرض أسعار</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-primary">المندوبون</a></li>
                        </ul>
                    </li>

                    <li aria-haspopup="true"><a href="{{ url('/') }}" class="sub-icon text-primary">مشتريات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('/purchases/create') }}" class="slide-item text-primary">إضافة فاتورة مشتريات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/purchases') }}" class="slide-item text-primary">فواتير المشتريات</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item text-primary">تعديل فاتورة مشتريات</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item text-primary">مرتجع فاتورة مشتريات</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item text-primary">مرتجع مشتريات بدون فاتورة</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item text-primary">تعديل مرتجع مشتريات</a></li>
                            
                            <hr class="navbar_hr"/>
                            
                            <li aria-haspopup="true"><a href="#" class="slide-item text-primary">الموردين</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-primary">حسابات الموردين</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-primary">طلبيات مورد</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-primary">إشعار خصم أو إضافة لمورد</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-primary">نصدير ديون الموردين إلي ملف إكسيل</a></li>
                        </ul>
                    </li>

                    <li aria-haspopup="true"><a href="{{ url('/') }}" class="sub-icon text-primary">الموظفين<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('/users') }}" class="slide-item text-primary">مستخدمين النظام</a></li>
                        </ul>
                    </li>

                    <li aria-haspopup="true"><a href="{{ url('/') }}" class="sub-icon text-primary">الإعدادات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('financialYears') }}" class="slide-item text-primary">السنوات المالية</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/settings') }}" class="slide-item text-primary">إعدادات البرنامج</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-primary">إعدادات المستخدمين</a></li>
                        </ul>
                    </li>


                </ul>
            </nav>
            <!--Nav-->
        </div>
    </div>
</div>
<!--Horizontal-main -->