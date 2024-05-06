@extends('layouts.master')
@section('title', 'Gallery')
@section('styles')
    <style>
        output {
            width: 100%;
            min-height: 150px;
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 15px;
            position: relative;
            border-radius: 5px;
        }

        output .image {
            height: 180px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
        }

        output .image img {
            height: 100%;
            width: 100%;
        }

        .prevImages {
            width: auto !important;
        }

        output .image span {
            position: absolute;
            top: 4px;
            right: 4px;
            cursor: pointer;
            font-size: 22px;
            color: black;
            padding: 0 8px;
            border-radius: 2px;
            background: white;
        }

        .deleteLink {
            position: absolute;
            top: 4px;
            right: 4px;
            cursor: pointer;
            font-size: 20px;
            padding: 5px 10px;
            background: white;
            border: red;
        }

        .deleteLink:hover {
            background: rgb(255, 82, 82);
            color: white !important;
        }

        output .image span:hover {
            background: black;
            color: white;
        }

        output .span--hidden {
            visibility: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit Album</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger" id="alertMessage">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/group/update-album/' . $album->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Year <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="year" value="{{ $album->year }}" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label id="prevImageLevel">Album's Images</label>
                        <output id="prevOutput">
                            @foreach ($allImages as $index => $image)
                                <div class="image">
                                    <img src="{{ URL::to('/') }}/{{ $image->path }}"
                                        alt="{{ $album->year }}-{{ $index + 1 }}" class="prevImages">
                                    <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $image->id }}"
                                        class="btn text-danger deleteLink"><i class="fa-solid fa-trash-can"></i></a>
                                    <div class="modal fade" id="deleteModal{{ $image->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $image->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $image->id }}">
                                                        Confirm
                                                        Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this image?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <a onclick="deletePrevImg({{ $index }}, {{ $image->id }})"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </output>
                    </div>
                    <div class="mb-3">
                        <label>Add New Image(s) <span class="text-danger fw-bold">*</span></label>
                        <input type="file" class="form-control mb-3" name="images[]" multiple="multiple"
                            id="newImageInput" />
                        <output style="display:none;" id="newOutput"></output>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Album</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const newOutput = document.getElementById("newOutput")
        const prevOutput = document.getElementById("prevOutput")
        const newImageInput = document.getElementById("newImageInput")
        const prevImages = document.getElementsByClassName("prevImages")
        var base_url = window.location.origin + '/';
        let newImagesArray = []

        function deleteImage(index) {
            const dt = new DataTransfer()
            const newImageInput = document.getElementById("newImageInput")
            const {
                files
            } = newImageInput
            for (let i = 0; i < files.length; i++) {
                const file = files[i]
                if (index !== i) {
                    dt.items.add(file)
                }
            }
            newImageInput.files = dt.files
            newImagesArray.splice(index, 1)
            displayImages()
        }

        function displayImages() {
            let images = ""
            newImagesArray.forEach((image, index) => {
                images += `<div class="image">
                        <img src="${URL.createObjectURL(image)}" alt="image">
                        <span onclick="deleteImage(${index})">&times;</span>
                        </div>`
            })
            newOutput.innerHTML = images
        }

        newImageInput.addEventListener("change", () => {
            newOutput.style.display = "flex"
            const files = newImageInput.files
            newImagesArray = []
            for (let i = 0; i < files.length; i++) {
                newImagesArray.push(files[i])
            }
            displayImages()
        })

        function deletePrevImg(index, imageId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: base_url + 'admin/group/delete-single-image/' + imageId,
                data: {
                    image_id: imageId
                },
                success: function(response) {
                    if (response.success) {
                        $('#deleteModal' + imageId).modal('hide');
                        prevImages[index].style.display = 'none';
                    } else {
                        alert("Deletion failed!");
                    }
                }
            });
        }
    </script>
@endsection
