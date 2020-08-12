@extends("layouts.app")

@section("content")

    <div class="container">
        <form action="{{$verification_id}}" method="POST" class="bg-dark text-white mt-4 p-5 rounded-lg">
            @csrf
            <h4>Do you really want to delete the record?</h4>
            <h6 class="text-warning">This is irreversible!!!</h6>
            <button type="submit" class="btn btn-danger mt-3" name="delete_option" value="confirm_delete">Confirm Delete</button>
        </form>
    </div>

@endsection