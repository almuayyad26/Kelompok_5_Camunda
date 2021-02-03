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
                        <td>{{ $result['name'] }}<a href="/sendReceive/<?= $result['id'] ?>">Send Email</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection