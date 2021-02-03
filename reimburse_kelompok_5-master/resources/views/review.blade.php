@extends('templates/layout')

@section('container')
    <div class="container mt-3">
        <div class="row">
            <form action="/approve" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="nama" name="nama" class="form-control" id="nama" value="{{ $nama }}" disabled>
                </div>
                <div class="form-group">
                    <label for="jumlah">jumlah</label>
                    <input type="bisniskey" class="form-control" name="jumlah" id="jumlah" value="{{ $jumlah }}" disabled>
                </div>
                <div class="form-group">
                    <label for="keterangan">keterangan</label>
                    <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="10" disabled>{{ $keterangan }}</textarea>
                </div>
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="form-group">
                    <input type="radio" id="ya" name="approve" value="true">
                    <label for="ya">Ya</label><br>
                    <input type="radio" id="tidak" name="approve" value="false">
                    <label for="tidak">Tidak</label><br>
                </div>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    @endsection