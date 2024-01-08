@extends('layouts.master')

@section('page-title', 'Quizzes List')

@section('create-button')
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Create Quiz</a>
@endsection

@section('content')
    @if(count($quizzes) > 0)
        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <!-- Add more columns as needed -->
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->id }}</td>
                    <td>{{ $quiz->title }}</td>
                    <!-- Add more columns as needed -->
                    <td>
                        <a href="#" class="btn btn-info">View</a>
                        <a href="#" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No quizzes available.</p>
    @endif
@endsection
