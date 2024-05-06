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
            height: 150px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
        }

        output .image img {
            height: 100%;
            width: 100%;
        }

        output .image span {
            position: absolute;
            top: -4px;
            right: 4px;
            cursor: pointer;
            font-size: 22px;
            color: white;
        }

        output .image span:hover {
            opacity: 0.8;
        }

        output .span--hidden {
            visibility: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <input type="hidden" name="request_type" value="create">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Add Album</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger" id="alertMessage">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/group/add-album') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_type" value="create">
                    <div class="mb-3">
                        <label>Album Year <span class="text-danger fw-bold">*</span></label>
                        <input type="text" name="year" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label>Add Image(s) <span class="text-danger fw-bold">*</span></label>
                        <input type="file" class="form-control mb-3" name="images[]" multiple="multiple"
                            id="imgInp" />
                        <output style="display: none;"></output>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Save Album</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const output = document.querySelector("output")
        const input = document.getElementById("imgInp")
        let imagesArray = []
        document.addEventListener("DOMContentLoaded", function() {
            const alertMessage = document.getElementById('alertMessage');
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 7000); // 5000 milliseconds = 5 seconds
        });

        function deleteImage(index) {
            const dt = new DataTransfer()
            const inputNew = document.getElementById("imgInp")
            const {
                files
            } = inputNew
            for (let i = 0; i < files.length; i++) {
                const file = files[i]
                if (index !== i) {
                    dt.items.add(file)
                }
            }
            inputNew.files = dt.files
            imagesArray.splice(index, 1)
            displayImages()
        }

        function displayImages() {
            let images = ""
            output.style.display = 'flex';
            imagesArray.forEach((image, index) => {
                images += `<div class="image">
                                            <img src="${URL.createObjectURL(image)}" alt="image">
                                            <span onclick="deleteImage(${index})">&times;</span>
                                        </div>`
            })
            output.innerHTML = images
        }

        input.addEventListener("change", () => {

            const files = input.files
            imagesArray = []
            for (let i = 0; i < files.length; i++) {
                imagesArray.push(files[i])
            }
            displayImages()
        })
    </script>
@endsection
