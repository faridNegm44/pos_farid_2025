@extends('back.layouts.app')

@section('title')
	الرئيسية
@endsection

@section('header')
	<style>
		td, th{
			font-size: 10px;
			text-align: center;
			padding: 2px !important;
		}
		#first_section .card-body{
			padding: 5px !important;
		}
		.ajs-success, .ajs-error{
			min-width: 450px !important;
		}
		.dashboard-card {
			transition: all 0.3s ease-in-out;
			cursor: pointer;
			border: 2px solid transparent;
		}

		.dashboard-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
			border-color: #0d6efd; /* تغيير لون الإطار عند الهوفر */
		}

		.dashboard-card:hover i {
			transform: scale(1.2) translateY(-3px);
		}
		#first_section .card:hover {
			transform: scale(1.1) translateY(-6px);
			box-shadow: 10px 8px 16px rgba(0, 0, 0, 0.15);
			transition: transform 0.5s ease;
		}
		.dashboard-card i {
			transition: transform 0.3s ease;
		}

		.dashboard-card:hover span {
			font-weight: bold;
			letter-spacing: 0.5px;
		}
	</style>
@endsection

@section('footer')
	@if (session()->has('success_login'))
	<script>
		$(document).ready(function () {
			alertify.set('notifier','position', 'top-center');
			alertify.set('notifier','delay', 4);
			alertify.success("مرحبا ( {{ auth()->user()->name }} )");
		});
	</script>
	@endif
	
	@if (session()->has('notAuth'))
		<script>
			$(document).ready(function () {
				alertify.dialog('alert')
						.set({transition:'slide',message: `
							<div style="text-align: center;">
								<p style="color: #e67e22; font-size: 18px; margin-bottom: 10px;">
									صلاحية غير متوفرة 🔐⚠️
								</p>
								<p>{{ session()->get('notAuth') }}</p>
							</div>
						`, 'basic': true})
						.show();  

			});
		</script>
	@endif
@endsection

@section('content')
	<div class="container-fluid">
		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between">
			<div class="my-auto">
				{{--<div class="d-flex">
					<h4 class="content-title mb-0 my-auto">{{ auth()->user()->name }}</h4>
				</div>--}}
			</div>
		</div>
		<!-- breadcrumb -->


		{{--<h1>
			{{ topClientsPurchases() }}
		</h1>--}}



		<div class="row g-3 justify-content-center">
	  
		  <div class="col-md-1 col-12" data-placement="bottom" data-toggle="tooltip" title="فواتير المبيعات">
			<div class="card text-center dashboard-card border">
			  <div class="card-body" style="padding: 1rem 0 !important;height: 90px !important;">
				<a href="{{ url('sales') }}" target="_blank" class="text-decoration-none">
				  <i class="fas fa-cash-register fa-2x mb-1 d-block"></i>
				  <span class="fw-bold tx-8">فواتير المبيعات</span>
				</a>
			  </div>
			</div>
		  </div>
	 
		  <div class="col-md-1 col-12" data-placement="bottom" data-toggle="tooltip" title="حركات الخزينة">
			<div class="card text-center dashboard-card border">
			  <div class="card-body" style="padding: 1rem 0 !important;height: 90px !important;">
				<a href="{{ url('treasury_bills') }}" target="_blank" class="text-decoration-none">
					<i class="fas fa-coins fa-2x mb-1 d-block"></i>
					<span class="fw-bold tx-8">حركات الخزينة</span>
				</a>
			  </div>
			</div>
		  </div>
	 
		  <div class="col-md-1 col-12" data-placement="bottom" data-toggle="tooltip" title="فواتير المشتريات">
			<div class="card text-center dashboard-card border">
			  <div class="card-body" style="padding: 1rem 0 !important;height: 90px !important;">
				<a href="{{ url('purchases') }}" target="_blank" class="text-decoration-none">
				  <i class="fas fa-cart-arrow-down fa-2x mb-1 d-block"></i>
				  <span class="fw-bold tx-8">فواتير المشتريات</span>
				</a>
			  </div>
			</div>
		  </div>
	  
		  <div class="col-md-1 col-12" data-placement="bottom" data-toggle="tooltip" title="الأصناف">
			<div class="card text-center dashboard-card border">
			  <div class="card-body" style="padding: 1rem 0 !important;height: 90px !important;">
				<a href="{{ url('products') }}" target="_blank" class="text-decoration-none">
				  <i class="fas fa-boxes fa-2x mb-1 d-block"></i>
				  <span class="fw-bold tx-8">الأصناف</span>
				</a>
			  </div>
			</div>
		  </div>
	  
		  <div class="col-md-1 col-12" data-placement="bottom" data-toggle="tooltip" title="العملاء">
			<div class="card text-center dashboard-card border">
			  <div class="card-body" style="padding: 1rem 0 !important;height: 90px !important;">
				<a href="{{ url('expenses') }}" target="_blank" class="text-decoration-none">
					<i class="fas fa-wallet fa-2x mb-1 d-block"></i>
					<span class="fw-bold tx-8">المصروفات</span>
				</a>					
			  </div>
			</div>
		  </div>
		  
		  <div class="col-md-1 col-12" data-placement="bottom" data-toggle="tooltip" title="العملاء">
			<div class="card text-center dashboard-card border">
			  <div class="card-body" style="padding: 1rem 0 !important;height: 90px !important;">
				<a href="{{ url('clients') }}" target="_blank" class="text-decoration-none">
					<i class="fas fa-user-alt fa-2x mb-1 d-block"></i>
					<span class="fw-bold tx-8">العملاء</span>
				</a>					
			  </div>
			</div>
		  </div>
		  
		  <div class="col-md-1 col-12" data-placement="bottom" data-toggle="tooltip" title="كشف حساب عميل">
			<div class="card text-center dashboard-card border">
			  <div class="card-body" style="padding: 1rem 0 !important;height: 90px !important;">
				<a href="{{ url('clients/report/account_statement') }}" target="_blank" class="text-decoration-none">
					<i class="fas fa-file-pdf fa-2x mb-1 d-block"></i>
					<span class="fw-bold tx-8">كشف حساب عميل</span>
				</a>					
			  </div>
			</div>
		  </div>
		  
		  <div class="col-md-1 col-12" data-placement="bottom" data-toggle="tooltip" title="ايصالات / شيكات">
			<div class="card text-center dashboard-card border">
			  <div class="card-body" style="padding: 1rem 0 !important;height: 90px !important;">
				<a href="{{ url('receipts') }}" target="_blank" class="text-decoration-none">
					<i class="fas fa-receipt fa-2x mb-1 d-block"></i>
					<span class="fw-bold tx-8">ايصالات / شيكات</span>
				</a>					
			  </div>
			</div>
		  </div>
	  
		  <div class="col-md-1 col-12" data-placement="bottom" data-toggle="tooltip" title="التحويل بين الخزن">
			<div class="card text-center dashboard-card border">
			  <div class="card-body" style="padding: 1rem 0 !important;height: 90px !important;">
				<a href="{{ url('transfer_between_storages') }}" target="_blank" class="text-decoration-none">
				  <i class="fas fa-money-bill-wave fa-2x mb-1 d-block"></i>
				  <span class="fw-bold tx-8">التحويل بين الخزن</span>
				</a>
			  </div>
			</div>
		  </div>
	  
		</div>
		<hr style="border: 1px solid !important;margin-bottom: 30px !important;">


		{{-- start first section --}}
		<div class="row row-sm" id="first_section">
			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card bg-primary-gradient text-white ">
					<div class="card-body">
						<div class="row">
							<div class="col-3">
								<div class="icon1 mt-2 text-center">
									<i class="fas fa-coins tx-40"></i>
								</div>
							</div>
							<div class="col-9">
								<div class="mt-0 text-center">
									<span class="text-white" style="font-size: 11px;">
										<a class="text-white">إجمالي المبيعات اليوم</a>
									</span>
									<h4 class="text-white mb-0">
										<a class="text-white">
											{{ display_number( totalProfitToday()['totalSales'] ?? 0 ) }}
										</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card text-white {{ totalProfitToday()['roundedProfit'] > 0 ? 'bg-success-gradient' : 'bg-dark' }} ">
					<div class="card-body">
						<div class="row">
							<div class="col-3">
								<div class="icon1 mt-2 text-center">
									<i class="fe fe-shopping-cart tx-40"></i>
								</div>
							</div>
							<div class="col-9">
								<div class="mt-0 text-center">
									<span class="text-white" style="font-size: 11px;">
										<a class="text-white" href="{{ url('report/profits') }}" target="_blank">إجمالي الربح اليوم</a>
									</span>
									<h4 class="text-white mb-0">
										<a class="text-white" href="{{ url('report/profits') }}" target="_blank">
											{{--{{  totalProfitToday()['profit'] ? floor( display_number( totalProfitToday()['profit'] ) * 100 ) / 100 : 0 }}--}}
											{{ display_number( totalProfitToday()['roundedProfit'] ) }}
										</a>
										
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card bg-purple-gradient text-white">
					<div class="card-body">
						<div class="row">
							<div class="col-3">
								<div class="icon1 mt-2 text-center">
									<i class="fas fa-wallet tx-40"></i>
								</div>
							</div>
							<div class="col-9">
								<div class="mt-0 text-center">
									<span class="text-white" style="font-size: 11px;">
										<a class="text-white" href="{{ url('expenses') }}" target="_blank">إجمالي المصروفات اليوم</a>
									</span>
									<h4 class="text-white mb-0">
										<a class="text-white" href="{{ url('expenses') }}" target="_blank">
											{{ display_number( totalExpensesToday() ) }}
										</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			@if( totalClientsDebts() )
				<div class="col-lg-6 col-xl-2 col-md-6 col-12">
					<div class="card bg-danger-gradient text-white">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<div class="icon1 mt-2 text-center">
										<i class="fas fa-user-clock tx-40"></i>
									</div>
								</div>
								<div class="col-9">
									<div class="mt-0 text-center">
										<span class="text-white" style="font-size: 10px;">
											<a class="text-white" href="{{ url('clients/report/clients_debt') }}" target="_blank">
												ديون لينا (علي العملاء)
											</a>
										</span>
										<h4 class="text-white mb-0">
											<a class="text-white" href="{{ url('clients/report/clients_debt') }}" target="_blank">
												{{ display_number( totalClientsDebts() ) }}
											</a>
										</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif

			@if( totalSuppliersDebts() )
				<div class="col-lg-6 col-xl-2 col-md-6 col-12">
					<div class="card bg-primary-gradient text-white">
						<div class="card-body">
							<div class="row">
								<div class="col-3">
									<div class="icon1 mt-2 text-center">
										<i class="fas fa-truck-loading tx-40"></i>
									</div>
								</div>
								<div class="col-9">
									<div class="mt-0 text-center">
										<span class="text-white" style="font-size: 10px;">
											<a class="text-white" href="{{ url('suppliers/report/suppliers_debt') }}" target="_blank">
												ديون علينا  (لصالح الموردين)
											</a>
										</span>
										<h4 class="text-white mb-0">
											<a class="text-white" href="{{ url('suppliers/report/suppliers_debt') }}" target="_blank">
												{{ display_number( totalSuppliersDebts() ) }}
											</a>
										</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif


			{{--<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card bg-warning-gradient text-white">
					<div class="card-body">
						<div class="row">
							<div class="col-3">
								<div class="icon1 mt-2 text-center">
									<i class="fas fa-undo-alt tx-40"></i>
								</div>
							</div>
							<div class="col-9">
								<div class="mt-0 text-center">
									<span class="text-white" style="font-size: 11px;">
										<a class="text-white" href="{{ url('products/report/stock_alert') }}" target="_blank">مرتجعات البيع اليوم</a>
									</span>
									<h4 class="text-white mb-0">
										<a class="text-white" href="{{ url('products/report/stock_alert') }}" target="_blank">150</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>--}}

			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card bg-secondary text-white">
					<div class="card-body">
						<div class="row">
							<div class="col-3">
								<div class="icon1 mt-2 text-center">
									<i class="fas fa-cash-register tx-40"></i>
								</div>
							</div>
							<div class="col-9">
								<div class="mt-0 text-center">
									<span class="text-white" style="font-size: 11px;">
										<a class="text-white">رصيد الخزن</a>									
									</span>
									<h4 class="text-white mb-0">
										<a class="text-white">
											{{ display_number( totalFinancialTreasury() ) }}
										</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card bg-warning-gradient text-white">
					<div class="card-body">
						<div class="row">
							<div class="col-3">
								<div class="icon1 mt-2 text-center">
									<i class="fas fa-exclamation-triangle tx-40"></i>
								</div>
							</div>
							<div class="col-9">
								<div class="mt-0 text-center">
									<span style="font-size: 12px;">
										<a class="text-white" href="{{ url('products/report/stock_alert') }}" target="_blank">إنذار مخزون</a>
									</span>
									<h4 class="text-white mb-0">
										<a class="text-white" href="{{ url('products/report/stock_alert') }}" target="_blank">
											{{ stockAlert() }}
										</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		{{-- end first section --}}
		
		
		
		{{-- start second section --}}
		<div class="row row-sm row-deck">
			
			{{-- العملاء الأكثر شراءً --}}
			<div class="col-md-12 col-lg-3 col-xl-3">
				<div class="card card-dashboard-eight pb-2">
					<span class="d-block mg-b-10 tx-10 text-danger">
						🛍️ العملاء الأكثر شراءً
						<a href="{{ url('analytics/top_clients') }}" target="_blank" class="btn btn-sm btn-outline-info">تفاصيل أكثر 🔍</a>
					</span>

					@if (count(topProductsInSales()) > 0 )
						<table class="table table-bordered table-hover text-center">
							<thead class="thead-light">
								<tr>
									<th scope="col">#</th>
									<th scope="col">اسم العميل</th>
									<th scope="col">إجمالي المشتريات</th>
								</tr>
							</thead>
							<tbody>
								@foreach (topClientsPurchases() as $k => $client)
									<tr @if($k==0) style="background:#e3f7e3;font-weight:bold;" @endif>
										<th scope="row">
											<span class="badge badge-info" style="font-size:110% !important;">{{ $client->client_id }}</span>
										</th>
										<td>
											<span class="badge badge-secondary"></span> {{ $client->name }}
										</td>
										<td>
											<span class="badge badge-success" style="font-size:110% !important;">
												<i class="fas fa-shopping-basket"></i> {{ display_number($client->client_total) }}
											</span>
										</td>
									</tr>
								@endforeach                           
							</tbody>
						</table>	

					@else
						<h6 class="text-center">
							<p>
								لا توجد فواتير بيع حتى الآن 🧾، يمكنك البدء الآن بأول عملية بيع 💼✨
							</p>
							<a href="{{ url('sales/create') }}" class="btn btn-sm btn-primary-gradient ms-2">إضافة فاتورة جديدة ➕</a>
						</h6>
					@endif	
				</div>
			</div>
			
			
			
			{{-- السلعة/الخدمات الأكثر مبيعاً --}}
			<div class="col-md-12 col-lg-3 col-xl-3">
				<div class="card card-dashboard-eight pb-2">
					<span class="d-block mg-b-10 tx-10 text-danger">
						🛒 السلع/الخدمات الأكثر مبيعاً
						<a href="{{ url('analytics/top_products') }}" target="_blank" class="btn btn-sm btn-outline-info ">تفاصيل أكثر 🔍</a>
					</span>

					@if (count(topProductsInSales()) > 0 )
						<table class="table table-bordered table-hover text-center">
							<thead class="thead-light">
								<tr>
									<th scope="col">#</th>
									<th scope="col">اسم السلعة/الخدمة</th>
									<th scope="col">ع المبيعات</th>
								</tr>
							</thead>
							<tbody>
								@foreach (topProductsInSales() as $k => $product)
									<tr @if($k==0) style="background:#e3f7e3;font-weight:bold;" @endif>
										<th scope="row">
											<span class="badge badge-info" style="font-size:110% !important;">{{ $product->productId }}</span>
										</th>
										<td>
											<span class="badge badge-secondary"></span> {{ $product->productNameAr }}
										</td>
										<td>
											<span class="badge badge-success" style="font-size:110% !important;">
												<i class="fas fa-chart-line"></i> {{ display_number($product->total_product) }}
											</span>
										</td>
									</tr>
								@endforeach                           
							</tbody>
						</table>	

					@else
						<h6 class="text-center">
							<p>
								لا توجد فواتير بيع حتى الآن 🧾، يمكنك البدء الآن بأول عملية بيع 💼✨
							</p>
							<a href="{{ url('sales/create') }}" class="btn btn-sm btn-primary-gradient ms-2">إضافة فاتورة جديدة ➕</a>
						</h6>
					@endif	
				</div>
			</div>


			{{-- أخر فواتير بيع تمت --}}
			<div class="col-md-12 col-lg-6 col-xl-6">
				<div class="card card-table-two">
					<span class="tx-10 tx-muted mb-3 text-danger">
						📋 أحدث فواتير البيع
						<a href="{{ url('sales') }}" target="_blank" class="btn btn-sm btn-outline-info">تفاصيل أكثر 🔍</a>
					</span>
					
					@if (count(getLastSaleBills()) > 0 )
						<div class="table-responsive country-table">
							<table class="table table-bordered table-hover text-center">
								<thead class="thead-light">
									<tr>
										<th>#</th>
										<th>ت الفاتورة</th>
										<th>العميل</th>
										<th>عدد</th>
										<th>إجمالي</th>
										<th>عرض</th>
									</tr>
								</thead>
								<tbody>
									@foreach (getLastSaleBills() as $item)
										<tr>
											<td>
												<span class="badge badge-info" style="font-size: 110% !important;">{{ $item->id }}</span>
											</td>
											<td style="font-size: 10px !important;">
												<div style="display:flex;align-items:center;gap:7px;justify-content:center;">
													<span class="badge badge-dark text-white" style="font-size: 100% !important;"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</span>
													<span class="badge badge-secondary text-white" style="font-size: 100% !important;"><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($item->created_at)->format('h:i:s a') }}</span>
												</div>
											</td>
											<td>
												<a href="{{ url('sales/report/print_receipt/'.$item->id) }}" class="tx-primary">
													<span class="badge badge-secondary"><i class="fas fa-user"></i></span> {{ $item->clientName }}
												</a>
											</td>
											<td>
												<span class="badge badge-dark">{{ number_format( $item->count_items ) }}</span>
											</td>
											<td>
												@if ($item->total_bill_before == $item->total_bill_after)
													<span class="badge badge-success text-white" style="font-size: 95% !important;padding:7px 12px;"><i class="fas fa-receipt"></i> {{ display_number( $item->total_bill_after ) }}</span>
												@else
													<div style="display:flex;align-items:center;gap:7px;justify-content:center;">
														<span class="badge badge-danger text-white" style="font-size: 95% !important;padding:7px 12px;"><i class="fas fa-arrow-down"></i> قبل: {{ display_number( $item->total_bill_before ) }}</span>

														<span class="badge badge-success text-white" style="font-size: 95% !important;padding:7px 12px;"><i class="fas fa-arrow-up"></i> بعد: {{ display_number( $item->total_bill_after ) }}</span>
													</div>
												@endif
											</td>
											<td>
												<a target="_blank" class="btn btn-sm btn-outline-primary" href="{{ url('sales/report/print_receipt/'.$item->id) }}" style="height: 20px;line-height: 10px;">
													<i class="fas fa-eye"></i> عرض
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<h6 class="text-center">
							<p>
								لا توجد فواتير بيع حتى الآن 🧾، يمكنك البدء الآن بأول عملية بيع 💼✨
							</p>
							<a href="{{ url('sales/create') }}" class="btn btn-sm btn-primary-gradient ms-2">إضافة فاتورة جديدة ➕</a>
						</h6>
					@endif
				</div>
			</div>
		</div>
		{{-- end second section --}}
	</div>

@endsection

