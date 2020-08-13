@extends('layouts.app')

@section('content')

    <script>

        function showTemplate(){
            var name = document.getElementById("template_name").value;
            var count = "";
            if(name != "not_selected"){
                count = name.split("_").length;
                if(count == 3){
                    var value = name.split("_");
                    var url = "{{url('/')}}/default_conf/assets/images/"+value[1]+"_"+value[2]+".jpg";
                    document.getElementById("template_image").src = url;
                }
                else{
                    document.getElementById("template_image").src = "{{url('/')}}/certificate_designs/"+name+".jpg";
                }
            }
            else{
                document.getElementById("template_image").src = "";
            }
        }

    </script>

    @if($info ?? "")
        <div class="alert alert-danger" role="alert">
            <h6>{{$info}}</h6>
        </div>
    @endif

    @if($success ?? "")
        <div class="alert alert-success" role="alert">
            <h6>{!! $success !!}</h6>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <h6>{{ $error }}</h6>
            @endforeach
        </div>
    @endif

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6">
                <h1>Upload <span class="text-danger">Anything</span></h1>
                <h1>from here</h1>
            </div>
            <div class="col-6">
                <img src="{{asset("assets/images/uploads.svg")}}" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-toggle="pill" href="#pills-certificate-details" role="tab" aria-selected="true">Certificate Details</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " data-toggle="pill" href="#pills-font" role="tab">Font</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " data-toggle="pill" href="#pills-logo" role="tab">Logo</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link " data-toggle="pill" href="#pills-signature" role="tab">Signature</a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-certificate-details" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="container bg-dark rounded mt-3 p-5 text-white">
                    <form action="upload_certificate_details" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h4 class="text-white text-center mb-4">Upload the CSV file</h4> 
                        <label>Client</label>
                        <input type="text" placeholder="Ex: Xplore" class="form-control" name="client">
                        <label class="mt-3">Certificate Issued by</label>
                        <input type="text" placeholder="Ex: CSI & GCSF" class="form-control" name="issued_by">
                        <label class="mt-3">Activity</label>
                        <input type="text" placeholder="Ex: Internship" class="form-control" name="activity">
                        <label class="mt-3">Template</label>
                        <select class="custom-select" id="template_name" name="template_name" onchange="showTemplate()">
                            <option value="not_selected">Select the Template</option>
                            <option value="default_template_1">default_template_1</option>
                            <option value="default_template_2">default_template_2</option>
                            <option value="default_template_3">default_template_3</option>
                            @foreach($templates as $t)
                                <option value="{{$t}}">{{$t}}</option>
                            @endforeach
                        </select>
                        <img src="" class="img-fluid my-3" id="template_image">
                        <input type="file" class="form-control-file mt-4" name="certificate_details">
                        <button class="btn btn-danger d-block mt-3" type="submit">Upload</button>
                    </form>
                    <hr class="bg-white mt-5">
                    <p class="p-0 m-0 d-flex align-items-center justify-content-start"><i class="fas fa-file-csv text-danger fa-2x mr-2 border border-white p-2 rounded-lg"></i> Download the CSV template and add data to it. <a href="downloadCsv" class="btn btn-warning btn-sm ml-2">Download</a></p>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-font" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="container bg-dark rounded mt-3 p-5 text-white">
                    <h4 class="text-white text-center mb-4">Upload a New Font</h4>
                    <form action="upload_font" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="font-weight-bold">Name to Save</label>
                        <input type="text" class="form-control mb-4" placeholder="Enter the name" name="new_font_name">
                        <input type="file" class="form-control-file" name="new_font">
                        <button class="btn btn-danger d-block mt-3" type="submit">Upload</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-logo" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="container bg-dark rounded mt-3 p-5 text-white">
                    <h4 class="text-white text-center mb-4">Upload a New Logo</h4>
                    <form action="upload_logo" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="font-weight-bold">Name to Save</label>
                        <input type="text" class="form-control mb-4" placeholder="Enter the name" name="new_logo_name">
                        <input type="file" class="form-control-file" name="new_logo">
                        <h6 class="mt-2"><span class="text-warning">Note: </span>Make sure the image dimensions are <span class="text-danger">500x500</span></h6>
                        <button class="btn btn-danger d-block mt-4" type="submit">Upload</button>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-signature" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="container bg-dark rounded mt-3 p-5 text-white">
                    <h4 class="text-white text-center mb-4">Upload a New Signature</h4>
                    <form action="upload_sign" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="font-weight-bold">Name to Save</label>
                        <input type="text" class="form-control mb-4" placeholder="Enter the name" name="new_sign_name">
                        <input type="file" class="form-control-file" name="new_sign">
                        <h6 class="mt-2"><span class="text-warning">Note: </span>Make sure the image dimensions are <span class="text-danger">500x500</span></h6>
                        <button class="btn btn-danger d-block mt-4" type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection()