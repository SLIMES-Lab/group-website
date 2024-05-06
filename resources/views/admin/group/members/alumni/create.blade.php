@extends('layouts.master')
@section('title', 'Add Member')

@section('styles')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/summernote-lite.min.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Add Alumni Member</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form id="postForm" action="{{ route('add-alumni') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_type" value="create">
                    <div class="mb-3">
                        <label>Name <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Project Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="title" class="form-control" />
                    </div>

                    <div class="mb-3 d-flex flex-column">
                        <label>Course <span class="text-danger fw-bold">*</span></label>
                        <select class="types form-control" name="type">
                            <option selected vlaue="bachelors">Bachelor's</option>
                            <option vlaue="masters">Masters</option>
                            <option vlaue="phd">PhD</option>
                            <option vlaue="postdoc">Post Doc</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Avatar (Min width 100 px, ratio 1:1) </label>
                        <img id="newImg" src="#" alt="New Image" class="mt-1 mb-3" style="display: none;"
                            width="auto" height="200px" />
                        <input type="file" name="image" class="form-control" id="imgInp" />
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Google Scholar Link</label>
                            <input type="text" name="google_scholar" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Website</label>
                            <input type="text" name="website" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Current Position</label>
                        <input type="text" name="current_position" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="action" class="btn btn-primary">Save Member</button>
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
    </script>
@endsection
