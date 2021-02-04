@extends('templates/layout')

@section('container')
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <h1>Data Reimburs</h1>
                <p>Nama: <b>{{ $nama }}</b></p>
                <p>Jumlah: <b>{{ $jumlah }}</b></p>
                <p>Keterangan: <b>{{ $keterangan }}</b></p>
                
                <form action="/approve" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="form-group">
                        <input type="radio" id="ya" name="approve" value="true">
                        <label for="ya">Setuju</label><br>
                        <input type="radio" id="tidak" name="approve" value="false">
                        <label for="tidak">Kurang</label><br>
                    </div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>

    @endsection