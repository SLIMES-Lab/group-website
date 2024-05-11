@extends('layouts.master')
@section('title', 'All Posts')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>View Post
                    <a href="{{ url('admin/add-post') }}" class="btn btn-primary btn-sm float-end">Add Post</a>
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
                            <th>Title</th>
                            <th>Published Date</th>
                            <th>Status</th>
                            <th>Categories</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->publish_date)) }}</td>
                                <td>{{ $item->is_draft == true ? 'Draft' : 'Published' }}</td>
                                <td>
                                    @foreach ($item->categories as $category)
                                        {{ $category->name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ url('admin/edit-post/' . $item->id) }}" class="btn btn-success">Edit</a>
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
                                                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Confirm
                                                    Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this post?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{ url('admin/delete-post/' . $item->id) }}"
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
