@extends("layouts.app")

@section('content')

    @if($session_key ?? "")
        <div class="container">
            <div class="bg-dark text-white p-3 my-3">
                <h6 class="font-weight-bold text-danger m-0">File Name: </h6>
                <h5>certificates<span class="text-warning">.zip</span></h5>

                <h6 class="font-weight-bold text-muted m-0 mt-3">Temp Name: </h6>
                <h6>{{$session_key}}<span class="text-warning">.zip</span></h6>
                
                <h6 class="font-weight-bold text-muted m-0 mt-3">File Size: </h6>
                <h6>{{$size}}<span class="text-warning"> mb</span></h6>
            </div>
            <form action="/dashboard/downloadZip" method="POST">
                @csrf
                <h3>Download the zip file</h3>
                <input type="text" name="session_key" value="{{$session_key}}" hidden>
                <button class="btn btn-danger">Download</button>
            </form>
        </div>
    @else
        <div class="container bg-dark text-white p-3 text-center">
            <h5 class="text-warning">{{$info ?? ""}}</h5>
            <h6 class="text-muted">The file cannot be downloaded anymore</h6>
        </div>
    @endif

@endsection