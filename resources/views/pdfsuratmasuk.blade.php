<!DOCTYPE html>
<html>
<head>
	<title>Surat Masuk PDF</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<img src="assets/img/logo/kopsurat.png" alt="" style="height:80px">
		<h5><u>Lembar Disposisi</u></h5><br>
	</center>

	<div class="row">

		<div style="font-size: 12px;">
			<label><b>Asal Surat</b> : {{$suratmasuk->asal_surat}}</label><br>
			<label><b>Tgl Surat</b> : {{$suratmasuk->tgl_surat}}</label><br>
			<label><b>No Surat</b> : {{$suratmasuk->no_surat}}</label><br><br>
			<label><b>Perihal</b> : {!! nl2br(e(wordwrap($suratmasuk->perihal_surat, 40, "\n", true))) !!}</label><br>
			<label><b>Diteruskan Kepada</b> : {{$disposisi->nama_karyawan}}</label><br><br><br>
			<label><b>Catatan Tindak Lanjut</b> : <br> {{$disposisi->catatan_tindak_lanjut}}</label>
		</div>
		<div style="font-size: 12px; float:right; padding-right: 50px;">
			<label><b>No Agenda</b> : {{$disposisi->no_agenda}}</label><br>
			<label><b>Tgl Terima</b> : {{$suratmasuk->tgl_diterima}}</label><br>
			<label><b>Sifat Surat</b> : {{$suratmasuk->sifat_surat}}</label><br><br>
			<label><b>Dengan Hormat Harap</b> : {{$disposisi->dengan_hormat_harap}}</label><br>
		</div>

		

	</div>

	{{-- <table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Alamat</th>
				<th>Telepon</th>
				<th>Pekerjaan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($pegawai as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->nama}}</td>
				<td>{{$p->email}}</td>
				<td>{{$p->alamat}}</td>
				<td>{{$p->telepon}}</td>
				<td>{{$p->pekerjaan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table> --}}

</body>
</html>