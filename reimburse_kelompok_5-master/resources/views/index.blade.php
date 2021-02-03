@extends('templates/layout')

@section('container')

    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 p-3 bg-light">
                <h1>Login</h1>
                <form action="">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" id="password" placeholder="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    @endsection