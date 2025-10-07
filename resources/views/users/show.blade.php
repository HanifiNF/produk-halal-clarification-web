@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-link mt-3">Back to users</a>
</div>
@endsection
