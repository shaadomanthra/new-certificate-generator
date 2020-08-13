@extends('layouts.app')

@section('content')

    <script>

        function showImage(){
            var name = document.getElementById("certificate").value;
            if(name != "not-selected"){
                document.getElementById("certificate_image").src = "{{url('/')}}/default_conf/assets/images/"+name+".jpg";
            }
            else{
                document.getElementById("certificate_image").src = "";
            }
        }

    </script>

    <div class="container">
        @if ($info ?? "")
            <div class="alert alert-danger">
                <h6>{{ $info }}</h6>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <h6>{{ $error }}</h6>
                @endforeach
            </div>
        @endif
    </div>

    <div class="row mt-5">
        <div class="col-6 px-5 border-right border-dark">
            <h4 class="text-danger">Edit a Predefined Templates</h4>
            <form action="/dashboard/edit_default_template" method="POST" class="bg-dark p-4 text-white rounded-lg">
                @csrf
                <label>Enter a name</label>
                <input type="text" name="template_name" class="form-control">
                <label class="mt-3">Select a predefined template</label>
                <div class="d-flex">
                    <select id="certificate" class="custom-select bg-dark text-white" name="certificate_design" onchange="showImage()">
                        <option selected value="not-selected">Select the Certificate Design</option>
                        @foreach($images as $image)
                            @php
                                $name = explode("/", $image);
                                $name = explode(".", end($name));
                                $name = $name[0];
                            @endphp
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-light ml-3" name="template" value="new">Edit</button>
                </div>
            </form>
            
            <img src="" id="certificate_image" class="img-fluid mt-3">
        </div>
        <div class="col-6 px-5">
            <form action="/dashboard/create_template" method="POST" enctype="multipart/form-data">
                @csrf
                <h4 class="text-danger">Upload and edit a new Template</h4>
                <div class="form-group mt-3 bg-dark text-white p-3 rounded-lg">
                    <label>Name</label>
                    <input type="text" class="form-control" name="template_name">
                    <label for="exampleFormControlFile1" class="mt-4">Upload the design to start editing</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="template_design">
                    <h6 class="my-2"><span class="text-warning">Note: </span>Make sure the image width is less than <span class="text-danger">3508</span>px</h6>
                </div>
                <button class="btn btn-dark" name="template_option" value="new_template">Upload</button>
            </form>
        </div>
    </div>

@endsection