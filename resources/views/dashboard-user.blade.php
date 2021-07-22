@extends('layouts.default', ['sidebarSearch' => true])

@section('title', 'Dashboard')

@section('content')
	<!-- begin row -->

	<!-- end row -->
	<!-- begin row -->
	<div class="row">
		<!-- begin col-6 -->
		<div class="col-xl-6">
			<!-- begin card -->
			<div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
				<!-- begin card-body -->
				<div class="card-body">
					<!-- begin row -->
					<div class="row">
						<!-- begin col-7 -->
						<div class="col-xl-7 col-lg-8">
							<!-- begin title -->
							<div class="mb-3 text-grey">
								<b>Total Disposisi</b>
								<span class="ml-2">
									<i class="fa fa-info-circle" data-toggle="popover" data-trigger="hover" data-title="Total Surat" data-placement="top" data-content="Total jumlah dari disposisi surat masuk dan keluar "></i>
								</span>
							</div>
							<!-- end title -->
							<!-- begin total-sales -->
							<div class="d-flex mb-1">
								<h2 class="mb-0"><span data-animation="number" data-value="{{$alldisposisi}}">0</span></h2>
								<div class="ml-auto mt-n1 mb-n1"><div id="total-sales-sparkline"></div></div>
							</div>
							<!-- end total-sales -->
							<!-- begin percentage -->
							<div class="mb-3 text-grey">
							</div>
							<!-- end percentage -->
							<hr class="bg-white-transparent-2" />
							<!-- begin row -->
							<div class="row text-truncate">
								<!-- begin col-4 -->
								<div class="col-6">
									<div class="f-s-12 text-grey">Surat Masuk (Belum dibaca)</div>
									<div class="f-s-18 m-b-5 f-w-600 p-b-1" data-animation="number" data-value="{{$nosm}}">0</div>
								
								</div>
								<!-- end col-6 -->
								<!-- begin col-6 -->
								<div class="col-6">
									<div class="f-s-12 text-grey">Surat Keluar (Belum dibaca)</div>
									<div class="f-s-18 m-b-5 f-w-600 p-b-1"><span data-animation="number" data-value="{{$nosk}}">0</span></div>
									
								</div>
								<!-- end col-4 -->
						
							</div>
							<!-- end row -->
						</div>
						<!-- end col-7 -->
						<!-- begin col-5 -->
						<div class="col-xl-5 col-lg-4 align-items-center d-flex justify-content-center">
							<img src="/assets/img/svg/img-2.svg" height="150px" class="d-none d-lg-block" />
						</div>
						<!-- end col-5 -->
					</div>
					<!-- end row -->
				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->
		</div>
		<!-- end col-6 -->
		<!-- begin col-6 -->
		
		<!-- end col-6 -->
	</div>
	<!-- end row -->
@endsection