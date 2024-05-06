@extends('layouts.master')
@section('title', 'Albums')
@section('styles')
    <style>
        .thumbnailImage {
            object-fit: cover;
            object-position: center center;
            width: 250px;
            height: 250px;
        }

        .imageContainer {
            position: relative;
        }
    </style>
@endsection
@section('content')
    <div class="imageContainer mx-3 my-2">
        <div class="d-flex align-items-center justify-content-between mx-3 mb-3">
            <h1 class="text-center">{{ $album->year }}</h1>
            <div class="btn-group">
                <a href="{{ url('admin/group/edit-album/' . $album->id) }}"><button type="button"
                        class="btn btn-sm btn-primary me-2">Edit Album</button></a>
                <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $album->id }}"
                    class="btn text-danger deleteLink p-0"><button type="button" class="btn btn-sm btn-danger me-2">Delete
                        Album</button></a>
                <div class="modal fade" id="deleteModal{{ $album->id }}" tabindex="-1"
                    aria-labelledby="deleteModalLabel{{ $album->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $album->id }}">Confirm
                                    Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this album?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a href="{{ url('admin/group/delete-album/' . $album->id) }}"><button type="button"
                                        class="btn btn-sm btn-danger me-2">Delete</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('admin/group/all-album/') }}"><button type="button"
                        class="btn btn-sm btn-outline-secondary">All
                        Albums</button></a>
            </div>
        </div>
        @foreach ($allImages as $index => $image)
            <img src="{{ URL::to('/') }}/{{ $image->path }}" class="thumbnailImage m-2"
                alt="{{ $album->year }}-{{ $index + 1 }}">
        @endforeach
    </div>
@endsection
