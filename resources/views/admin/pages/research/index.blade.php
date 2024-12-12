@extends('layouts.master')
@section('title', 'Add New Research Topic')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>All Research Areas
                    <a href="{{ url('admin/pages/research-areas/add-area') }}" class="btn btn-primary btn-sm float-end">Add
                        New Area</a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success" id="alertMessage">{{ session('message') }}</div>
                @endif
                <h5>Research Topics</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Cover Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $item)
                            @if ($item->item_type == 'Research Topic')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>

                                    <td>
                                        <img src="{{ asset($item->cover_photo) }}" alt="{{ $item->title }}"
                                            class="img-fluid" width="100">
                                    <td>
                                        <a href="{{ url('admin/pages/research-areas/edit-area/' . $item->id) }}"
                                            class="btn btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">
                                                        Confirm
                                                        Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this area?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <a href="{{ url('admin/pages/research-areas/delete-area/' . $item->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <h5>Software / Code / Dataset</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Cover Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $item)
                            @if ($item->item_type == 'Software / Code / Dataset')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>

                                    <td>
                                        <img src="{{ asset($item->cover_photo) }}" alt="{{ $item->title }}"
                                            class="img-fluid" width="100">
                                    <td>
                                        <a href="{{ url('admin/pages/research-areas/edit-area/' . $item->id) }}"
                                            class="btn btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">
                                                        Confirm
                                                        Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this area?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <a href="{{ url('admin/pages/research-areas/delete-area/' . $item->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endif
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
