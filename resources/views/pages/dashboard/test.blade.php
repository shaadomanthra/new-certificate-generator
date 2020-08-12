@extends('layouts.app')

@section('content')

	@if($data['info'] ?? '')
		@if($data['info'] == 'no_template')
			<div class="alert alert-danger mb-5" role="alert">
				{{"Please select a template first"}}
			</div>
		@else
			<div class="alert alert-success mb-5" role="alert">
				{{$data['info']}}
			</div>
		@endif
	@endif



    {{-- <div class="container-fluid mt-3 bg-dark p-4 text-white rounded-lg">
        <div class="row">
            <div class="col-6 border-right border-whites overflow-scroll">
				@if($json_data ?? "")
					@include("pages.dashboard.components.predefined_template")
				@else
					@include("pages.dashboard.components.new_template")
				@endif
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
				@if($img ?? "")
					<img src="{{$img}}" class="img-fluid">
				@else
					<h5>Select a template and click on preview</h5>
				@endif
			</div>
        </div>
    </div> --}}

	<div class="container-fluid mt-3 bg-dark p-4 text-white rounded-lg">
        <div class="row">
            <div class="col-6 border-right border-whites overflow-scroll">
				
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
				<img src="{{$img}}" class="img-fluid">
			</div>
        </div>
    </div>

@endsection