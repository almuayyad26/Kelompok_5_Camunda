@extends('templates/layout')

@section('container')
    <div class="container">
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
        <form action="/submit" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="nama" name="nama" class="form-control" id="nama" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="jumlah">jumlah</label>
                <input type="bisniskey" class="form-control" name="jumlah" id="jumlah">
            </div>
            <div class="form-group">
                <label for="keterangan">keterangan</label>
                <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    @endsection