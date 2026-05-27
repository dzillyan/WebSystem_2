@extends('layouts.app')

@section('content')
<h2>Edit Student</h2>

<form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
    </div>
    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ $student->phone }}" required>
    </div>
    <div class="mb-3">
        <label>Course</label>
        <input type="text" name="course" class="form-control" value="{{ $student->course }}" required>
    </div>
    <div class="mb-3">
        <label>Picture</label><br>
        @if($student->picture)
            <img src="{{ asset('storage/'.$student->picture) }}" width="120" class="mb-2">
        @endif
        <input type="file" name="picture" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
