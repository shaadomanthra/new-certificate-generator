@extends('layouts.app')

@section('content')

	<div class="container-fluid mt-3 bg-dark p-4 text-white rounded-lg">
        <div class="row">
            <div class="col-6 border-right border-white">
				<form action="create_template" method="POST">
					@csrf

					<h5 class="text-white">Template Name</h5>
					<input type="text" class="form-control" name="template_name" value="{{$template_name}}" readonly>

					<input type="text" class="form-control" name="template_design" value="{{$template_design}}" hidden>

					<div class="mt-4">
						<h5 class="text-warning">Text Align</h5>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" id="customRadioInline1" name="text_align" value="left" class="custom-control-input" {{$file->text_align == "left" ? "checked" : ""}}>
							<label class="custom-control-label" for="customRadioInline1">Left</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" id="customRadioInline2" name="text_align" value="center" class="custom-control-input" {{$file->text_align == "center" ? "checked" : ""}}>
							<label class="custom-control-label" for="customRadioInline2">Center</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" id="customRadioInline3" name="text_align" value="right" class="custom-control-input" {{$file->text_align == "right" ? "checked" : ""}}>
							<label class="custom-control-label" for="customRadioInline3">Right</label>
						</div>
					</div>

					<div class="mt-4">
						<h5 class="text-warning">Font Sizes</h5>
						<div class="row">
						<div class="col-4">
							<label>Large</label>
							<input type="text" class="form-control" name="large" placeholder="Default is 90" value={{$file->large ?? ''}}>
						</div>
						<div class="col-4">
							<label class="">Medium</label>
							<input type="text" class="form-control" name="medium" placeholder="Default is 55" value={{$file->medium ?? ''}}>
						</div>
						<div class="col-4">
							<label class="">Small</label>
							<input type="text" class="form-control" name="small" placeholder="Default is 40" value={{$file->small ?? ''}}>
						</div>
						</div>
					</div>
				
					<div class="mt-4">
						<h5 class="text-warning">Line Height</h5>
						<input type="text" class="form-control" name="line_height" placeholder="Default is 100" value="{{$file->line_height ?? ''}}">
					</div>

					<div class="mt-4">
						<h5 class="text-warning">Margins</h5>
						<div class="row">
							<div class="col-6">
								<label>Margin Top</label>
								<input type="text" class="form-control" placeholder="Default is 0" name="margin_top" value="{{$file->margin_top ?? ''}}">
							</div>
							<div class="col-6">
								<label>Margin Bottom</label>
								<input type="text" class="form-control" placeholder="Default is 0" name="margin_bottom" value="{{$file->margin_bottom ?? ''}}">
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-6">
								<label>Margin Left</label>
								<input type="text" class="form-control" placeholder="Default is 0" name="margin_left" value="{{$file->margin_left ?? ''}}">
							</div>
							<div class="col-6">
								<label>Margin Right</label>
								<input type="text" class="form-control" placeholder="Default is 0" name="margin_right" value="{{$file->margin_right ?? ''}}">
							</div>
						</div>
					</div>

					<div class="mt-4">
						<h5 class="text-warning">Text to be displayed</h5>

						<div class="mt-4 border border-white rounded-lg p-3">
							<h5>Accepted Variables</h5>
							<div class="py-2 bg-white text-dark rounded-lg d-flex justify-content-around align-items-center">
								<p class="m-0 p-0 text-danger font-weight-bold">@verification_id</p>
								<p class="m-0 p-0 text-danger font-weight-bold">@name</p>
								<p class="m-0 p-0 text-danger font-weight-bold">@roll_number</p>
								<p class="m-0 p-0 text-danger font-weight-bold">@college</p>
								<p class="m-0 p-0 text-danger font-weight-bold">@activity</p>
								<p class="m-0 p-0 text-danger font-weight-bold">@track</p>
								<p class="m-0 p-0 text-danger font-weight-bold">@start_date</p>
								<p class="m-0 p-0 text-danger font-weight-bold">@end_date</p>
								<p class="m-0 p-0 text-danger font-weight-bold">@percentage</p>
							</div>
						</div>

						<div class="mt-4 accordion" id="accordionExample">
							{{-- Lines --}}
							@for($i = 1; $i < 11; $i++)
								@php
									$line = "line_".$i;
									$size = "size_".$i;
									$font = "font_".$i;
									$color = "color_".$i;
									$line_margin_top = "margin_top_".$i;
								@endphp
								<div class="card border-0 rounded-0">
									<div class="card-header bg-dark" id="headingOne">
									<button class="btn btn-link btn-block text-left text-white text-decoration-none p-0 font-weight-bold d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#{{$line}}" aria-expanded="true" aria-controls={{$line}}>
											Line {{$i}}
											<i class="fas fa-caret-down"></i>
										</button>
									</div>
									<div id={{$line}} class="collapse" data-parent="#accordionExample">
										<div class="card-body px-5 text-dark">
											<label class="font-weight-bold">Text</label>
											<input type="text" placeholder="Enter the text" class="form-control" name={{$line}} value="{{$file->$line ?? ''}}">
											<label class="mt-3 font-weight-bold">Size</label>
											<select class="custom-select" name={{$size}}>
												<option value="large" {{$file->$size == "large" ? "selected" : ""}}>Large</option>
												<option value="medium" {{$file->$size == "medium" ? "selected" : ""}}>Medium</option>
												<option value="small" {{$file->$size == "small" ? "selected" : ""}}>Small</option>
											</select>
											<label class="mt-3 font-weight-bold">Font Family</label>
											<select class="custom-select" name={{$font}}>
												@foreach($fonts as $f)
													<option value="{{$f}}" {{$file->$font == $f ? "selected" : ""}}>{{$f}}</option>
												@endforeach
											</select>
											<label class="mt-3 font-weight-bold">Margin Top</label>
											<input type="text" class="form-control" name={{$line_margin_top}} placeholder="Default is 0" value="{{$file->$line_margin_top ?? ''}}">
											<label class="mt-3 font-weight-bold">Color</label>
											<div class="bg-dark p-3 rounded-lg text-white">
												<input type="text" name={{$color}} value="{{$file->$color ?? ''}}" placeholder="Default is #000" class="form-control">
												<small class="mt-4"><span class="text-danger">Note:</span> Enter the Hex value of the color you want</small>
											</div>
										</div>
									</div>
								</div>
							@endfor
							{{-- Lines End --}}
						</div>
					</div>				
					<div class="d-flex mt-4">
						<button class="btn btn-light" name="template_option" value="preview">Preview</button>
						<button class="btn btn-outline-light ml-3" name="template_option" value="save">Save & Exit</button>
					</div>
				</form>
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
				<img src="{{$img}}" class="img-fluid">
			</div>
        </div>
    </div>

@endsection