@extends('templates/layout')

@section('container')
    <div class="container mt-5">
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
                            <th scope="col">No</th>
                            <th scope="col">Review</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($results === [])
                        <tr>
                            <td>Data Kosong</td>
                        </tr>
                        
                    @else
                        @foreach ($results as $result)
                            @if ($result['name'] === 'Input Bukti Transfer')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result['name'] }}</td>
                                <td><a href="/bukti/<?= $result['id'] ?>" class="badge badge-success">Detail</a></td>
                            </tr>
                            @elseif ($result['name'] === 'Input Alasan Penolakan')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result['name'] }}</td>
                                <td><a href="/bukti/<?= $result['id'] ?>" class="badge badge-success">Detail</a></td>
                            </tr>
                            @else
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result['name'] }}</td>
                                <td><a href="/detail/<?= $result['id'] ?>" class="badge badge-success">Detail</a></td>
                            </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection