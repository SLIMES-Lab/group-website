@extends('layouts.master')
@section('title', 'All Alumni')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>All Alumni
                    <a href="{{ url('admin/group/members/add-alumni') }}" class="btn btn-primary btn-sm float-end">Add
                        Alumni</a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success" id="alertMessage">{{ session('message') }}</div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumni as $member)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $member->name }}</td>
                                <td>
                                    @if ($member->image)
                                        <img src="{{ URL::to('/') }}/{{ $member->image }}" class="mt-1 mb-3"
                                            alt="{{ $member->name }} Avatar" style="height: 50px; width: auto">
                                    @else
                                        <img src="{{ URL::to('/') }}/assets/images/avatar-default.png" alt="Default Image"
                                            style="height: 50px; width: auto">
                                    @endif
                                </td>
                                <td>{{ $member->title }}</td>
                                <td>
                                    <a href="{{ url('admin/group/members/edit-alumni/' . $member->id) }}"
                                        class="btn btn-success">Edit</a>
                                </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $member->id }}"
                                        class="btn btn-danger">Delete</a>
                                </td>
                                <div class="modal fade" id="deleteModal{{ $member->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $member->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $member->id }}">Confirm
                                                    Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this alumni member?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{ url('admin/group/members/delete-alumni/' . $member->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Wait for the document to be ready
        document.addEventListener("DOMContentLoaded", function() {
            // Get the alert element by its ID
            const alertMessage = document.getElementById('alertMessage');

            // Set a timeout to hide the alert after 5 seconds (adjust the time as needed)
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 2500); // 5000 milliseconds = 5 seconds
        });
    </script>
@endsection
