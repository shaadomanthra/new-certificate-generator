@extends('layouts.app')

@section('content')

    <div class="container">
        @if($info ?? "")
            <div class="alert alert-danger" role="alert">
                <h6>{{$info}}</h6>
            </div>
        @endif

        @if($success ?? "")
            <div class="alert alert-success" role="alert">
                <h6>{!! $success !!}</h6>
            </div>
        @endif
    </div>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6">
                <h1>Search, Edit & <span class="text-danger">Delete</span></h1>
                <h1>all your <span class="text-danger">database</span> records</h1>
            </div>
            <div class="col-6">
                <img src="{{asset("assets/images/database.svg")}}" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <form action="/dashboard/database/search" method="POST" class="d-flex justify-content-center align-items-center">
            @csrf
            <input type="text" class="form-control bg-dark text-white mr-2" placeholder="Search for a name" name="search_term" value="{{$search_term ?? ""}}">
            <button class="btn btn-outline-dark"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <table class="table table-striped table-dark text-center mt-4 rounded-lg">
        <thead class="thead-dark">
            <tr>
                <th>Options</th>
                <th>Id</th>
                <th class="text-warning">Verification ID</th>
                <th>Client</th>
                <th>Activity</th>
                <th>Name</th>
                <th>College</th>
                <th>Track</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Issued Date</th>
                <th>Percentage</th>
                <th>Template</th>
            </tr>
        </thead>
            @foreach($records as $record)
                <tr>
                    <td class="d-flex justify-content-center align-items-center">
                        <form action="/dashboard/edit_record/{{$record->verification_id}}" method="POST">
                            @csrf
                            <button class="btn btn-transparent text-info p-0 pr-2" name="edit_option" value="edit"><i class="fas fa-edit"></i></button>
                        </form>
                        <form action="/dashboard/delete_record/{{$record->verification_id}}" method="POST">
                            @csrf
                            <button class="btn btn-transparent text-danger p-0" name="delete_option" value="delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                    <td>{{$record->id}}</td>
                    <td>{{$record->verification_id}}</td>
                    <td>{{$record->client}}</td>
                    <td>{{$record->activity}}</td>
                    <td>{{$record->name}}</td>
                    <td>{{$record->college}}</td>
                    <td>{{$record->track}}</td>
                    <td>{{$record->start_date}}</td>
                    <td>{{$record->end_date}}</td>
                    <td>{{$record->issued_date}}</td>
                    <td>{{$record->percentage}}</td>
                    <td>{{$record->template}}</td>
                </tr>
            @endforeach
    </table>

    @if($links == "show")
        <div class="d-flex justify-content-end">
            {{$records->links()}}
        </div>
    @endif

@endsection()