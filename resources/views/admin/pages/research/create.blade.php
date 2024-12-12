@extends('layouts.master')
@section('title', 'Add Research Area')

@section('styles')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/summernote-lite.min.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Add Research Area</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form id="postForm" action="{{ route('add-area') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_type" value="create">
                    <div class="mb-3">
                        <label>Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label>Cover Image (Min width 300 px) <span class="text-danger fw-bold">*</span></label>
                        <img id="newImg" src="#" alt="New Image" class="mt-1 mb-3" style="display: none;"
                            width="auto" height="200px" />
                        <input type="file" name="cover_photo" class="form-control" id="imgInp" />
                    </div>

                    <div class="mb-3">
                        <label>Description <span class="text-danger fw-bold">*</span></label>
                        <textarea id="postEditor" name="description" rows="7" class="form-control" style="resize:none;"></textarea>
                    </div>

                    <div class="mb-3 d-flex flex-column">
                        <label>Type <span class="text-danger fw-bold">*</span></label>
                        <select class="types form-control" name="item_type">
                            <option selected vlaue="research">Research Topic</option>
                            <option vlaue="software">Software / Code / Dataset</option>
                        </select>
                    </div>

                    <h6>SEO Tags</h6>
                    <div class="mb-3">
                        <label>Meta Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="meta_title" class="form-control" id="meta_title" />
                    </div>
                    <div class="mb-3">
                        <label>Meta Description</label>
                        <input type="text" name="meta_description" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Create</button>
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
        const newImg = document.getElementById('newImg');
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                newImg.src = URL.createObjectURL(file)
                newImg.style.display = "flex"
            }
        }
        $(document).ready(function() {
            $('.types').select2({});
        })

        $(document).ready(function() {
            $('#postEditor').summernote({
                placeholder: 'Write your post here...',
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

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('postForm');

            form.addEventListener('submit', function(event) {
                const clickedButton = document.querySelector('button[type="submit"]:focus');
                if (clickedButton) {
                    const action = clickedButton.value;
                    form.setAttribute('action', form.getAttribute('action') + '?action=' + action);
                }
            });
        });

        var metaTitleChanged = false;
        var metaDescriptionChanged = false;

        document.getElementById('title').addEventListener('input', function() {
            if (!metaTitleChanged) {
                document.getElementById('meta_title').value = this.value;
            }
        });
        document.getElementById('meta_title').addEventListener('input', function() {
            metaTitleChanged = true;
        });
    </script>
@endsection
