<!--Horizontal-main -->
<div class="sticky">
    <div class="horizontal-main hor-menu clearfix side-header">
        <div class="horizontal-mainwrapper container clearfix">
            <!--Nav-->
            <nav class="horizontalMenu clearfix">
                <ul class="horizontalMenu-list">
                    {{-- <li aria-haspopup="true"><a href="#" class="sub-icon"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/></svg> العملاء/الموردين<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <div class="horizontal-megamenu clearfix">
                            <div class="container">
                                <div class="mega-menubg hor-mega-menu">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12 link-list">
                                            <ul>
                                                <li><h3 class="fs-14 font-weight-bold mb-1 mt-2">العملاء</h3></li>
                                                <li aria-haspopup="true"><a href="alerts.html" class="slide-item">العملاء</a></li>
                                                <li aria-haspopup="true"><a href="avatar.html" class="slide-item">كشف حساب العملاء</a></li>
                                                <li aria-haspopup="true"><a href="breadcrumbs.html" class="slide-item">تقرير حساب العملاء</a></li>
                                                <li aria-haspopup="true"><a href="buttons.html" class="slide-item">المدغوعات الشهرية للعملاء</a></li>
                                            </ul>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-12 col-xs-12 link-list">
                                            <ul>
                                                <li><h3 class="fs-14 font-weight-bold mb-1 mt-2">الموردين</h3></li>
                                                <li aria-haspopup="true"><a href="alerts.html" class="slide-item">الموردين</a></li>
                                                <li aria-haspopup="true"><a href="avatar.html" class="slide-item">كشف حساب الموردين</a></li>
                                                <li aria-haspopup="true"><a href="breadcrumbs.html" class="slide-item">تقرير حساب الموردين</a></li>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> --}}

                    <li aria-haspopup="true">
                        <a href="#" class="sub-icon">تعريفات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('financialYears') }}" class="slide-item">السنوات المالية</a></li>
                            <li aria-haspopup="true"><a href="{{ url('financialStorages') }}" class="slide-item">الخزائن المالية</a></li>
                        </ul>
                    </li>

                    
                    <li aria-haspopup="true"><a href="#" class="sub-icon">مخازن<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item">Morris Charts</a></li>
                            <li aria-haspopup="true"><a href="chart-flot.html" class="slide-item">Flot Charts</a></li>
                            <li aria-haspopup="true"><a href="chart-chartjs.html" class="slide-item">ChartJS</a></li>
                            <li aria-haspopup="true"><a href="chart-echart.html" class="slide-item">Echart</a></li>
                            <li aria-haspopup="true"><a href="chart-sparkline.html" class="slide-item">Sparkline</a></li>
                            <li aria-haspopup="true"><a href="chart-peity.html" class="slide-item"> Chart-peity</a></li>
                        </ul>
                    </li>

                    <li aria-haspopup="true"><a href="#" class="sub-icon">خزينة<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item">Morris Charts</a></li>
                            <li aria-haspopup="true"><a href="chart-flot.html" class="slide-item">Flot Charts</a></li>
                            <li aria-haspopup="true"><a href="chart-chartjs.html" class="slide-item">ChartJS</a></li>
                            <li aria-haspopup="true"><a href="chart-echart.html" class="slide-item">Echart</a></li>
                            <li aria-haspopup="true"><a href="chart-sparkline.html" class="slide-item">Sparkline</a></li>
                            <li aria-haspopup="true"><a href="chart-peity.html" class="slide-item"> Chart-peity</a></li>
                        </ul>
                    </li>

                    <li aria-haspopup="true"><a href="#" class="sub-icon">مبيعات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true" class="slide-item sub-menu-sub"><a href="#">العملاء</a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="#" class="slide-item">العملاء</a></li>
                                    <li aria-haspopup="true"><a href="#" class="slide-item">حسابات العملاء</a></li>
                                    <li aria-haspopup="true"><a href="#" class="slide-item">تصدير العملاء إلي ملف إكسيل</a></li>
                                    <li aria-haspopup="true"><a href="#" class="slide-item">إستيراد العملاء من ملف إكسيل</a></li>
                                    <li aria-haspopup="true"><a href="#" class="slide-item">تصدير ديون العملاء إلي ملف إكسيل</a></li>

                                </ul>
                            </li>                                                        
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item">فاتورة مبيعات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item">تعديل فاتورة مبيعات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item">مرتجع بيع</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item">مرتجع بيع بدون فاتورة</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item">تعديل مرتجع مبيعات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item">كشكول النواقص</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item">عرض أسعار</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item">المندوبون</a></li>
                        </ul>
                    </li>

                    <li aria-haspopup="true"><a href="#" class="sub-icon">مشتريات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="products.html" class="slide-item"></a></li>
                            <li aria-haspopup="true"><a href="product-details.html" class="slide-item">فاتورة مشتريات</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item">تعديل فاتورة مشتريات</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item">مرتجع فاتورة مشتريات</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item">مرتجع مشتريات بدون فاتورة</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item">تعديل مرتجع مشتريات</a></li>
                            <li aria-haspopup="true" class="slide-item sub-menu-sub"><a href="#">الموردين</a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="#" class="slide-item">الموردين</a></li>
                                    <li aria-haspopup="true"><a href="#" class="slide-item">حسابات الموردين</a></li>
                                    <li aria-haspopup="true"><a href="#" class="slide-item">طلبيات مورد</a></li>
                                    <li aria-haspopup="true"><a href="#" class="slide-item">إشعار خصم أو إضافة لمورد</a></li>
                                    <li aria-haspopup="true"><a href="#" class="slide-item">نصدير ديون الموردين إلي ملف إكسيل</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li aria-haspopup="true"><a href="#" class="sub-icon">شؤن العاملين<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">                            
                            <li aria-haspopup="true" class="slide-item sub-menu-sub"><a href="#">الموظفين</a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="#" class="slide-item">الموظفين</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li aria-haspopup="true"><a href="#" class="slide-item">تقرير الموظفين</a></li>
                                </ul>
                            </li>

                            <div class="dropdown-divider"></div>

                            <li aria-haspopup="true" class="slide-item sub-menu-sub"><a href="#">مستخدمين النظام</a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="#" class="slide-item">مستخدمين النظام</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li aria-haspopup="true"><a href="#" class="slide-item">تقرير المستخدمين</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li aria-haspopup="true"><a href="#" class="sub-icon">الإعدادات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true" class="slide-item sub-menu-sub"><a href="#">إعدادات البرنامج</a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="#" class="slide-item">إعدادات البرنامج</a></li>
                                </ul>
                            </li>
                            
                            <li aria-haspopup="true" class="slide-item sub-menu-sub"><a href="#">إعدادات المستخدمين</a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="#" class="slide-item">إعدادات المستخدمين</a></li>
                                </ul>
                            </li>
                            
                            <li aria-haspopup="true" class="slide-item sub-menu-sub"><a href="#">نسخة احتياطية</a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="#" class="slide-item">نسخة احتياطية</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>


                </ul>
            </nav>
            <!--Nav-->
        </div>
    </div>
</div>
<!--Horizontal-main -->