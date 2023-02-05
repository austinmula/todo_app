@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/create" class="mb-4 btn btn-primary">Create New Todo</a>
    <div class="row justify-content-center">
        <div class="row d-flex">
            @foreach ($todos as $todo)
                <div class="card col-md-4 gap-2 p-3">
                    <div class="flex flex-column  ">
                        <div>
                            <div class="image-container my-3">
                                <img src="images/{{$todo->image}}" width="100%" height="100%" class="rounded-circle"/>
                            </div>
                        </div>
                        <div>
                            <h3> {{ $todo->name }}</h3>
                            <p> {{ $todo->description }}</p>
                            <small class="badge bg-danger w-25">{{$todo -> status}}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
