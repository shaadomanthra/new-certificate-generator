@extends('layouts.app')

@section('content')

    <div class="container">
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
    </div>

    <div class="container-fluid" style="margin-top:6rem;">
        <h3 class="text-center mb-4">See what you can do</h3>
        <div class="row d-flex justify-content-around">
            <div class="col-12 col-lg-2 mt-3 mt-lg-0 bg-dark text-white p-3 rounded-lg" style="width: 18rem; box-shadow: 3px 6px 10px #fd9084">
                <h5>Create <span class="text-danger">Awesome</span> New Templates</h5>
                <a href="/dashboard/templates" class="btn btn-danger mt-4"><i class="fas fa-sliders-h mr-1"></i> Start Creating</a>
            </div>
            <div class="col-12 col-lg-2 mt-3 mt-lg-0 bg-dark text-white p-3 rounded-lg" style="width: 18rem; box-shadow: 3px 6px 10px #fd9084">
                <h5><span class="text-danger">Upload</span> files to the Storage</h5>
                <a href="/dashboard/upload" class="btn btn-outline-light mt-5"><i class="fas fa-upload mr-1"></i> Upload</a>
            </div>
            <div class="col-12 col-lg-2 mt-3 mt-lg-0 bg-dark text-white p-3 rounded-lg" style="width: 18rem; box-shadow: 3px 6px 10px #fd9084">
                <h5>Search, Edit & Delete <span class="text-danger">database</span> records</h5>
                <a href="/dashboard/database" class="btn btn-outline-light mt-4"><i class="fas fa-database mr-1"></i> Open Database</a>
            </div>
            <div class="col-12 col-lg-2 mt-3 mt-lg-0 bg-dark text-white p-3 rounded-lg" style="width: 18rem; box-shadow: 3px 6px 10px #fd9084">
                <h5>Manage all your <span class="text-danger">files</span> from a single place</h5>
                <a href="/dashboard/files" class="btn btn-outline-light mt-4"><i class="fas fa-folder mr-1"></i> File Archive</a>
            </div>
            <div class="col-12 col-lg-2 mt-3 mt-lg-0 bg-dark text-white p-3 rounded-lg" style="width: 18rem; box-shadow: 3px 6px 10px #fd9084">
                <h5>Bulk download <span class="text-danger">Certificates</span> of a particular activity</h5>
                <form action="/dashboard/bulkDownload" method="POST">
                    @csrf
                    <button class="btn btn-outline-light mt-4" name="download_action" value="view"><i class="fas fa-cloud-download-alt mr-1"></i> Bulk Download</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:8rem;">
        <h3><i class="fas fa-hat-wizard text-danger"></i> Records Based on Client and Activity</h3>
        <div class="table-responsive">
            <table class="table table-striped table-dark text-center mt-2 rounded-lg">
                <thead class="thead-dark">
                    <tr>
                        <th>Client</th>
                        <th>Activity</th>
                        <th>No of Certificates</th>
                    </tr>
                </thead>
                    @foreach($data as $d)
                        @if($d['count'] != 0)
                            <tr>
                                <td>{{$d['client']}}</td>
                                <td>{{$d['activity']}}</td>
                                <td>{{$d['count']}}</td>
                            </tr>
                        @endif
                    @endforeach
            </table>
        </div>
    </div>
    

@endsection