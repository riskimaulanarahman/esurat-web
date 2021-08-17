@extends('layouts.default', ['sidebarSearch' => true])

@section('title', 'Surat Keluar')

@section('content')

<div class="row">

	<div class="col-xl-12">
		<!-- begin panel -->
		<div class="panel panel-inverse">
			<!-- begin panel-heading -->
			<div class="panel-heading">
				<h4 class="panel-title">My Disposisi Surat Keluar</h4>
				<div class="panel-heading-btn">
					<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> -->
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success reloadalltabel"
						data-click="panel-reload"><i class="fa fa-redo"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
						data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
				</div>
			</div>
			<!-- end panel-heading -->
			<!-- begin panel-body -->
			<div class="panel-body">
			    <div id="grid-dsuratkeluar" style="height: 640px; width:100%;"></div>
			</div>
			<!-- end panel-body -->
		</div>
		<!-- end panel -->
	</div>
	<!--  -->

</div>

<div class="modal fade" id="modal-disposisi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Aksi <i id="title-disposisi"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {{-- <form method="POST" action="{{route('senddisposisi')}}"> --}}
                <form method="POST" id="form-dism">
                
                <div class="form-group row m-b-15">
                    <input type="hidden" name="module" id="module" value="suratkeluar">
                    <input type="hidden" name="getid" id="getid">
					<input type="hidden" name="idusers" id="idusers" value="{{Auth::user()->id}}">
                    <div class="col-md-7">
                        {{-- <input type="text" class="form-control" placeholder="" /> --}}
                        <select class="form-control" name="aksi" id="aksi">
                            <option value="">- Pilih Aksi -</option>
                            <option value="teruskan">Di Teruskan</option>
                            <option value="approval">Approval</option>
                           
                        </select>
                    </div>
                </div>
                <div id="divteruskan" class="form-group row m-b-15" hidden>
                    <label class="col-md-3 col-form-label">Kepada :</label>
                    <div class="col-md-7">
                      {{-- <input type="text" class="form-control" placeholder="" /> --}}
                      <select class="form-control" name="teruskan" id="teruskan">
                          <option value="">- Pilih -</option>
                          @foreach($karyawan as $key => $val)
                            {{-- <option value="{{$val}}">{{$key}}</option> --}}
                            <option value="{{$val->nik}}">{{$val->jabatan->nama_jabatan}} ({{$val->nama_karyawan}})</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div id="divapproval" class="form-group row m-b-15" hidden>
                    <label class="col-md-3 col-form-label">Status :</label>
                    <div class="col-md-7">
                      {{-- <input type="text" class="form-control" placeholder="" /> --}}
                      <select class="form-control" name="approval" id="approval">
                          <option value="">- Pilih Status -</option>
                          <option value="2">Approved</option>
                          <option value="3">Rejected</option>
                      </select>
                    </div>
                  </div>
               
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
<script>
    $('#aksi').change(function(){
        var thisval = $(this).val();
        if(thisval == 'teruskan') {
            $('#divteruskan').prop('hidden',false);
            $('#divapproval').prop('hidden',true);

        } else if(thisval == 'approval') {
            $('#divteruskan').prop('hidden',true);
            $('#divapproval').prop('hidden',false);
        } else {
            $('#divteruskan').prop('hidden',true);
            $('#divapproval').prop('hidden',true);
        }
    })
</script>
<script src="/assets/js/disposisi-sk.js?n=<?php echo rand(); ?>"></script>

@endpush