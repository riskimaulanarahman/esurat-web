@extends('layouts.default', ['sidebarSearch' => true])

@section('title', 'Surat Masuk')

@section('content')

	<!-- begin panel -->
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Surat Masuk</h4>
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
		</div>
		<div class="panel-body">
			@if(Auth::user()->role == "admin" || Auth::user()->role == "operator")<div id="gridDeleteSelected"></div>@endif
			<div id="popup"></div>
			<div id="grid-suratmasuk" style="height: 640px; width:100%;"></div>
		</div>
	</div>
	<!-- end panel -->

	<div class="modal fade" id="modal-disposisi">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Disposisi <i id="title-disposisi"></i></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					{{-- <form method="POST" action="{{route('senddisposisi')}}"> --}}
					<form method="POST" id="form-dism">
					<div class="form-group row m-b-15">
						<input type="hidden" name="module" id="module" value="suratmasuk">
						<input type="hidden" name="getid" id="getid">
						<label class="col-md-3 col-form-label">Kepada :</label>
						<div class="col-md-7">
						  {{-- <input type="text" class="form-control" placeholder="" /> --}}
						  <select class="form-control" name="nik" id="nik">
							  <option value="">- Pilih -</option>
							  @foreach($karyawan as $key => $val)
								<option value="{{$val}}">{{$key}}</option>
							  @endforeach
						  </select>
						</div>
					  </div>
					  <div class="form-group row m-b-15">
						<label class="col-md-3 col-form-label">No Agenda :</label>
						<div class="col-md-7">
						  <input type="text" name="no_agenda" id="no_agenda" class="form-control" placeholder="" />
						</div>
					  </div>
					  {{-- <div class="form-group row m-b-15">
						<label class="col-md-3 col-form-label">Isi Disposisi :</label>
						<div class="col-md-7">
						  <input type="text" class="form-control" placeholder="" />
						</div>
					  </div> --}}
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
					<input type="button" class="btn btn-success" id="btn-action" value="Action">
				</div>
				</form>
			</div>
		</div>
	</div>

@endsection
 
@push('scripts')
<script src="/assets/js/suratmasuk/suratmasuk.js?n=<?php echo rand(); ?>"></script>
@endpush