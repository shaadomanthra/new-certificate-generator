@extends('layouts.app')

@section('content')

    <form action="change" method="POST" enctype="multipart/form-data" class="mt-5 p-5 bg-white">
        @csrf
        <input type="file" class="form-control-file" name="update_details">
        <button class="btn btn-dark mt-3">Submit</button>
    </form>

@endsection