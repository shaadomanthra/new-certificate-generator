<form action="create_template" method="POST">
    @csrf
    <select class="custom-select bg-dark text-white" name="certificate_design">
        <option selected value="selected">Select the Certificate Design</option>
        @foreach($data['certificates'] as $d_c)
            <option value="{{$d_c}}">{{$d_c}}</option>
        @endforeach
    </select>
    <div class="mt-4">
        <h5 class="text-warning">Text Align</h5>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" name="text_align" value="left" class="custom-control-input" checked="checked">
            <label class="custom-control-label" for="customRadioInline1">Left</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" name="text_align" value="center" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline2">Center</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline3" name="text_align" value="right" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline3">Right</label>
        </div>
    </div>
    <div class="mt-4">
        <h5 class="text-warning">Font Sizes</h5>
        <div class="row">
        <div class="col-4">
            <label>Large</label>
            <input type="text" class="form-control" name="font_large" placeholder="Default is 90">
        </div>
        <div class="col-4">
            <label class="">Medium</label>
            <input type="text" class="form-control" name="font_medium" placeholder="Default is 55">
        </div>
        <div class="col-4">
            <label class="">Small</label>
            <input type="text" class="form-control" name="font_small" placeholder="Default is 40">
        </div>
        </div>
    </div>

    <div class="mt-4">
        <h5 class="text-warning">Line Height</h5>
        <input type="text" class="form-control" name="line_height">
    </div>
    
    <div class="mt-4">
        <h5 class="text-warning">Margins</h5>
        <div class="row">
            <div class="col-4">
                <label>Margin Top</label>
                <input type="text" class="form-control" placeholder="Default is 200" name="main_margin_top">
            </div>
            <div class="col-4">
                <label>Margin Left</label>
                <input type="text" class="form-control" placeholder="Default is 200" name="main_margin_left">
            </div>
            <div class="col-4">
                <label>Margin Right</label>
                <input type="text" class="form-control" placeholder="Default is 200" name="main_margin_right">
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h5 class="text-warning">Text to be displayed</h5>
        <div class="mt-4 accordion" id="accordionExample">
            {{-- Lines --}}
            <div class="card border-0 rounded-0">
                <div class="card-header bg-dark" id="headingOne">
                    <button class="btn btn-link btn-block text-left text-white text-decoration-none p-0 font-weight-bold d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Line 1
                        <i class="fas fa-caret-down"></i>
                    </button>
                </div>
                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body px-5 text-dark">
                        <label class="font-weight-bold">Text</label>
                        <input type="text" placeholder="Enter the text" class="form-control" name="line1_text">
                        <label class="mt-3 font-weight-bold">Size</label>
                        <select class="custom-select" name="line1_size">
                            <option selected value="not-selected">Select Font Size</option>
                            <option value="large">Large</option>
                            <option value="medium">Medium</option>
                            <option value="small">Small</option>
                        </select>
                        <label class="mt-3 font-weight-bold">Font Family</label>
                        <select class="custom-select" name="line1_font_family">
                            <option selected value="not-selected">Select the Font Family</option>
                            @foreach($data['fonts'] as $d_f)
                                <option value="{{$d_f}}">{{$d_f}}</option>
                            @endforeach
                        </select>
                        <label class="mt-3 font-weight-bold">Margin</label>
                        <div class="row">
                            <div class="col-6">
                                <label>Margin Top</label>
                                <input type="text" class="form-control" name="line1_margin_top">
                            </div>
                            <div class="col-6">
                                <label>Margin Bottom</label>
                                <input type="text" class="form-control" name="line1_margin_bottom">
                            </div>
                        </div>
                        <label class="mt-3 font-weight-bold">Color</label>
                        <div class="row bg-dark p-3 rounded-lg text-white">
                            <div class="col-4">
                                <label>Red</label>
                                <input type="text" class="form-control" name="line1_red">
                            </div>
                            <div class="col-4">
                                <label>Green</label>
                                <input type="text" class="form-control" name="line1_green">
                            </div>
                            <div class="col-4">
                                <label>Blue</label>
                                <input type="text" class="form-control" name="line1_blue">
                            </div>
                            <small class="mt-3 pl-3"><span class="text-danger">Note:</span> Enter the RGB values of the colour you want</small>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Line 2 --}}
            <div class="card border-0 rounded-0">
            <div class="card-header bg-dark" id="headingTwo">
                <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed text-white text-decoration-none p-0 font-weight-bold d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Line 2
                    <i class="fas fa-caret-down"></i>
                </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body px-5 text-dark">
                    <label class="font-weight-bold">Text</label>
                    <input type="text" placeholder="Enter the text" class="form-control" name="line2_text">
                    <label class="mt-3 font-weight-bold">Size</label>
                    <select class="custom-select" name="line2_size">
                        <option selected value="not-selected">Select Font Size</option>
                        <option value="large">Large</option>
                        <option value="medium">Medium</option>
                        <option value="small">Small</option>
                    </select>
                    <label class="mt-3 font-weight-bold">Font Family</label>
                    <select class="custom-select" name="line2_font_family">
                        <option selected value="not-selected">Select the Font Family</option>
                        @foreach($data['fonts'] as $d_f)
                            <option value="{{$d_f}}">{{$d_f}}</option>
                        @endforeach
                    </select>
                    <label class="mt-3 font-weight-bold">Margin</label>
                    <div class="row">
                        <div class="col-6">
                            <label>Margin Top</label>
                            <input type="text" class="form-control" name="line2_margin_top">
                        </div>
                        <div class="col-6">
                            <label>Margin Bottom</label>
                            <input type="text" class="form-control" name="line2_margin_bottom">
                        </div>
                    </div>
                    <label class="mt-3 font-weight-bold">Color</label>
                    <div class="row bg-dark p-3 rounded-lg text-white">
                        <div class="col-4">
                            <label>Red</label>
                            <input type="text" class="form-control" name="line2_red">
                        </div>
                        <div class="col-4">
                            <label>Green</label>
                            <input type="text" class="form-control" name="line2_green">
                        </div>
                        <div class="col-4">
                            <label>Blue</label>
                            <input type="text" class="form-control" name="line2_blue">
                        </div>
                        <small class="mt-3 pl-3"><span class="text-danger">Note:</span> Enter the RGB values of the colour you want</small>
                    </div>
                </div>
            </div>
            </div>
            {{-- Line 3 --}}
            <div class="card border-0 rounded-0">
                <div class="card-header bg-dark" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed text-white text-decoration-none p-0 font-weight-bold d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Line 3
                        <i class="fas fa-caret-down"></i>
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body px-5 text-dark">
                        <label class="font-weight-bold">Text</label>
                        <input type="text" placeholder="Enter the text" class="form-control" name="line3_text">
                        <label class="mt-3 font-weight-bold">Size</label>
                        <select class="custom-select" name="line3_size">
                            <option selected value="not-selected">Select Font Size</option>
                            <option value="large">Large</option>
                            <option value="medium">Medium</option>
                            <option value="small">Small</option>
                        </select>
                        <label class="mt-3 font-weight-bold">Font Family</label>
                        <select class="custom-select" name="line3_font_family">
                            <option selected value="not-selected">Select the Font Family</option>
                            @foreach($data['fonts'] as $d_f)
                                <option value="{{$d_f}}">{{$d_f}}</option>
                            @endforeach
                        </select>
                        <label class="mt-3 font-weight-bold">Margin</label>
                        <div class="row">
                            <div class="col-6">
                                <label>Margin Top</label>
                                <input type="text" class="form-control" name="line3_margin_top">
                            </div>
                            <div class="col-6">
                                <label>Margin Bottom</label>
                                <input type="text" class="form-control" name="line3_margin_bottom">
                            </div>
                        </div>
                        <label class="mt-3 font-weight-bold">Color</label>
                        <div class="row bg-dark p-3 rounded-lg text-white">
                            <div class="col-4">
                                <label>Red</label>
                                <input type="text" class="form-control" name="line3_red">
                            </div>
                            <div class="col-4">
                                <label>Green</label>
                                <input type="text" class="form-control" name="line3_green">
                            </div>
                            <div class="col-4">
                                <label>Blue</label>
                                <input type="text" class="form-control" name="line3_blue">
                            </div>
                            <small class="mt-3 pl-3"><span class="text-danger">Note:</span> Enter the RGB values of the colour you want</small>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Line 4 --}}
            <div class="card border-0 rounded-0">
                <div class="card-header bg-dark" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed text-white text-decoration-none p-0 font-weight-bold d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Line 4
                    <i class="fas fa-caret-down"></i>
                    </button>
                </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                    <div class="card-body px-5 text-dark">
                        <label class="font-weight-bold">Text</label>
                        <input type="text" placeholder="Enter the text" class="form-control" name="line4_text">
                        <label class="mt-3 font-weight-bold">Size</label>
                        <select class="custom-select" name="line4_size">
                            <option selected value="not-selected">Select Font Size</option>
                            <option value="large">Large</option>
                            <option value="medium">Medium</option>
                            <option value="small">Small</option>
                        </select>
                        <label class="mt-3 font-weight-bold">Font Family</label>
                        <select class="custom-select" name="line4_font_family">
                            <option selected value="not-selected">Select the Font Family</option>
                            @foreach($data['fonts'] as $d_f)
                                <option value="{{$d_f}}">{{$d_f}}</option>
                            @endforeach
                        </select>
                        <label class="mt-3 font-weight-bold">Margin</label>
                        <div class="row">
                            <div class="col-6">
                                <label>Margin Top</label>
                                <input type="text" class="form-control" name="line4_margin_top">
                            </div>
                            <div class="col-6">
                                <label>Margin Bottom</label>
                                <input type="text" class="form-control" name="line4_margin_bottom">
                            </div>
                        </div>
                        <label class="mt-3 font-weight-bold">Color</label>
                        <div class="row bg-dark p-3 rounded-lg text-white">
                            <div class="col-4">
                                <label>Red</label>
                                <input type="text" class="form-control" name="line4_red">
                            </div>
                            <div class="col-4">
                                <label>Green</label>
                                <input type="text" class="form-control" name="line4_green">
                            </div>
                            <div class="col-4">
                                <label>Blue</label>
                                <input type="text" class="form-control" name="line4_blue">
                            </div>
                            <small class="mt-3 pl-3"><span class="text-danger">Note:</span> Enter the RGB values of the colour you want</small>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Line 5 --}}
            <div class="card border-0 rounded-0">
                <div class="card-header bg-dark" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed text-white text-decoration-none p-0 font-weight-bold d-flex justify-content-between align-items-center" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Line 5
                        <i class="fas fa-caret-down"></i>
                        </button>
                    </h2>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                    <div class="card-body px-5 text-dark">
                        <label class="font-weight-bold">Text</label>
                        <input type="text" placeholder="Enter the text" class="form-control" name="line5_text">
                        <label class="mt-3 font-weight-bold">Size</label>
                        <select class="custom-select" name="line5_size">
                            <option selected value="not-selected">Select Font Size</option>
                            <option value="large">Large</option>
                            <option value="medium">Medium</option>
                            <option value="small">Small</option>
                        </select>
                        <label class="mt-3 font-weight-bold">Font Family</label>
                        <select class="custom-select" name="line5_font_family">
                            <option selected value="not-selected">Select the Font Family</option>
                            @foreach($data['fonts'] as $d_f)
                                <option value="{{$d_f}}">{{$d_f}}</option>
                            @endforeach
                        </select>
                        <label class="mt-3 font-weight-bold">Margin</label>
                        <div class="row">
                            <div class="col-6">
                                <label>Margin Top</label>
                                <input type="text" class="form-control" name="line5_margin_top">
                            </div>
                            <div class="col-6">
                                <label>Margin Bottom</label>
                                <input type="text" class="form-control" name="line5_margin_bottom">
                            </div>
                        </div>
                        <label class="mt-3 font-weight-bold">Color</label>
                        <div class="row bg-dark p-3 rounded-lg text-white">
                            <div class="col-4">
                                <label>Red</label>
                                <input type="text" class="form-control" name="line5_red">
                            </div>
                            <div class="col-4">
                                <label>Green</label>
                                <input type="text" class="form-control" name="line5_green">
                            </div>
                            <div class="col-4">
                                <label>Blue</label>
                                <input type="text" class="form-control" name="line5_blue">
                            </div>
                            <small class="mt-3 pl-3"><span class="text-danger">Note:</span> Enter the RGB values of the colour you want</small>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Lines End --}}
        </div>
    </div>

    <div class="mt-5">
        <button class="btn btn-light rounded-lg" name="save_button" value="preview" >Preview</button>
        <button class=" ml-3 btn btn-outline-light rounded-lg" name="save_button" value="save" >Save & Exit</button>
    </div>
    
</form>