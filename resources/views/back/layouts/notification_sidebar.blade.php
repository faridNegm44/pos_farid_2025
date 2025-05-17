<div class="sidebar sidebar-left sidebar-animate">
    <div class="panel panel-primary card mb-0 box-shadow">
        <div class="tab-menu-heading border-0 p-3">
            <div class="card-title mb-0">تقارير + أخر فواتير</div>
            <div class="card-options mr-auto">
                <a href="#" class="sidebar-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <div class="tabs-menu ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#side1" class="active" data-toggle="tab"><i class="fa fa-shopping-basket tx-18 ml-2"></i> أخر فواتير بيع</a></li>
                    <li><a href="#side2" data-toggle="tab"><i class="fas fa-cart-plus tx-18  ml-2"></i> أخر فواتير شراء</a></li>
                    <li><a href="#side3" data-toggle="tab"><i class="fas fa-receipt tx-18 ml-2"></i> تقارير عامة</a></li>
                </ul>
            </div>
            <div class="tab-content">
                
                {{-- start tab 1 --}}
                <div class="tab-pane active" id="side1">
                    <h5 class="text-center" style="text-decoration: underline;">
                        أخر فواتير بيع
                        <a href="{{ url('sales') }}" target="_blank" class="btn btn-sm rounded btn-success-gradient">الكل</a>
                    </h5>

                    @foreach (getLastSaleBills() as $item)    
                        <div class="list d-flex align-items-center border-bottom p-1">
                            <a href="{{ url('sales/report/print_receipt/'.$item->id) }}" target="_blank" class="wrapper w-100 mr-3" href="#" >
                                <p class="mb-0 d-flex ">
                                    ( {{ $item->id }} ) <b>{{ $item->clientName }}</b>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class=" align-items-center">                                    
                                        <small class="text-danger d-block ml-auto">
                                            <i class="fa fa-money-bill-alt text-muted ml-1"></i>
                                            اجمالي الفاتورة: {{ display_number($item->total_bill_before) }}
                                        </small>
                                        <small class="text-dark d-block ml-auto">
                                            <i class="mdi mdi-clock text-muted ml-1"></i>
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }} 
                                            <span class='p-2'>{{ \Carbon\Carbon::parse($item->created_at)->format('h:i:s a') }}</span>
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                {{-- end tab 1 --}}


                {{-- start tab 2 --}}
                <div class="tab-pane  " id="side2">
                    <h5 class="text-center" style="text-decoration: underline;">
                        أخر فواتير شراء
                        <a href="{{ url('purchases') }}" target="_blank" class="btn btn-sm rounded btn-danger-gradient">الكل</a>
                    </h5>

                    @foreach (getLastPurchaseBills() as $item)    
                        <div class="list d-flex align-items-center border-bottom p-1">
                            <a href="{{ url('purchases/report/result/pdf/76') }}" target="_blank" class="wrapper w-100 mr-3" href="#" >
                                <p class="mb-0 d-flex ">
                                    ( {{ $item->id }} ) <b>{{ $item->supplierName }}</b>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class=" align-items-center">                                    
                                        <small class="text-danger d-block ml-auto">
                                            <i class="fa fa-money-bill-alt text-muted ml-1"></i>
                                            اجمالي الفاتورة: 2,000
                                        </small>
                                        <small class="text-dark d-block ml-auto">
                                            <i class="mdi mdi-clock text-muted ml-1"></i>
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }} 
                                            <span class='p-2'>{{ \Carbon\Carbon::parse($item->created_at)->format('h:i:s a') }}</span>
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    
                </div>
                {{-- end tab 2 --}}


                {{-- start tab 3 --}}
                <div class="tab-pane  " id="side3">
                    <h5 class="text-center" style="text-decoration: underline;">تقارير</h5>
                    <div class="list-group list-group-flush ">
                        {{-- تقرير عن حركة مورد --}}
                        <div class="list-group-item d-flex align-items-center" style="border: 1px solid #ddd;">
                            <div>
                                <div class="font-weight-semibold">
                                    <a href="{{ url('suppliers/report') }}" target="_blank" class="text-dark">تقرير عن حركة مورد</a>
                                </div>
                            </div>
                            <div class="mr-auto">
                                <a href="{{ url('suppliers/report') }}" target="_blank" class="btn btn-sm btn-primary-gradient">عرض</a>
                            </div>
                        </div>
                        
                        {{-- تقرير عن حركة عميل --}}
                        <div class="list-group-item d-flex align-items-center" style="border: 1px solid #ddd;">
                            <div>
                                <div class="font-weight-semibold">
                                    <a href="{{ url('clients/report') }}" target="_blank" class="text-dark">تقرير عن حركة عميل</a>
                                </div>
                            </div>
                            <div class="mr-auto">
                                <a href="{{ url('clients/report') }}" target="_blank" class="btn btn-sm btn-primary-gradient">عرض</a>
                            </div>
                        </div>
                        
                        {{-- تقرير عن المصروفات --}}
                        <div class="list-group-item d-flex align-items-center" style="border: 1px solid #ddd;">
                            <div>
                                <div class="font-weight-semibold">
                                    <a href="{{ url('expenses/report') }}" target="_blank" class="text-dark">تقرير عن المصروفات</a>
                                </div>
                            </div>
                            <div class="mr-auto">
                                <a href="{{ url('expenses/report') }}" target="_blank" class="btn btn-sm btn-primary-gradient">عرض</a>
                            </div>
                        </div>
                        
                        {{-- تقرير عن حركة الخزائن المالية --}}
                        <div class="list-group-item d-flex align-items-center" style="border: 1px solid #ddd;">
                            <div>
                                <div class="font-weight-semibold">
                                    <a href="{{ url('treasury_bills/report') }}" target="_blank" class="text-dark">تقرير عن حركة الخزائن المالية</a>
                                </div>
                            </div>
                            <div class="mr-auto">
                                <a href="{{ url('treasury_bills/report') }}" target="_blank" class="btn btn-sm btn-primary-gradient">عرض</a>
                            </div>
                        </div>
                        
                        {{-- تقرير عن حركة صنف --}}
                        <div class="list-group-item d-flex align-items-center" style="border: 1px solid #ddd;">
                            <div>
                                <div class="font-weight-semibold">
                                    <a href="{{ url('products/report') }}" target="_blank" class="text-dark">تقرير عن حركة صنف</a>
                                </div>
                            </div>
                            <div class="mr-auto">
                                <a href="{{ url('products/report') }}" target="_blank" class="btn btn-sm btn-primary-gradient">عرض</a>
                            </div>
                        </div>
                        
                        {{-- كشكول النواقص --}}
                        <div class="list-group-item d-flex align-items-center" style="border: 1px solid #ddd;">
                            <div>
                                <div class="font-weight-semibold">
                                    <a href="{{ url('products/report/stock_alert') }}" target="_blank" class="text-dark">كشكول النواقص</a>
                                </div>
                            </div>
                            <div class="mr-auto">
                                <a href="{{ url('products/report/stock_alert') }}" target="_blank" class="btn btn-sm btn-primary-gradient">عرض</a>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- end tab 3 --}}
            </div>
        </div>
    </div>
</div>