@extends('layouts.default', ['sidebarSearch' => true])

@section('title', 'Dashboard Admin')

@section('content')
	<!-- begin row -->

	<!-- end row -->
	<!-- begin row -->
	<div class="row">
	
		<!-- begin col-6 -->
		<div class="col-xl-6">
			<!-- begin row -->
			<div class="row">
				<!-- begin col-6 -->
				<div class="col-sm-6">
					<!-- begin card -->
					<div class="card border-0 bg-dark text-white text-truncate mb-3">
						<!-- begin card-body -->
						<div class="card-body">
							<!-- begin title -->
							<div class="mb-3 text-grey">
								<b class="mb-3">Surat Masuk</b> 
							</div>
							<!-- end title -->
							<!-- begin conversion-rate -->
							<div class="d-flex align-items-center mb-1">
								<h2 class="text-white mb-0"><span data-animation="number" data-value="{{$allsm}}">0.00</span></h2>
								<div class="ml-auto">
									<div id="conversion-rate-sparkline"></div>
								</div>
							</div>
							<!-- end conversion-rate -->
							<!-- begin percentage -->
							<div class="mb-4 text-grey">
							</div>
							<!-- end percentage -->
							<!-- begin info-row -->
							<div class="d-flex mb-2">
								<div class="d-flex align-items-center">
									<i class="fa fa-circle text-red f-s-8 mr-2"></i>
									Hari ini
								</div>
								<div class="d-flex align-items-center ml-auto">
									<div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="{{$todaysm}}">0.00</span></div>
								</div>
							</div>
							<!-- end info-row -->
							<!-- begin info-row -->
							<div class="d-flex mb-2">
								<div class="d-flex align-items-center">
									<i class="fa fa-circle text-warning f-s-8 mr-2"></i>
									Minggu ini
								</div>
								<div class="d-flex align-items-center ml-auto">
									<div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="{{$weeksm}}">0.00</span></div>
								</div>
							</div>
							<!-- end info-row -->
							<!-- begin info-row -->
							<div class="d-flex">
								<div class="d-flex align-items-center">
									<i class="fa fa-circle text-lime f-s-8 mr-2"></i>
									Bulan ini
								</div>
								<div class="d-flex align-items-center ml-auto">
									<div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="{{$monthsm}}">0.00</span></div>
								</div>
							</div>
							<!-- end info-row -->
						</div>
						<!-- end card-body -->
					</div>
					<!-- end card -->
				</div>
				<!-- end col-6 -->
				<!-- begin col-6 -->
				<div class="col-sm-6">
					<!-- begin card -->
					<div class="card border-0 bg-dark text-white text-truncate mb-3">
						<!-- begin card-body -->
						<div class="card-body">
							<!-- begin title -->
							<div class="mb-3 text-grey">
								<b class="mb-3">Surat Keluar</b> 
							</div>
							<!-- end title -->
							<!-- begin conversion-rate -->
							<div class="d-flex align-items-center mb-1">
								<h2 class="text-white mb-0"><span data-animation="number" data-value="{{$allsk}}">0.00</span></h2>
								<div class="ml-auto">
									<div id="conversion-rate-sparkline"></div>
								</div>
							</div>
							<!-- end conversion-rate -->
							<!-- begin percentage -->
							<div class="mb-4 text-grey">
							</div>
							<!-- end percentage -->
							<!-- begin info-row -->
							<div class="d-flex mb-2">
								<div class="d-flex align-items-center">
									<i class="fa fa-circle text-red f-s-8 mr-2"></i>
									Hari ini
								</div>
								<div class="d-flex align-items-center ml-auto">
									<div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="{{$todaysk}}">0.00</span></div>
								</div>
							</div>
							<!-- end info-row -->
							<!-- begin info-row -->
							<div class="d-flex mb-2">
								<div class="d-flex align-items-center">
									<i class="fa fa-circle text-warning f-s-8 mr-2"></i>
									Minggu ini
								</div>
								<div class="d-flex align-items-center ml-auto">
									<div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="{{$weeksk}}">0.00</span></div>
								</div>
							</div>
							<!-- end info-row -->
							<!-- begin info-row -->
							<div class="d-flex">
								<div class="d-flex align-items-center">
									<i class="fa fa-circle text-lime f-s-8 mr-2"></i>
									Bulan ini
								</div>
								<div class="d-flex align-items-center ml-auto">
									<div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="{{$monthsk}}">0.00</span></div>
								</div>
							</div>
							<!-- end info-row -->
						</div>
						<!-- end card-body -->
					</div>
					<!-- end card -->
				</div>
				<!-- end col-6 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
@endsection