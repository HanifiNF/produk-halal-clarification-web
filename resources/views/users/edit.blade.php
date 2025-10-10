@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password (leave blank to keep)</label>
            <input type="password" name="password" class="form-control">
        </div>
        @if(Auth::user()->admin)
        <div class="mb-3">
            <label class="form-label">Data Access</label>
            <div class="form-check">
                <input type="radio" name="data_access" class="form-check-input" id="data_access_yes" value="1" {{ $user->data_access ? 'checked' : '' }}>
                <label class="form-check-label" for="data_access_yes">Yes</label>
            </div>
            <div class="form-check">
                <input type="radio" name="data_access" class="form-check-input" id="data_access_no" value="0" {{ !$user->data_access ? 'checked' : '' }}>
                <label class="form-check-label" for="data_access_no">No</label>
            </div>
        </div>
        @endif
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
