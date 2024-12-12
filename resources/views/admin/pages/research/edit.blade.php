@extends('layouts.master')
@section('title', 'Edit Research Topic')
@section('styles')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit Research Topic</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/pages/research-areas/update-area/' . $area->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="title" value="{{ $area->title }}" class="form-control" />
                    </div>

                    <div class="mb-3 d-flex flex-column" style="width: fit-content">
                        <label>Cover Image</label>
                        <img src="{{ URL::to('/') }}/{{ $area->cover_photo }}" id="previousImg" width="auto"
                            height="200px" class="mt-1 mb-3" alt="{{ $area->name }}">
                        <img id="newImg" src="#" alt="New Image" class="mt-1 mb-3" style="display: none;"
                            width="auto" height="200px" />
                        <input type="file" name="cover_photo" class="form-control" id="imgInp" />
                    </div>

                    <div class="mb-3">
                        <label>Description <span class="text-danger fw-bold">*</span></label>
                        <textarea name="description" id="areaEditor" rows="5" class="form-control" style="resize:none;">{{ $area->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Type <span class="text-danger fw-bold">*</span></label>
                        <select class="categories form-control" name="item_type">
                            <option value="Research Topic" {{ $area->item_type == 'Research Topic' ? 'selected' : '' }}>
                                Research Topic</option>
                            <option value="Software / Code / Dataset"
                                {{ $area->item_type == 'Software / Code / Dataset' ? 'selected' : '' }}>Software / Code /
                                Dataset
                            </option>
                        </select>
                    </div>

                    <h6>SEO Tags</h6>
                    <div class="mb-3">
                        <label>Meta Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="meta_title" value="{{ $area->meta_title }}" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label>Meta Description </label>
                        <textarea name="meta_description" rows="5" class="form-control" style="resize:none;">{{ $area->meta_description }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Post</button>
                        <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $area->id }}"
                            class="btn btn-danger">Delete Post</a>
                        <div class="modal fade" id="deleteModal{{ $area->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $area->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $area->id }}">Confirm
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
                                        <a href="{{ url('admin/pages/research-areas/delete-area/' . $area->id) }}"
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
    <script src="{{ asset('assets/js/summernote-lite.min.js') }}"></script>
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
            $('#areaEditor').summernote({
                placeholder: 'Write your area here...',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                ],
            });
        });
        $(document).ready(function() {
            $('.categories').select2({});
        })
    </script>
@endsection
