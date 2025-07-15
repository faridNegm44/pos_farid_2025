<!--Horizontal-main -->
<div class="sticky">
    <div class="horizontal-main hor-menu clearfix side-header bg bg-primary-gradient" style="background-image: linear-gradient(to left, #194a61 0, #0698bf 100%) !important;">
        <div class="horizontal-mainwrapper container clearfix">
            <!--Nav-->
            <nav class="horizontalMenu clearfix">
                <ul class="horizontalMenu-list bg bg-primary-gradient" style="background-image: linear-gradient(to left, #194a61 0, #0698bf 100%) !important;">
                                   
                    <li aria-haspopup="true"><a href="{{ url('products') }}" class="sub-icon text-light">اعدادات البيانات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('financialYears') }}" class="slide-item text-dark">الفترات المالية</a></li>
                            {{--<li aria-haspopup="true"><a href="{{ url('wesd') }}" class="slide-item text-dark">اصول النشاط</a></li>--}}
                            {{--<li aria-haspopup="true"><a href="{{ url('ssdd') }}" class="slide-item text-dark">تبويبات المصروفات</a></li>--}}
                            {{--<li aria-haspopup="true"><a href="{{ url('e3ed') }}" class="slide-item text-dark">قوائم الاسعار</a></li>--}}
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('stores') }}" class="slide-item text-dark">المخازن</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('financial_treasury') }}" class="slide-item text-dark">الخزائن المالية</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('units') }}" class="slide-item text-dark">وحدات السلع والخدمات</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('companies') }}" class="slide-item text-dark">شركات السلع والخدمات</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('productsCategories') }}" class="slide-item text-dark">المجموعات الرئيسية للسلع والخدمات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('products_sub_category') }}" class="slide-item text-dark">المجموعات الفرعية للسلع والخدمات</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('products') }}" class="slide-item text-dark">السلع والخدمات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('products/report') }}" class="slide-item text-dark">تقرير عن حركة سلعة/خدمة</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('taswea_products') }}" class="slide-item text-dark">تسوية كميات السلع والخدمات</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('transfer_between_stores') }}" class="slide-item text-dark">تحويلات السلع والخدمات بين المخازن</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('inventories') }}" class="slide-item text-dark">إدارة الجرد</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('extra_expenses') }}" class="slide-item text-dark">المصاريف الإضافية علي الفواتير</a></li>
                        </ul>
                    </li>                    
                    
                    <li aria-haspopup="true"><a href="{{ url('clients') }}" class="sub-icon text-light">الجهات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('clients') }}" class="slide-item text-dark">العملاء</a></li>
                            <li aria-haspopup="true"><a href="{{ url('clients/report') }}" class="slide-item text-dark">تقرير عن حركة عميل</a></li>
                            <li aria-haspopup="true"><a href="{{ url('clients/report/account_statement') }}" class="slide-item text-dark">كشف حساب عميل</a></li>

                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('suppliers') }}" class="slide-item text-dark">الموردين</a></li>
                            <li aria-haspopup="true"><a href="{{ url('suppliers/report') }}" class="slide-item text-dark">تقرير عن حركة مورد</a></li>                            
                            <li aria-haspopup="true"><a href="{{ url('suppliers/report/account_statement') }}" class="slide-item text-dark">كشف حساب مورد</a></li>
                                                        
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('taswea_client_supplier') }}" class="slide-item text-dark">تسوية رصيد عميل / مورد</a></li> 

                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('partners') }}" class="slide-item text-dark">الشركاء</a></li>
                            <li aria-haspopup="true"><a href="{{ url('partners/report') }}" class="slide-item text-dark">تقرير عن حركة شريك</a></li> 
                            <li aria-haspopup="true"><a href="{{ url('partners/report/account_statement') }}" class="slide-item text-dark">كشف حساب شريك</a></li>                           
                            <li aria-haspopup="true"><a href="{{ url('taswea_partners') }}" class="slide-item text-dark">تسوية رصيد شريك</a></li>
                        </ul>
                    </li>

                    {{--<li aria-haspopup="true"><a href="{{ url('settings') }}" class="sub-icon text-light">المعاملات المخزنية<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('dddddddddddd') }}" class="slide-item text-dark">المعاملات المخزنية</a></li>
                        </ul>
                    </li>--}}
                    
                    
                    {{--<li aria-haspopup="true"><a href="{{ url('products') }}" class="sub-icon text-light">السلع والخدمات / المخازن<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('products') }}" class="slide-item text-dark">السلع والخدمات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('productsCategories') }}" class="slide-item text-dark">الأقسام الرئيسية للأصناف</a></li>
                            <li aria-haspopup="true"><a href="{{ url('products_sub_category') }}" class="slide-item text-dark">الأقسام الفرعية للأصناف</a></li>
                            <li aria-haspopup="true"><a href="{{ url('units') }}" class="slide-item text-dark">وحدات السلع والخدمات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('companies') }}" class="slide-item text-dark">شركات السلع والخدمات</a></li>
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('stores') }}" class="slide-item text-dark">المخازن</a></li>
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('transfer_between_stores') }}" class="slide-item text-dark">تحويلات السلع والخدمات بين المخازن</a></li>
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('taswea_products') }}" class="slide-item text-dark">تسوية كميات السلع والخدمات</a></li>
                            <li aria-haspopup="true"><a href="chart-echart.html" class="slide-item text-dark">المواد الخام</a></li>
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('products/report') }}" class="slide-item text-dark">تقرير عن حركة سلعة/خدمة</a></li>
                        </ul>
                    </li>--}}

                    
                    {{--<li aria-haspopup="true"><a href="{{ url('treasury_bills/create') }}" class="sub-icon text-light">المعاملات المالية<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">         
                            <li aria-haspopup="true"><a href="{{ url('treasury_bills/create') }}" class="slide-item text-dark">أجراء معاملة في الخزينة المالية</a></li>                   
                            <li aria-haspopup="true"><a href="{{ url('treasury_bills') }}" class="slide-item text-dark">معاملات الخزينة المالية</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('financial_treasury') }}" class="slide-item text-dark">إغلاق وردية</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('financial_treasury') }}" class="slide-item text-dark">الخزائن المالية</a></li>
                            <li aria-haspopup="true"><a href="{{ url('transfer_between_storages') }}" class="slide-item text-dark">التحويل من خزنة لآخري</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('treasury_bills/report') }}" class="slide-item text-dark">تقرير عن حركة الخزائن المالية</a></li>
                        </ul>
                    </li>--}}
                    
                    <li aria-haspopup="true"><a href="{{ url('purchases/create') }}" class="sub-icon text-light">المشتريات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('/purchases') }}" class="slide-item text-dark">فواتير المشتريات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/purchases/create') }}" class="slide-item text-dark">فاتورة مشتريات جديدة</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('purchases_return') }}" class="slide-item text-dark">فواتير مرتجع المشتريات</a></li>

                            {{--<li aria-haspopup="true"><a href="product-cart.html" class="slide-item text-dark">تعديل فاتورة مشتريات</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item text-dark">مرتجع / تعديل فاتورة مشتريات</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item text-dark">مرتجع مشتريات بدون فاتورة</a></li>
                            <li aria-haspopup="true"><a href="product-cart.html" class="slide-item text-dark">تعديل مرتجع مشتريات</a></li>
                            
                            <hr class="navbar_hr"/>
                            
                            <li aria-haspopup="true"><a href="#" class="slide-item text-dark">الموردين</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-dark">حسابات الموردين</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-dark">طلبيات مورد</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-dark">إشعار خصم أو إضافة لمورد</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-dark">نصدير ديون الموردين إلي ملف إكسيل</a></li>--}}
                        </ul>
                    </li>

                    
                    <li aria-haspopup="true"><a href="{{ url('sales/create') }}" class="sub-icon text-light">المبيعات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">                                          
                            <li aria-haspopup="true"><a href="{{ url('/sales') }}" class="slide-item text-dark">فواتير المبيعات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/sales/create') }}" class="slide-item text-dark">فاتورة مبيعات جديدة</a></li>

                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('sales_return') }}" class="slide-item text-dark">فواتير مرتجع المبيعات</a></li>
                            {{--<li aria-haspopup="true"><a href="#" class="slide-item text-dark">تصدير العملاء إلي ملف إكسيل</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-dark">إستيراد العملاء من ملف إكسيل</a></li>
                            <li aria-haspopup="true"><a href="#" class="slide-item text-dark">تصدير ديون العملاء إلي ملف إكسيل</a></li>--}}

                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('products/report/stock_alert') }}" class="slide-item text-dark">كشكول النواقص</a></li>

                            {{--<li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-dark">فاتورة مبيعات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-dark">تعديل فاتورة مبيعات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-dark">مرتجع بيع</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-dark">مرتجع بيع بدون فاتورة</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-dark">تعديل مرتجع مبيعات</a></li>--}}
                            {{--<hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-dark">عرض أسعار</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/') }}" class="slide-item text-dark">المندوبون</a></li>--}}
                        </ul>
                    </li>

                    
                    <li aria-haspopup="true"><a href="{{ url('settingsssssw') }}" class="sub-icon text-light">المعاملات اليومية<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('/treasury_bills') }}" class="slide-item text-dark">جميع معاملات الخزائن المالية</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/treasury_bills/create') }}" class="slide-item text-dark">إضافة معاملة في الخزينة المالية</a></li>                           
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('treasury_bills/report') }}" class="slide-item text-dark">تقرير عن حركة الخزائن المالية</a></li>


                            {{--<hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('/sdeds') }}" class="slide-item text-dark">استحقاق المصروفات</a></li>--}}

                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('/expenses') }}" class="slide-item text-dark">المصروفات</a></li>
                            <li aria-haspopup="true"><a href="{{ url('expenses/report') }}" class="slide-item text-dark">تقرير عن المصروفات</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('/transfer_between_storages') }}" class="slide-item text-dark">التحويل من خزنة لأخري</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('receipts') }}" class="slide-item text-dark">ايصال استلام نقدية / شيكات</a></li>

                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('report/profits') }}" class="slide-item text-dark">تقرير الربحية</a></li>

                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('clients/report/clients_debt') }}" class="slide-item text-dark">تقرير مديونية العملاء</a></li>
                        </ul>
                    </li>

                    {{--<li aria-haspopup="true"><a href="{{ url('treasury_bills/create') }}" class="sub-icon text-light">المصروفات<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">         
                        
                            <li aria-haspopup="true"><a href="{{ url('expenses') }}" class="slide-item text-dark">المصروفات</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('expenses/report') }}" class="slide-item text-dark">تقرير عن المصروفات</a></li>

                        </ul>
                    </li>--}}
                    
                    {{--<li aria-haspopup="true"><a href="{{ url('users') }}" class="sub-icon text-light">الموظفين<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('/users') }}" class="slide-item text-dark">مستخدمين النظام</a></li>
                        </ul>
                    </li>--}}

                    <li aria-haspopup="true"><a href="{{ url('settings') }}" class="sub-icon text-light">اعدادات النظام<i class="fe fe-chevron-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ url('/settings') }}" class="slide-item text-dark">معلومات النشاط</a></li>
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('/users') }}" class="slide-item text-dark">مستخدمين النظام</a></li>
                            
                            <hr class="navbar_hr"/>
                            <li aria-haspopup="true"><a href="{{ url('/roles_permissions') }}" class="slide-item text-dark">الأذونات والتراخيص</a></li>
                            <li aria-haspopup="true"><a href="{{ url('/roles_permissions/create') }}" class="slide-item text-dark">اضافة تراخيص جديدة</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!--Nav-->
        </div>
    </div>
</div>
<!--Horizontal-main -->