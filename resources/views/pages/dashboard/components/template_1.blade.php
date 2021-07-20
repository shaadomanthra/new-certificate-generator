<form action="edit_default_template" method="POST">
    @csrf
    <h4 class="text-dark">Selected Template</h4>
    <input type="text" value="{{$certificate_design}}" name="certificate_design" readonly class="form-control bg-dark text-white">

    <h4 class="text-dark mt-4">Template name</h4>
    <input type="text" value="{{$template_name}}" name="template_name" readonly class="form-control bg-dark text-white">

    <h4 class="m-0 mt-3 mb-1 text-danger">Logos</h4>
    <small>Leave empty for default logos</small>
    <div class="row">
        <div class="col-6">
            <select class="custom-select bg-dark text-white" name="logo_1">
                <option value="default">Default</option>
                @foreach($logos as $logo)
                    @php
                        $l = explode("/", $logo);
                        $l = explode(".", end($l));
                        $l = $l[0];
                    @endphp
                    <option value="{{$logo}}" {{$file->logo_1 == $logo ? "selected" : ""}}>{{$l}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <select class="custom-select bg-dark text-white" name="logo_2">
                <option value="default">Default</option>
                @foreach($logos as $logo)
                    @php
                        $l = explode("/", $logo);
                        $l = explode(".", end($l));
                        $l = $l[0];
                    @endphp
                    <option value="{{$logo}}" {{$file->logo_2 == $logo ? "selected" : ""}}>{{$l}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <h4 class="mt-4 text-danger">Title</h4>
    <input type="text" class="form-control bg-dark text-white" name="title" value="{{$file->title}}">

    <h4 class="mt-4 text-danger">Lines</h4>
    <div class="bg-dark text-white p-3 rounded-lg">
        <h5>Accepted Variables</h5>
        <div class="py-2 border border-white rounded-lg d-flex justify-content-around align-items-center">
            <p class="m-0 p-0">@verification_id</p>
            <p class="m-0 p-0">@name</p>
            <p class="m-0 p-0">@roll_number</p>
            <p class="m-0 p-0">@college</p>
            <p class="m-0 p-0">@activity</p>
            <p class="m-0 p-0">@track</p>
            <p class="m-0 p-0">@start_date</p>
            <p class="m-0 p-0">@end_date</p>
            <p class="m-0 p-0">@percentage</p>
        </div>
        <input type="text" class="form-control mt-4" name="line_1" value="{{$file->line_1}}">
        <input type="text" class="form-control mt-2" name="line_2" value="{{$file->line_2}}">
        <input type="text" class="form-control mt-2" name="line_3" value="{{$file->line_3}}">
        <input type="text" class="form-control mt-2" name="line_4" value="{{$file->line_4}}">
        <input type="text" class="form-control mt-2" name="line_5" value="{{$file->line_5}}">
        <input type="text" class="form-control mt-2" name="line_6" value="{{$file->line_6}}">
    </div>

    <h4 class="m-0 mt-4 mb-1 text-danger">Signatures</h4>
    <div class="bg-dark text-white p-3 rounded-lg">
        <div class="d-flex">
            <div class="form-group m-0 pr-3 border-right border-white">
                <select class="custom-select" name="sign_1">
                    <option value="default">Default</option>
                    @foreach($signs as $sign)
                        @php
                            $name = explode("/", $sign);
                            $name = explode(".", end($name));
                            $name = $name[0];
                        @endphp
                        <option value="{{$sign}}" {{$file->sign_1 == $sign ? "selected" : ""}}>{{$name}}</option>
                    @endforeach
                </select>

                <label class="font-weight-bold mt-3">Name</label>
                <input type="text" class="form-control" name="sign_name_1" value="{{$file->sign_name_1}}">

                <label class="font-weight-bold mt-3">Info</label>
                <input type="text" class="form-control" name="sign_info_1" value="{{$file->sign_info_1}}">
            </div>
            <div class="form-group m-0 pl-3">
                <select class="custom-select" name="sign_2">
                    <option value="default">Default</option>
                    @foreach($signs as $sign)
                        @php
                            $name = explode("/", $sign);
                            $name = explode(".", end($name));
                            $name = $name[0];
                        @endphp
                        <option value="{{$sign}}" {{$file->sign_2 == $sign ? "selected" : ""}}>{{$name}}</option>
                    @endforeach
                </select>

                <label class="font-weight-bold mt-3">Name</label>
                <input type="text" class="form-control" name="sign_name_2" value="{{$file->sign_name_2}}">

                <label class="font-weight-bold mt-3">Info</label>
                <input type="text" class="form-control" name="sign_info_2" value="{{$file->sign_info_2}}">
            </div>
        </div>
    </div>

    <h4 class="m-0 mt-4 mb-1 text-danger">Info</h4>
    <input type="text" class="form-control bg-dark text-white" name="info_1" value="{{$file->info_1}}">    
    <input type="text" class="form-control bg-dark text-white mt-2" name="info_2" value="{{$file->info_2}}">    

    <div class="d-flex mt-4">
        <button class="btn btn-dark" name="template" value="preview" type="submit">Preview</button>
        <button class="btn btn-outline-dark ml-3" name="template" value="save" type="submit">Save & Exit</button>
    </div>

</form>