@extends('layouts.master')
@section('title', 'Add Post')

@section('styles')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/summernote-lite.min.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Add Post</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <script>
                    let identifier = (Math.random().toString(36).substring(2, 10) + Math.random().toString(36).substring(2, 10))
                        .substring(0, 15);
                </script>
                <form id="postForm" action="{{ route('add-post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_type" value="create">
                    <div class="mb-3">
                        <label>Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>SubTitle <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="subtitle" class="form-control" id="subheading" />
                    </div>

                    <div class="mb-3">
                        <label>Cover Image (Min width 300 px) <span class="text-danger fw-bold">*</span></label>
                        <img id="newImg" src="#" alt="New Image" class="mt-1 mb-3" style="display: none;"
                            width="auto" height="200px" />
                        <input type="file" name="image" class="form-control" id="imgInp" />
                    </div>

                    <div class="mb-3">
                        <label>Description <span class="text-danger fw-bold">*</span></label>
                        <textarea id="postEditor" name="description" rows="7" class="form-control" style="resize:none;"></textarea>
                    </div>

                    <div class="mb-3 d-flex flex-column">
                        <label>Categories/Tags (Max: 5) <span class="text-danger fw-bold">*</span></label>
                        <select class="categories form-control" name="tags[]" multiple="multiple">
                            @foreach ($categories as $item)
                                <option vlaue="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <h6>SEO Tags</h6>
                    <div class="mb-3">
                        <label>Meta Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="meta_title" class="form-control" id="meta_title" />
                    </div>
                    <div class="mb-3">
                        <label>Meta Description <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="meta_description" class="form-control" id="meta_description" />
                    </div>

                    <div class="mb-3 col-2" data-provide="datepicker">
                        <label>Publish Date <span class="text-danger fw-bold">*</span></label>
                        <input type="date" class="form-control" name="publish_date">
                    </div>
                    <div class="mb-3 col-2">
                        <input type="checkbox" id="anonymous" name="anonymous" value="1">
                        <label for="anonymous">Post as Anonymous</label>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" name="action" value="publish" class="btn btn-primary">Publish Post</button>
                        <button type="submit" name="action" value="save_draft" class="btn btn-secondary ms-2">Save
                            Draft</button>
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
            $('.categories').select2({
                maximumSelectionLength: 5,
                placeholder: "Use comma (\",\") to separate categories",
                tags: true,
                tokenSeparators: [',']
            });
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
                    ['insert', ['link', 'picture', 'video']],
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

        document.getElementById('subheading').addEventListener('input', function() {
            if (!metaDescriptionChanged) {
                document.getElementById('meta_description').value = this.value;
            }
        });
        document.getElementById('meta_description').addEventListener('input', function() {
            metaDescriptionChanged = true;
        });
    </script>
@endsection
