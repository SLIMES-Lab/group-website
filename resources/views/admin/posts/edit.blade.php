@extends('layouts.master')
@section('title', 'Edit Post')
@section('styles')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit Post</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/update-post/' . $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="title" value="{{ $post->title }}" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label>SubTitle <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="subtitle" value="{{ $post->subtitle }}" class="form-control" />
                    </div>

                    <div class="mb-3 d-flex flex-column" style="width: fit-content">
                        <label>Cover Image</label>
                        <img src="{{ URL::to('/') }}/{{ $post->image }}" id="previousImg" width="auto" height="200px"
                            class="mt-1 mb-3" alt="{{ $post->name }}">
                        <img id="newImg" src="#" alt="New Image" class="mt-1 mb-3" style="display: none;"
                            width="auto" height="200px" />
                        <input type="file" name="image" class="form-control" id="imgInp" />
                    </div>

                    <div class="mb-3">
                        <label>Description <span class="text-danger fw-bold">*</span></label>
                        <textarea name="description" id="postEditor" rows="5" class="form-control" style="resize:none;">{{ $post->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Categories (Max: 5) <span class="text-danger fw-bold">*</span></label>
                        <select class="categories form-control" name="tags[]" multiple="multiple">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}"
                                    {{ in_array($item->id, $selected_post_ids) ? 'selected' : '' }}>{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <h6>SEO Tags</h6>
                    <div class="mb-3">
                        <label>meta title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="meta_title" value="{{ $post->meta_title }}" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label>meta description <span class="text-danger fw-bold">*</span></label>
                        <textarea name="meta_description" rows="5" class="form-control" style="resize:none;">{{ $post->meta_description }}</textarea>
                    </div>

                    <div class="mb-3 col-2" data-provide="datepicker">
                        <label>Publish Date <span class="text-danger fw-bold">*</span></label>
                        <input type="date" class="form-control" publish-date="{{ $post->publish_date }}"
                            name="publish_date" value="{{ date('Y-m-d', strtotime($post->publish_date)) }}">
                    </div>
                    <div class="mb-3 col-2">
                        <input type="checkbox" name="anonymous" {{ $post->user_id === null ? 'checked' : '' }} />
                        <label for="anonymous">Post as Anonymous</label>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Post</button>
                        <button type="submit" name="action" value="save_draft" class="btn btn-secondary">Mark As
                            Draft</button>
                        <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}"
                            class="btn btn-danger">Delete Post</a>
                        <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">Confirm
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
                                        <a href="{{ url('admin/delete-post/' . $post->id) }}"
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

@php
    $category_ids = [];
@endphp
@foreach ($post->categories as $category)
    @php
        array_push($category_ids, $category->id);
    @endphp
@endforeach

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
        $(document).ready(function() {
            $('.categories').select2({
                maximumSelectionLength: 5,
                placeholder: "Use comma (\",\") to separate categories",
                tags: true,
                tokenSeparators: [',']
            });
            data = [];
            data = <?php echo json_encode($category_ids); ?>;
            $('.categories').val(data);
            $('.categories').trigger('change');
        })

        $('.flatpickr-input').val('2022-02-06')
    </script>
@endsection
