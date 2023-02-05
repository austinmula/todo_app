@extends('layouts.app')

@section('title')
    Create Todo
@endsection

@section('content')
    <form action="/home" method="POST" enctype="multipart/form-data" class="mt-4 p-4 w-50">
        @csrf
        <div class="form-group m-3">
            <label for="name">Todo Name</label>
            <input type="text" class="form-control @error('name') is-invalid @else is-valid @enderror" name="name"/>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="form-group m-3">
            <label for="description">Todo Description</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group m-3">
            <label for="status">Todo Status</label>
            <input class="form-control" name="status" />
            @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group m-3">
            <label for="image">Todo Image</label>
            <input type="file" class="form-control" name="image" >
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group m-3">
            <input type="submit" class="btn btn-primary float-end" value="Submit">
        </div>
    </form>
@endsection

