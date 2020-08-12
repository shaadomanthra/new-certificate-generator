@extends("layouts.app")

@section("content")

<div class="container-fluid mt-3 p-4 text-dark rounded-lg">
	<div class="row">
		<div class="col-6 border-right border-dark">
			@if($certificate_design)
				@include("pages.dashboard.components.".$certificate_design)
			@endif
		</div>
		<div class="col-6 d-flex justify-content-center align-items-center">
			<img src="{{$img}}" class="img-fluid">
		</div>
	</div>
</div>

@endsection