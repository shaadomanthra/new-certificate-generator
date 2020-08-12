@extends('layouts.app')

@section('content')

    <div class="container mt-5 text-center" style="min-height: 80vh">
    <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" width="200">
        <h2 class="mb-5 text-secondary">Welcome to Xplore Certificate Validator</h2>
        <div class="row d-flex align-items-center">
            <div class="col-12 col-md-6">
                <div class="container p-3 rounded" style="background: #f8e4c5;">
                    <h4 class="heading">Enter the Number</h4>
                    <input type="text" class="form-control mt-3" id="verification_id">
                    <button class="btn btn-danger mt-3" onclick="showCertificate()">Validate</button>
                </div>  
            </div>
            <div class="col-12 col-md-6 mt-5">
            <img src="{{ asset('assets/images/undraw_search.svg') }}" class="img-fluid">
            </div>
        </div>
        
    </div>

    <script>
        function showCertificate(){
            var id = document.getElementById("verification_id").value;
            window.location.href = '/'+id;
        }
    </script>

@endsection()