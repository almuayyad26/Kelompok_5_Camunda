@extends('templates/layout')

@section('container')
    <div class="container mt-5">
        @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-block mt-3">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
	        </div>
	    @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block mt-3">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
	    @endif
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 p-3 bg-light">
                <h1>Input Data</h1>
                <form action="/submit" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">jumlah</label>
                        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Nominal">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan" cols="15" rows="5" placeholder="email, alamat, status, etc."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    @endsection