@extends('layouts.master')
@section('title', 'Gallery')

@section('styles')
    <style>
        .thumbnailImage {
            object-fit: cover;
            object-position: center center;
            width: 100%;
            height: 200px;
            filter: brightness(50%);
        }

        .imageContainer {
            position: relative;
        }

        .middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .text {
            color: white;
            font-size: 4rem;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>All Albums
                    <a href="{{ url('admin/group/add-album') }}" class="btn btn-primary btn-sm float-end">Add Albums</a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success" id="alertMessage">{{ session('message') }}</div>
                @endif

                <div class="album py-5 bg-light">
                    <div class="container">

                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            @foreach ($albums as $index => $album)
                                <div class="col">
                                    <div class="card shadow-sm">
                                        @php
                                            $allImages = App\Models\Album::find($album->id)->images;
                                        @endphp
                                        <div class="imageContainer">
                                            <img src="{{ URL::to('/') }}/{{ $allImages[0]->path }}" class="thumbnailImage"
                                                alt="{{ $album->album_name }}">
                                            <div class="middle">
                                                @if (sizeof($allImages) > 1)
                                                    <p class="text">+{{ sizeof($allImages) - 1 }}</p>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="card-body">
                                            <h3 class="card-text">{{ $album->year }}</h3>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('albums.view', ['album_id' => $album->id]) }}"><button
                                                            type="button"
                                                            class="btn btn-sm btn-primary me-2">View</button></a>
                                                    <a href="{{ url('admin/group/edit-album/' . $album->id) }}"><button
                                                            type="button"
                                                            class="btn btn-sm btn-outline-secondary">Edit</button></a>
                                                </div>
                                                <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $album->id }}"
                                                    class="btn text-danger"><i class="fa-solid fa-trash-can"></i></a>
                                                <div class="modal fade" id="deleteModal{{ $album->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel{{ $album->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $album->id }}">Confirm
                                                                    Deletion</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this album?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <a href="{{ url('admin/group/delete-album/' . $album->id) }}"
                                                                    class="btn btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
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
