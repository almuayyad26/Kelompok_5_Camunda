@extends('templates/layout')

@section('container')
    <div class="container mt-3">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block mt-3">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
	@endif
        <div class="row">
            <div class="col">
                <h1>Data Reimburs</h1>
                <p>Nama: <b>{{ $nama }}</b></p>
                <p>Jumlah: <b>{{ $jumlah }}</b></p>
                <p>Keterangan: <b>{{ $keterangan }}</b></p>
                
                <form action="/sendBukti" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="form-group">
						<b>File Gambar</b><br/>
						<input type="file" name="bukti">
					</div>

                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>

    @endsection