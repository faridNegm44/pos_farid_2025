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
							<div class="col-6">
								<div class="icon1 mt-2 text-center">
									<i class="fe fe-users tx-40"></i>
								</div>
							</div>
							<div class="col-6">
								<div class="mt-0 text-center">
									<span class="text-white">Members</span>
									<h2 class="text-white mb-0">600</h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card bg-danger-gradient text-white">
					<div class="card-body">
						<div class="row">
							<div class="col-6">
								<div class="icon1 mt-2 text-center">
									<i class="fe fe-shopping-cart tx-40"></i>
								</div>
							</div>
							<div class="col-6">
								<div class="mt-0 text-center">
									<span class="text-white">Sales</span>
									<h2 class="text-white mb-0">854</h2>
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
							<div class="col-6">
								<div class="icon1 mt-2 text-center">
									<i class="fe fe-bar-chart-2 tx-40"></i>
								</div>
							</div>
							<div class="col-6">
								<div class="mt-0 text-center">
									<span class="text-white">Profits</span>
									<h2 class="text-white mb-0">98K</h2>
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
							<div class="col-6">
								<div class="icon1 mt-2 text-center">
									<i class="fe fe-pie-chart tx-40"></i>
								</div>
							</div>
							<div class="col-6">
								<div class="mt-0 text-center">
									<span class="text-white">Taxes</span>
									<h2 class="text-white mb-0">876</h2>
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
									<i class="fe fe-pie-chart tx-40"></i>
								</div>
							</div>
							<div class="col-9">
								<div class="mt-0 text-center">
									<span style="font-size: 11px;">
										<a class="text-white" href="{{ url('products/report/stock_alert') }}" target="_blank">أصناف وصلت للحد الأدنى</a>
									</span>
									<h2 class="text-white mb-0">
										<a class="text-white" href="{{ url('products/report/stock_alert') }}" target="_blank">150</a>
									</h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-2 col-md-6 col-12">
				<div class="card bg-secondary-gradient text-white">
					<div class="card-body">
						<div class="row">
							<div class="col-6">
								<div class="icon1 mt-2 text-center">
									<i class="fe fe-pie-chart tx-40"></i>
								</div>
							</div>
							<div class="col-6">
								<div class="mt-0 text-center">
									<span class="text-white">Taxes</span>
									<h2 class="text-white mb-0">876</h2>
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
			<div class="col-md-12 col-lg-3 col-xl-3">
				<div class="card card-dashboard-eight pb-2">
					<span class="d-block mg-b-10 tx-12 text-danger">العملاء الأكثر شراءً لشهر (أبريل 2025)</span>
					<table class="table table-bordered table-hover text-center">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">اسم العميل</th>
								<th scope="col">إجمالي المشتريات</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>أحمد محمد</td>
								<td>25,430</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>سارة عبدالله</td>
								<td>18,750</td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>خالد علي</td>
								<td>15,920</td>
							</tr>
							<tr>
								<th scope="row">4</th>
								<td>نورة الفهد</td>
								<td>12,340</td>
							</tr>
							<tr>
								<th scope="row">5</th>
								<td>فيصل الرشيد</td>
								<td>9,870</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="col-md-12 col-lg-3 col-xl-3">
				<div class="card card-dashboard-eight pb-2">
					<span class="d-block mg-b-10 tx-12 text-danger">المنتجات الأكثر مبيعاً لشهر (أبريل 2025)</span>
					<table class="table table-bordered table-hover text-center">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">اسم المنتج</th>
								<th scope="col">ع المبيعات</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>هاتف ذكي - نموذج X200</td>
								<td>1,245</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>حاسوب محمول - UltraBook</td>
								<td>987</td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>سماعات لاسلكية - ProSound</td>
								<td>856</td>
							</tr>
							<tr>
								<th scope="row">4</th>
								<td>ساعة ذكية - FitPlus</td>
								<td>732</td>
							</tr>
							<tr>
								<th scope="row">5</th>
								<td>كاميرا رقمية - DSLR Pro</td>
								<td>689</td>
							</tr>
						</tbody>
					</table>		
				</div>
			</div>


			<div class="col-md-12 col-lg-6 col-xl-6">
				<div class="card card-table-two">
					<span class="tx-12 tx-muted mb-3 text-danger">أخر فواتير بيع تمت</span>
					<div class="table-responsive country-table">
						<table class="table table-bordered table-hover text-center">
							<thead class="thead-dark">
								<tr>
									<th class="wd-lg-10p">#</th>
									<th class="wd-lg-15p">ت الفاتورة</th>
									<th class="wd-lg-25p">العميل</th>
									<th class="wd-lg-20p ">ع الأصناف</th>
									<th class="wd-lg-20p ">إجمالي</th>
									<th class="wd-lg-10p">عرض</th>
								</tr>
							</thead>
							<tbody>
								@foreach (getLastSaleBills() as $item)
									<tr>
										<td>{{ $item->id }}</td>
										<td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y h:i:s a') }}</td>
										<td><a href="{{ url('sales/report/print_receipt/'.$item->id) }}" class="tx-primary">{{ $item->clientName }}</a></td>
										<td class="tx-medium tx-danger">{{ display_number( $item->count_items ) }}</td>
										<td class="tx-medium tx-inverse">
											قبل: {{ display_number( $item->total_bill_before ) }}
											<br>
											بعد: {{ display_number( $item->total_bill_after ) }}
										</td>
										<td><a target="_blank" class="btn btn-sm btn-primary" href="{{ url('sales/report/print_receipt/'.$item->id) }}">عرض</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		{{-- end second section --}}
	</div>
@endsection

