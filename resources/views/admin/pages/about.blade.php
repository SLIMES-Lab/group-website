@extends('layouts.master')
@section('title', 'Edit Homepage | Admin Panel')

@section('styles')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit About Page</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger" id="alertMessage">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/pages/about/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_type" value="create">
                    <div class="mb-3">
                        <label>Group's Description <span class="text-danger fw-bold">*</span></label>
                        <textarea id="detailsEditor" name="description" rows="5" class="form-control" style="resize:none;">{{ $about['description'] }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Group Photo <span class="text-danger fw-bold">*</span>&nbsp;&nbsp;[Image width should be
                            minimun 500 pixels]</label>
                        <img src="{{ URL::to('/') }}/assets/images/about/{{ $about['group_photo'] }}" id="prevHomeImg"
                            width="auto" height="200px" class="mt-1 mb-3" alt="homepage image" style="display: flex">
                        <img id="newAboutImg" src="#" alt="New Image" class="mt-1 mb-3" style="display: none;"
                            width="auto" height="200px" />
                        <input type="file" name="group_photo" class="form-control" id="aboutImgInp" />
                    </div>

                    <h6>SEO Tags</h6>
                    <div class="mb-3">
                        <label>Meta Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="seo_title" class="form-control" value="{{ $about['seo_title'] }}" />
                    </div>
                    <div class="mb-3">
                        <label>Meta Description <span class="text-danger fw-bold">*</span></label>
                        <input name="seo_description" rows="3" class="form-control" style="resize:none;"
                            value="{{ $about['seo_description'] }}" />
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/summernote-lite.min.js') }}"></script>
    <script type="text/javascript">
        const aboutImgInp = document.getElementById('aboutImgInp');
        const newAboutImg = document.getElementById('newAboutImg');
        aboutImgInp.onchange = evt => {
            const [file] = aboutImgInp.files
            if (file) {
                newAboutImg.src = URL.createObjectURL(file)
                newAboutImg.style.display = "flex"
                document.getElementById('prevAboutImg').style.display = 'none';
            }
        }
        $(document).ready(function() {
            $('#detailsEditor').summernote({
                placeholder: 'Enter Details',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'clear']],
                ],
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const alertMessage = document.getElementById('alertMessage');
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 7000);
        });
    </script>
@endsection
