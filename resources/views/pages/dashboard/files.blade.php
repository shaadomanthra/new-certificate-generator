@extends('layouts.app')

@section('content')

    <div class="container mt-5" style="min-height: 50vh;">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-6">
                <h1 style="font-size: 3rem;">Manage <span class="text-danger">all your files</span></h1>
                <h1 style="font-size: 3rem;">in <span class="text-danger">one place</span></h1>
                <h3 class="pt-3 text-muted">A comfortable way to have access to all your files</h3>
            </div>
            <div class="col-6">
                <img src="{{ asset('assets/images/files.svg') }}" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-6 p-0 pr-5">
                <h3><i class="fas fa-draw-polygon text-danger"></i> Logos</h3>
                <div class="row">
                    @foreach ($logos as $logo)
                        <div class="col-6">
                            <div class="bg-dark mt-3 text-white p-3 rounded-lg" >
                                <div class="row no-gutters d-flex align-items-center">
                                    <div class="col-md-4">
                                        <img src="{{url('/')}}/{{$logo}}" class="card-img">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            @php
                                                $filename = explode("/", $logo);
                                                $name = explode(".", end($filename));
                                                $name = $name[0];
                                            @endphp
                                            <h5 class="m-0">{{$name}}</h5>
                                            <form action="/dashboard/files/delete_file" method="POST">
                                                @csrf
                                                <input type="text" name="filename" value="{{$filename[1]}}" hidden>
                                                <button class="btn btn-outline-light btn-sm" type="submit" name="delete" value="logos"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>                
            </div>
            <div class="col-6 p-0 pl-5">
                <h3><i class="fas fa-signature text-danger"></i> Signatures</h3>
                <div class="row">
                    @foreach ($signs as $sign)
                        <div class="col-6">
                            <div class="bg-white mt-3 text-dark p-3 rounded-lg border border-dark">
                                <div class="row no-gutters d-flex align-items-center">
                                    <div class="col-md-4">
                                        <img src="{{url('/')}}/{{$sign}}" class="card-img">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            @php
                                                $filename = explode("/", $sign);
                                                $name = explode(".", end($filename));
                                                $name = $name[0];
                                            @endphp
                                            <h5 class="m-0">{{$name}}</h5>
                                            <form action="/dashboard/files/delete_file" method="POST">
                                                @csrf
                                                <input type="text" name="filename" value="{{$filename[1]}}" hidden>
                                                <button class="btn btn-outline-dark btn-sm" type="submit" name="delete" value="signatures"><i class="fas fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5"><i class="fas fa-font text-danger"></i> Fonts</h3>
    <div class="row">
        @foreach ($fonts as $font)
            <div class="col-2">
                <div class="bg-dark mt-3 text-white p-3 rounded-lg">
                    @php
                        $filename = explode("/", $font);
                        $name = explode(".", end($filename));
                        $name = $name[0];
                    @endphp
                    <h5 class="m-0">{{$name}}</h5>
                    <form action="/dashboard/files/delete_file" method="POST">
                        @csrf
                        <input type="text" name="filename" value="{{$filename[1]}}" hidden>
                        <button class="btn btn-outline-light btn-sm mt-3" type="submit" name="delete" value="fonts"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container-fluid mt-5 bg-dark p-4 rounded-lg">
        <h3 class="my-3 pl-1 text-white"><i class="far fa-images text-warning"></i> Certificate Designs</h3>
        <div class="row mt-4 px-4">
            @foreach($certificate_designs as $c_d)
                <div class="col-3 mt-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{url('/')}}/{{$c_d}}" class="card-img-top">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            @php
                                $name = explode("/", $c_d);
                                $name = explode(".", end($name));
                                $name = $name[0];
                            @endphp
                            <div >
                                <small class="text-muted">Design Name:</small>
                                <h4 class="text-wrap">{{$name}}</h4>
                            </div>
                            <form action="/dashboard/files/view_delete_template" method="POST">
                                @csrf
                                <input type="text" name="template_name" value="{{$name}}" hidden>
                                <button class="btn btn-dark btn-sm" type="submit" name="template_option" value="delete"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach()
        </div>
    </div>

    <h3 class="mt-5"><i class="fas fa-sliders-h text-danger"></i> Certificate Templates</h3>
    <div class="row">
        @foreach ($certificate_templates as $template)
            <div class="col-3">
                <div class="bg-dark mt-3 text-white p-3 rounded-lg">
                    @php
                        $name = explode("/", $template);
                        $name = explode(".", end($name));
                        $name = $name[0];
                    @endphp
                    <h5 class="m-0">{{$name}}</h5>
                    <form action="/dashboard/files/view_delete_template" class="mt-3" method="POST">
                        @csrf
                        <input type="text" name="template_name" value="{{$name}}" hidden>
                        <button class="btn btn-light btn-sm" name="template_option" value="view" type="submit"><i class="fas fa-eye"></i> View</button>
                        <button class="btn btn-outline-light btn-sm ml-3" type="submit" name="template_option" value="delete"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>    

@endsection()