<form action="create_template" method="POST">
    @csrf
    <input type="text" value="{{$json_data->certificate_design}}" name="certificate_design" readonly class="form-control bg-dark text-white">
    <div class="mt-4">
        <h5 class="text-warning">Text Align</h5>    
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" name="text_align" value="left" class="custom-control-input" {{$json_data->text_align == "left" ? "checked" : ""}}>
            <label class="custom-control-label" for="customRadioInline1">Left</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" name="text_align" value="center" class="custom-control-input" {{$json_data->text_align == "center" ? "checked" : ""}}>
            <label class="custom-control-label" for="customRadioInline2">Center</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline3" name="text_align" value="right" class="custom-control-input" {{$json_data->text_align == "right" ? "checked" : ""}}>
            <label class="custom-control-label" for="customRadioInline3">Right</label>
        </div>
    </div>
    <div class="mt-4">
        <h5 class="text-warning">Font Sizes</h5>
        <div class="row">
        <div class="col-4">
            <label>Large</label>
            <input type="text" class="form-control" name="font_large" placeholder="Default is 90" value={{$json_data->font_large ?? ''}}>
        </div>
        <div class="col-4">
            <label class="">Medium</label>
            <input type="text" class="form-control" name="font_medium" placeholder="Default is 55" value={{$json_data->font_medium ?? ''}}>
        </div>
        <div class="col-4">
            <label class="">Small</label>
            <input type="text" class="form-control" name="font_small" placeholder="Default is 40" value={{$json_data->font_small ?? ''}}>
        </div>
        </div>
    </div>

    <div class="mt-4">
        <h5 class="text-warning">Line Height</h5>
        <input type="text" class="form-control" name="line_height" placeholder="Default is 100" value={{$json_data->line_height ?? ''}}>
    </div>
    
    <div class="mt-4">
        <h5 class="text-warning">Margins</h5>
        <div class="row">
            <div class="col-4">
                <label>Margin Top</label>
                <input type="text" class="form-control" placeholder="Default is 200" name="main_margin_top" value="{{$json_data->main_margin_top ?? ''}}">
            </div>
            <div class="col-4">
                <label>Margin Left</label>
                <input type="text" class="form-control" placeholder="Default is 0" name="main_margin_left" value="{{$json_data->main_margin_left ?? ''}}">
            </div>
            <div class="col-4">
                <label>Margin Right</label>
                <input type="text" class="form-control" placeholder="Default is 0" name="main_margin_right" value="{{$json_data->main_margin_right ?? ''}}">
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h5 class="text-warning">Text to be displayed</h5>
        <div class="mt-4 accordion" id="accordionExample">
            {{-- Lines --}}
            @for($i = 1; $i <= 5; $i++)
                @php
                    $line = "line".$i."_";
                    $text = $line."text";
                    $size = $line."size";
                    $font_family = $line."font_family";
                    $margin_top = $line."margin_top";
                    $red = $line."red";
                    $green = $line."green";
                    $blue = $line."blue";
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
                            <input type="text" placeholder="Enter the text" class="form-control" name="line{{$i}}_text" value="{{$json_data->$text ?? ''}}">
                            <label class="mt-3 font-weight-bold">Size</label>
                            <select class="custom-select" name="line{{$i}}_size">
                                <option value="not-selected" {{$json_data->$size == "not-selected" ? "selected" : ""}}>Select Font Size</option>
                                <option value="large" {{$json_data->$size == "large" ? "selected" : ""}}>Large</option>
                                <option value="medium" {{$json_data->$size == "medium" ? "selected" : ""}}>Medium</option>
                                <option value="small">Small</option>
                            </select>
                            <label class="mt-3 font-weight-bold">Font Family</label>
                            <select class="custom-select" name="line{{$i}}_font_family">
                                <option value="not-selected" {{$json_data->$font_family == "not-selected" ? "selected" : ""}}>Select the Font Family</option>
                                @foreach($data['fonts'] as $d_f)
                                    <option value="{{$d_f}}" {{$json_data->$font_family == $d_f ? "selected" : ""}}>{{$d_f}}</option>
                                @endforeach
                            </select>
                            <label class="mt-3 font-weight-bold">Margin Top</label>
                            <input type="text" class="form-control" name="line{{$i}}_margin_top" placeholder="Default is 0" value={{$json_data->$margin_top ?? ''}}>
                            <label class="mt-3 font-weight-bold">Color</label>
                            <div class="row bg-dark p-3 rounded-lg text-white">
                                <div class="col-4">
                                    <label>Red</label>
                                    <input type="text" class="form-control" name="line{{$i}}_red" placeholder="Default is 0" value={{$json_data->$red ?? ''}}>
                                </div>
                                <div class="col-4">
                                    <label>Green</label>
                                    <input type="text" class="form-control" name="line{{$i}}_green" placeholder="Default is 0" value={{$json_data->$green ?? ''}}>
                                </div>
                                <div class="col-4">
                                    <label>Blue</label>
                                    <input type="text" class="form-control" name="line{{$i}}_blue" placeholder="Default is 0" value={{$json_data->$blue ?? ''}}>
                                </div>
                                <small class="mt-3 pl-3"><span class="text-danger">Note:</span> Enter the RGB values of the colour you want</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
            {{-- Lines End --}}
        </div>
    </div>

    <div class="mt-5 d-flex justify-content-between">
        <div>
            <button class="btn btn-light rounded-lg" name="save_button" value="preview" >Preview</button>
            <button class="ml-3 btn btn-outline-light rounded-lg" name="save_button" value="save" >Save & Exit</button>
        </div>
        <a href="/dashboard/certificate_template" class="btn btn-danger rounded-lg">Reset</a>

    </div>
    
</form>