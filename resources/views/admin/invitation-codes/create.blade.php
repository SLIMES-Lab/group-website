<!-- resources/views/admin/addUser.blade.php -->
@extends('layouts.master')
@section('title', 'Add User')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>Create Invitation Code</h4>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.invitation-codes.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email">User's Email (User ID)<span class="text-danger fw-bold">*</span>
                        </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
