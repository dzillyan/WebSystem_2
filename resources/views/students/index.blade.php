@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-4">
    <h2 class="fw-bold text-primary">Students</h2>
    <a href="{{ route('students.create') }}" class="btn btn-success">+ Add Student</a>
</div>

{{-- Search Bar --}}
<form method="GET" action="{{ route('students.index') }}" class="mb-4 d-flex">
    <input type="text" name="search" placeholder="Search students..." 
           class="form-control me-2 shadow-sm" value="{{ request('search') }}">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

{{-- Student Listing --}}
@if($students->count())
    <div class="row">
        @foreach($students as $student)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($student->picture)
                        <img src="{{ asset('storage/'.$student->picture) }}" 
                             class="card-img-top" alt="Student Picture" 
                             style="height:200px; object-fit:cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $student->name }}</h5>
                        <p class="card-text text-muted">
                            <strong>Email:</strong> {{ $student->email }} <br>
                            <strong>Phone:</strong> {{ $student->phone }} <br>
                            <strong>Course:</strong> {{ $student->course }}
                        </p>
                        <div class="mb-3">{!! $student->qr !!}</div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">No students found.</div>
@endif
@endsection
