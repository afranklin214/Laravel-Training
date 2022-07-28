@extends('layouts.app')

@section('content')
    <form method="POST" enctype="multipart/form-data" 
        action="{{ route('users.update', ['user' => $user->id]) }}"
        class="form-horizontal">

        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-4">
                <img src="" class="img-thumbnail avatar"/>

                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload a different photo!</h6>
                        <input class="form-contol-file" type="file" name="avatar" />
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="form-group" >
                    <label>Name:</label>
                    <input class="form-control" value="" type="text" name="name"/>
                </div>
                <div class="form-group" >
                    <input type="submit" class="btn btn-primary" value="Save Changes"/>
                </div>
            </div>
        </div>

    </form>
@endsection