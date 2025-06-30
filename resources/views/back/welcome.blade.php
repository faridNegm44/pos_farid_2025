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
							<div style="text-align: center;font-weight: bold;">
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
										<a class="text-white" href="{{ url('products/report/stock_alert') }}" target="_blank">إجمالي الربح اليوم</a>
									</span>
									<h4 class="text-white mb-0">
										<a class="text-white" href="{{ url('products/report/stock_alert') }}" target="_blank">150</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card bg-success-gradient text-white">
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
										<a class="text-white" href="{{ url('sales') }}" target="_blank">إجمالي المبيعات اليوم</a>
									</span>
									<h4 class="text-white mb-0">
										<a class="text-white" href="{{ url('sales') }}" target="_blank">
											{{ display_number( totalSalesToday() ) }}
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
			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
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
			</div>
			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card bg-danger text-white">
					<div class="card-body">
						<div class="row">
							<div class="col-3">
								<div class="icon1 mt-2 text-center">
									<i class="fas fa-exclamation-triangle tx-40"></i>
								</div>
							</div>
							<div class="col-9">
								<div class="mt-0 text-center">
									<span style="font-size: 11px;">
										<a class="text-white" href="{{ url('products/report/stock_alert') }}" target="_blank">أصناف وصلت للحد الأدنى</a>
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
			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card bg-dark text-white">
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
		</div>
		{{-- end first section --}}
		
		
		
		{{-- start second section --}}
		<div class="row row-sm row-deck">
			
			{{-- العملاء الأكثر شراءً --}}
			<div class="col-md-12 col-lg-3 col-xl-3">
				<div class="card card-dashboard-eight pb-2">
					<span class="d-block mg-b-10 tx-12 text-danger">
						🛍️ العملاء الأكثر شراءً
						<a href="{{ url('analytics/top_clients') }}" target="_blank" class="btn btn-sm btn-outline-info">تفاصيل أكثر 🔍</a>
					</span>

					@if (count(topProductsInThisMonth()) > 0 )
						<table class="table table-bordered table-hover text-center">
							<thead class="thead-dark">
								<tr>
									<th scope="col">#</th>
									<th scope="col">اسم العميل</th>
									<th scope="col">إجمالي المشتريات</th>
								</tr>
							</thead>
							<tbody>
								@foreach (topProductsInThisMonth() as $product)
									<tr>
										<th scope="row">5</th>
										<td>فيصل الرشيد</td>
										<td>9,870</td>
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
					<span class="d-block mg-b-10 tx-12 text-danger">
						🛒 السلع/الخدمات الأكثر مبيعاً
						<a href="{{ url('analytics/top_products') }}" target="_blank" class="btn btn-sm btn-outline-info ">تفاصيل أكثر 🔍</a>
					</span>

					@if (count(topProductsInThisMonth()) > 0 )
						<table class="table table-bordered table-hover text-center">
							<thead class="thead-dark">
								<tr>
									<th scope="col">#</th>
									<th scope="col">اسم السلعة/الخدمة</th>
									<th scope="col">ع المبيعات</th>
								</tr>
							</thead>
							<tbody>
								@foreach (topProductsInThisMonth() as $product)
									<tr>
										<th scope="row">{{ $product->productId }}</th>
										<td>{{ $product->productNameAr }}</td>
										<td>{{ display_number($product->total_product) }}</td>
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
					<span class="tx-12 tx-muted mb-3 text-danger">
						📋 أحدث فواتير البيع
						<a href="{{ url('sales') }}" target="_blank" class="btn btn-sm btn-outline-info">تفاصيل أكثر 🔍</a>
					</span>
					
					@if (count(getLastSaleBills()) > 0 )
						<div class="table-responsive country-table">
							<table class="table table-bordered table-hover text-center">
								<thead class="thead-dark">
									<tr>
										<th class="">#</th>
										<th class="wd-lg-22p">ت الفاتورة</th>
										<th class="wd-lg-25p">العميل</th>
										<th class="">عدد</th>
										<th class="wd-lg-20p ">إجمالي</th>
										<th class="">عرض</th>
									</tr>
								</thead>
								<tbody>
									@foreach (getLastSaleBills() as $item)
										<tr>
											<td>{{ $item->id }}</td>
											<td style="font-size: 9px !important;">
												{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}
												<span style="font-weight: bold;margin: 0 2px;color: red;">
													{{ \Carbon\Carbon::parse($item->created_at)->format('h:i:s a') }}
												</span>
											</td>
											<td><a href="{{ url('sales/report/print_receipt/'.$item->id) }}" class="tx-primary">{{ $item->clientName }}</a></td>
											<td class="tx-medium tx-danger">{{ display_number( $item->count_items ) }}</td>
											<td class="tx-medium tx-inverse">												
												<span class="text-muted" style="font-size: 10px !important;">
													قبل: {{ display_number( $item->total_bill_before ) }}
												</span>
												<span class="" style="font-size: 12px !important;">
													بعد: {{ display_number( $item->total_bill_after ) }}
												</span>
											</td>
											<td>
												<a target="_blank" class="btn btn-sm btn-primary" href="{{ url('sales/report/print_receipt/'.$item->id) }}" style="height: 20px;line-height: 10px;">عرض</a>
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

