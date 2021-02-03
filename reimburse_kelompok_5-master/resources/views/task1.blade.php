@extends('templates/layout')

@section('container')
    <div class="container">
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