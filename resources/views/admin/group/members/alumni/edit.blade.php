@extends('layouts.master')
@section('title', 'Edit Alumni')
@section('styles')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit Alumni</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/group/members/update-alumni/' . $alumni->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Name <span class="text-danger fw-bold">*</span></label>
                        <input type="text" disabled name="name" value="{{ $alumni->name }}" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label>Project Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="title" value="{{ $alumni->title }}" class="form-control" />
                    </div>

                    <div class="mb-3 d-flex flex-column">
                        <label>Course <span class="text-danger fw-bold">*</span></label>
                        <select class="types form-control" name="type">
                            <option value="bachelors" {{ $alumni->type == 'bachelors' ? 'selected' : '' }}>Bachelor's
                            </option>
                            <option value="masters" {{ $alumni->type == 'masters' ? 'selected' : '' }}>Masters</option>
                            <option value="phd" {{ $alumni->type == 'phd' ? 'selected' : '' }}>PhD</option>
                            <option value="postdoc" {{ $alumni->type == 'postdoc' ? 'selected' : '' }}>Post Doc</option>
                            <option value="pi" {{ $alumni->type == 'pi' ? 'selected' : '' }}>Principal Investigator
                            </option>
                        </select>
                    </div>

                    <div class="mb-3 d-flex flex-column" style="width: fit-content">
                        <label>Avatar (Min width 100 px, ratio 1:1)</label>
                        @php
                            $imagePath = $alumni->image;
                            if ($imagePath) {
                                if (substr($imagePath, 0, 1) === '/') {
                                    $imagePath = substr($imagePath, 1);
                                }
                            }
                        @endphp
                        @if ($imagePath)
                            <img src="{{ URL::to('/') }}/{{ $imagePath }}" class="mt-1 mb-3"
                                alt="{{ $alumni->name }} Avatar" id="previousImg" width="150px" height="150px">
                        @else
                            <img src="{{ URL::to('/') }}/assets/images/avatar-default.png" alt="Default Image"
                                id="previousImg" width="150px" height="150px" class="mt-1 mb-3">
                        @endif
                        <img id="newImg" src="#" alt="New Image" class="mt-1 mb-3" style="display: none;"
                            width="150px" height="150px" />
                        <input type="file" name="image" class="form-control" id="imgInp" />
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Login Email</label>
                            <input type="email" disabled name="email" value="{{ $alumni->email }}"
                                class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Profile Email</label>
                            <input type="email" name="profile_email" value="{{ $alumni->profile_email }}"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Google Scholar Link</label>
                            <input type="text" name="google_scholar" value="{{ $alumni->google_scholar }}"
                                class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Website</label>
                            <input type="text" name="website" value="{{ $alumni->website }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Current Position</label>
                        <input type="text" name="current_position" value="{{ $alumni->current_position }}"
                            class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Member</button>
                        <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $alumni->id }}"
                            class="btn btn-danger">Delete Member</a>
                        <div class="modal fade" id="deleteModal{{ $alumni->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $alumni->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $alumni->id }}">Confirm
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
                                        <a href="{{ url('admin/group/members/delete-alumni/' . $alumni->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        const imgInp = document.getElementById('imgInp');
        const previousImg = document.getElementById('previousImg');
        const newImg = document.getElementById('newImg');
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                previousImg.style.display = "none";
                newImg.src = URL.createObjectURL(file)
                newImg.style.display = "flex"
            }
        }
        $(document).ready(function() {
            $('.types').select2({});
        })
    </script>
@endsection
