@extends('templates/layout')

@section('container')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block mt-3">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
	    @endif
        <div class="row">
            <div class="col-8">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                        <tr>
                            <td>
                                {{ $result['id'] }}
                                {{ $result['name'] }} 
                                <form action="/approve" method="POST">
                                @csrf
                                    <p>Approve task?</p>
                                    <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                    <input type="radio" id="ya" name="approve" value="true">
                                    <label for="ya">Ya</label><br>
                                    <input type="radio" id="tidak" name="approve" value="false">
                                    <label for="tidak">Tidak</label><br>
                                    <input type="submit" value="Submit">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <form action="/task2submit" method="GET">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">bisniskey</label>
                        <input type="bisniskey" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <textarea name="email" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @endsection