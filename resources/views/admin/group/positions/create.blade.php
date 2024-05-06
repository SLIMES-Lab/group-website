@extends('layouts.master')
@section('title', 'Add Vacant Position')

@section('styles')
    <link href="{{ asset('assets/css/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Add Vacant Position</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form id="postForm" action="{{ route('add-position') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_type" value="create">
                    <div class="mb-3">
                        <label>Project Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="title" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Description <span class="text-danger fw-bold">*</span></label>
                        <textarea name="description" class="form-control editor" style="resize:none;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Requirements <span class="text-danger fw-bold">*</span></label>
                        <textarea name="requirements" class="form-control editor" style="resize:none;"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Location <span class="text-danger fw-bold">*</span></label>
                            <input type="text" name="location" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Duration <span class="text-danger fw-bold">*</span></label>
                            <input type="text" name="duration" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Start Date/Month <span class="text-danger fw-bold">*</span></label>
                            <input type="text" name="start_date" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Application Deadline <span class="text-danger fw-bold">*</span></label>
                            <input type="date" name="application_deadline" class="form-control" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>How To Apply <span class="text-danger fw-bold">*</span></label>
                        <textarea name="how_to_apply" class="form-control editor" style="resize:none;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Contact Information <span class="text-danger fw-bold">*</span></label>
                        <textarea id="contactInfoEditor" name="contact_information" class="form-control" style="resize:none;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Funding <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="funding" class="form-control" />
                    </div>

                    <button type="submit" name="action" class="btn btn-primary">Create Vacant
                        Position</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/summernote-lite.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.editor').summernote({
                placeholder: 'Write here...',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                ],
            });
            $('#contactInfoEditor').summernote({
                placeholder: 'Write here...',
                tabsize: 2,
                height: 100,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
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
    </script>
@endsection
