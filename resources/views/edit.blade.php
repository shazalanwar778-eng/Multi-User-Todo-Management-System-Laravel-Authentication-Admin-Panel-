@extends('layouts.app')
@section('title')
    Edit Todo
@endsection
@section('content')

     <<form action="/update/{{ $todo->id }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ $todo->name }}" class="form-control">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $todo->description }}</textarea>
    </div>
    <input type="submit" value="Update" class="btn btn-primary mt-2">
</form>

@endsection