@extends('layouts.master')
@section('title', 'Edit Vacant Position')
@section('styles')
    <link href="{{ asset('assets/css/summernote-lite.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit Vacant Position</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/group/update-position/' . $position->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="request_type" value="create">
                    <div class="mb-3">
                        <label>Project Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="title" value="{{ $position->title }}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Description <span class="text-danger fw-bold">*</span></label>
                        <textarea name="description" class="form-control editor" style="resize:none;">{!! $position->description !!}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Requirements <span class="text-danger fw-bold">*</span></label>
                        <textarea name="requirements" class="form-control editor" style="resize:none;">{!! $position->requirements !!}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Location <span class="text-danger fw-bold">*</span></label>
                            <input type="text" name="location" value="{{ $position->location }}" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Duration <span class="text-danger fw-bold">*</span></label>
                            <input type="text" name="duration" value="{{ $position->duration }}" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Start Date/Month <span class="text-danger fw-bold">*</span></label>
                            <input type="text" name="start_date" value="{{ $position->start_date }}"
                                class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Application Deadline <span class="text-danger fw-bold">*</span></label>
                            <input type="date" name="application_deadline"
                                value="{{ date('Y-m-d', strtotime($position->application_deadline)) }}"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>How To Apply <span class="text-danger fw-bold">*</span></label>
                        <textarea name="how_to_apply" class="form-control editor" style="resize:none;">{!! $position->how_to_apply !!}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Contact Information <span class="text-danger fw-bold">*</span></label>
                        <textarea id="contactInfoEditor" name="contact_information" class="form-control" style="resize:none;">{!! $position->contact_information !!}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Funding <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="funding" value="{{ $position->funding }}" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Vacant Position</button>
                        <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $position->id }}"
                            class="btn btn-danger">Delete Position</a>
                        <div class="modal fade" id="deleteModal{{ $position->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $position->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $position->id }}">Confirm
                                            Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this position?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{ url('admin/group/delete-position/' . $position->id) }}"
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
    </script>
@endsection
