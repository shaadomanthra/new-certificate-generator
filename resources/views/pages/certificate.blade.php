@extends('layouts.app')

@section('content')

    @if($user_data ?? "")
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped table-dark text-center">
                    <thead>
                        <tr>
                            <th scope="col">Verification ID</th>
                            <th scope="col">Issued By</th>
                            <th scope="col">Issued To</th>
                            <th scope="col">Issued Date</th>
                            <th scope="col">Verification Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$user_data->verification_id}}</td>
                            <td>{{$user_data->issued_by}}</td>
                            <td>{{$user_data->name}}</td>
                            <td>{{$user_data->issued_date}}</td>
                            <td><i class="fas fa-check-circle text-success"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="container mt-5 d-flex flex-column align-items-center" style="position: relative;">
                <img src="{{$img}}" class="img-fluid">
                <form action="/download_certificate" method="POST" style="position: absolute; right: 5%;">
                    @csrf
                    <input type="text" name="verification_id" value="{{$verification_id}}" hidden>
                    <button class="btn btn-dark mt-3" id="save"  name="download" type="submit"><i class="fas fa-download"></i></button>
                </form>
            </div>
        </div>
    @elseif($info ?? "")
        <div class="container mt-4 text-center bg-dark text-white rounded-lg p-4">
            <h3 class="text-danger">{{$info}}</h3>
            <a href="/" class="btn btn-light mt-3">Back to Home</a>
        </div>
    @endif


@endsection()