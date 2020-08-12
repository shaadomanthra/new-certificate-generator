@extends("layouts.app")

@section("content")

    <div class="container">
        <form action="/dashboard/files/view_delete_template" method="POST" class="bg-dark text-white mt-4 p-5 rounded-lg">
            @csrf
            <h4>Do you really want to delete the Template and everything related to it</h4>
            <h6 class="text-warning">This is irreversible!!!</h6>
            <input type="text" name="template_name" value="{{$template_name}}" hidden>
            <button type="submit" class="btn btn-danger mt-3" name="template_option" value="confirm_delete">Confirm Delete</button>
        </form>
    </div>

@endsection