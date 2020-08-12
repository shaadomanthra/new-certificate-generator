@extends('layouts.app')

@section('content')

    @if($info ?? "")
        <div class="alert alert-danger mb-5" role="alert">
            {{$info}}
        </div>
    @endif
    @if($success ?? "")
        <div class="alert alert-success mb-5" role="alert">
            <h6>{{$success}}</h6>
        </div>
    @endif

    <div class="container text-center">
        <div class='d-flex justify-content-center mb-5'>
            <img src="{{ asset('assets/images/undraw_dashboard.svg') }}" class="img-fluid" width="500">
        </div>
    </div>

    <div class="container mt-5">
        <h3 class="text-center mb-4">See what you can do</h3>
        <div class="d-flex justify-content-around">
            <div class="bg-dark text-white p-3 rounded-lg" style="width: 15rem; box-shadow: 3px 6px 10px #fd9084">
                <h5>Create <span class="text-danger">Awesome</span> New Templates</h5>
                <a href="/dashboard/templates" class="btn btn-danger mt-4"><i class="fas fa-sliders-h mr-1"></i> Start Creating</a>
            </div>
            <div class="bg-dark text-white p-3 rounded-lg" style="width: 15rem; box-shadow: 3px 6px 10px #fd9084">
                <h5><span class="text-danger">Upload</span> files to the Storage</h5>
                <a href="/dashboard/upload" class="btn btn-outline-light mt-4"><i class="fas fa-upload mr-1"></i> Upload</a>
            </div>
            <div class="bg-dark text-white p-3 rounded-lg" style="width: 15rem; box-shadow: 3px 6px 10px #fd9084">
                <h5>Search, Edit & Delete <span class="text-danger">database</span> records</h5>
                <a href="/dashboard/database" class="btn btn-outline-light mt-4"><i class="fas fa-database mr-1"></i> Open Database</a>
            </div>
            <div class="bg-dark text-white p-3 rounded-lg" style="width: 15rem; box-shadow: 3px 6px 10px #fd9084">
                <h5>Manage all your <span class="text-danger">files</span> from a single place</h5>
                <a href="/dashboard/files" class="btn btn-outline-light mt-4"><i class="fas fa-folder mr-1"></i> File Archive</a>
            </div>
        </div>
    </div>

    <table class="table table-striped table-dark text-center mt-4 rounded-lg">
        <thead class="thead-dark">
            <tr>
                <th>Client</th>
                <th>Activity</th>
                <th>No of Certificates</th>
            </tr>
        </thead>
            @foreach($data as $d)
                <tr>
                    <td>{{$d['client']}}</td>
                    <td>{{$d['activity']}}</td>
                    <td>{{$d['count']}}</td>
                </tr>
            @endforeach
    </table>

@endsection