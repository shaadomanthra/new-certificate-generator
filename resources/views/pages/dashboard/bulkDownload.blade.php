@extends("layouts.app")

@section("content")

    <div class="container bg-dark p-3 rounded-lg text-white">
        <h3 class="text-center my-3">Bulk Download Certificates</h3>
        <form action="/dashboard/bulkDownload" method="POST">
            @csrf
            <h6 class="my-2">Client</h6>
            <select class="custom-select" name="client">
                @foreach($clients as $client)
                    <option value="{{$client->client}}">{{$client->client}}</option>
                @endforeach
            </select>
            <h6 class="my-2 mt-4">Activity</h6>
            <select class="custom-select" name="activity">
                @foreach($activities as $activity)
                    <option value="{{$activity->activity}}">{{$activity->activity}}</option>
                @endforeach
            </select>
            <button class="btn btn-danger mt-4" name="download_action" value="download">Download</button>
        </form>
    </div>

@endsection