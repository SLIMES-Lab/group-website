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
                <h4 class="">Edit Homepage</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger" id="alertMessage">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/pages/home/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_type" value="create">
                    <div class="mb-3">
                        <label>Heading <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="heading" class="form-control" value="{{ $home['heading'] }}" />
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label>Topics <span class="text-danger fw-bold">*</span>&nbsp;&nbsp;[Use comma (",") to
                            separate]</label>
                        <select class="topics form-control" name="topics[]" multiple="multiple">
                            @foreach ($home['topics'] as $topic)
                                <option vlaue="{{ $topic }}">{{ $topic }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Subheading <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="subheading" class="form-control" value="{{ $home['subheading'] }}" />
                    </div>
                    <div class="mb-3">
                        <label>Hero Image <span class="text-danger fw-bold">*</span>&nbsp;&nbsp;[Image resolution should be
                            minimun 1920*1080]</label>
                        <img src="{{ URL::to('/') }}/assets/images/home/{{ $home['homepage_image'] }}" id="prevHomeImg"
                            width="auto" height="200px" class="mt-1 mb-3" alt="homepage image" style="display: flex">
                        <img id="newHomeImg" src="#" alt="New Image" class="mt-1 mb-3" style="display: none;"
                            width="auto" height="200px" />
                        <input type="file" name="homepage_image" class="form-control" id="homeImgInp" />

                    </div>

                    <div class="mb-3">
                        <label>Total No. of Papers <span class="text-danger fw-bold">*</span></label>
                        <input type="number" name="papers" class="form-control" value="{{ $home['papers'] }}" />
                    </div>

                    <div class="mb-3">
                        <label>Total No. of Citations <span class="text-danger fw-bold">*</span></label>
                        <input type="number" name="citations" class="form-control" value="{{ $home['citations'] }}" />
                    </div>
                    <div class="mb-3">
                        <label>Total No. of Group Members <span class="text-danger fw-bold">*</span></label>
                        <input type="number" name="group_members" class="form-control"
                            value="{{ $home['group_members'] }}" />
                    </div>

                    <div class="mb-3">
                        <label>John's Image <span class="text-danger fw-bold">*</span>&nbsp;&nbsp;[Image should be 1:1 & the
                            resolution should be minimun 500*500]</label>
                        <img src="{{ URL::to('/') }}/assets/images/home/{{ $home['john_image'] }}" id="prevJohnImg"
                            width="200px" height="200px" class="mt-1 mb-3" alt="John Image" style="display: flex">
                        <img id="newJohnImg" src="#" alt="New Image" class="mt-1 mb-3" style="display: none;"
                            width="200px" height="200px" />
                        <input type="file" name="john_image" class="form-control" id="johnImgInp" />
                    </div>
                    <div class="mb-3">
                        <label>John's Details <span class="text-danger fw-bold">*</span></label>
                        <textarea id="detailsEditor" name="john_details" rows="5" class="form-control" style="resize:none;">{{ $home['john_details'] }}</textarea>
                    </div>

                    <h6>SEO Tags</h6>
                    <div class="mb-3">
                        <label>Meta Title <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="seo_title" class="form-control" value="{{ $home['seo_title'] }}" />
                    </div>
                    <div class="mb-3">
                        <label>Meta Description <span class="text-danger fw-bold">*</span></label>
                        <input name="seo_description" rows="3" class="form-control" style="resize:none;"
                            value="{{ $home['seo_description'] }}" />
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Save Project</button>
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
        const johnImgInp = document.getElementById('johnImgInp');
        const newJohnImg = document.getElementById('newJohnImg');
        const homeImgInp = document.getElementById('homeImgInp');
        const newHomeImg = document.getElementById('newHomeImg');
        johnImgInp.onchange = evt => {
            const [file] = johnImgInp.files
            if (file) {
                newJohnImg.src = URL.createObjectURL(file)
                newJohnImg.style.display = "flex"
                document.getElementById('prevJohnImg').style.display = 'none';
            }
        }
        homeImgInp.onchange = evt => {
            const [file] = homeImgInp.files
            if (file) {
                newHomeImg.src = URL.createObjectURL(file)
                newHomeImg.style.display = "flex"
                document.getElementById('prevHomeImg').style.display = 'none';
            }
        }
        $(document).ready(function() {
            $('.topics').select2({
                placeholder: "Use ',' to separate topics",
                tags: true,
                tokenSeparators: [',']
            });
            data = [];
            data = <?php echo json_encode($home['topics']); ?>;
            $('.topics').val(data);
            $('.topics').trigger('change');
        });
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
