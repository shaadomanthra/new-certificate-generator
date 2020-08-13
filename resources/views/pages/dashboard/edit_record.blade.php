@extends('layouts.app')

@section('content')

    <div class="container rounded-lg p-5 bg-dark text-white">
        <h4 class="text-center mt-3 text-white">Verification ID : <span class="text-warning">{{$record->verification_id}}</span></h4>
        <form action="{{$record->verification_id}}" method="POST">
            @csrf
            <div class="mt-5">
                <label class="font-weight-bold">Client</label>
                <input type="text" class="form-control" value="{{$record->client}}" name="client">
            </div>

            <label class="font-weight-bold mt-3">Name</label>
            <input type="text" class="form-control" value="{{$record->name}}" name="name">

            <div class="row mt-3">
                <div class="col-4">
                    <label class="font-weight-bold">Gender</label>
                    <input type="text" class="form-control" value="{{$record->gender}}" name="gender">
                </div>
                <div class="col-4">
                    <label class="font-weight-bold">Email</label>
                    <input type="text" class="form-control" value="{{$record->email}}" name="email">
                </div>
                <div class="col-4">
                    <label class="font-weight-bold">Mobile Number</label>
                    <input type="text" class="form-control" value="{{$record->mobile_number}}" name="mobile_number">
                </div>
            </div>

            <label class="font-weight-bold mt-3">College</label>
            <input type="text" class="form-control" value="{{$record->college}}" name="college">

            <div class="row mt-3">
                <div class="col-6">
                    <label class="font-weight-bold">Activity</label>
                    <input type="text" class="form-control" value="{{$record->activity}}" name="activity">
                </div>
                <div class="col-6">
                    <label class="font-weight-bold">Track</label>
                    <input type="text" class="form-control" value="{{$record->track}}" name="track">
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-4">
                    <label class="font-weight-bold">Start Date</label>
                    <input type="text" class="form-control mb-4" value="{{$record->start_date}}" name="start_date">
                </div>
                <div class="col-4">
                    <label class="font-weight-bold">End Date</label>
                    <input type="text" class="form-control mb-4" value="{{$record->end_date}}" name="end_date">
                </div>
                <div class="col-4">
                    <label class="font-weight-bold">Issued Date</label>
                    <input type="text" class="form-control mb-4" value="{{$record->issued_date}}" name="issued_date">
                </div>
            </div>
            <label class="font-weight-bold">Percentage</label>
            <input type="text" class="form-control mb-4" value="{{$record->percentage}}" name="percentage">

            <button class="btn btn-danger d-block mt-3" type="submit" name="edit_option" value="update">Update</button>
        </form>
    </div>

@endsection()