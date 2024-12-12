@extends('layouts.frontend.master')
@section('title', 'Albums')

@section('styles')
    <style>
        .thumbnailImage {
            object-fit: cover;
            object-position: center center;
            width: 300px;
            height: 200px;
            filter: brightness(50%);
            border-radius: 10px 10px 0 0;
        }

        .imageContainer {
            position: relative;
        }

        .middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .text {
            color: white;
            font-size: 4rem;
            font-weight: 600;
        }

        .album-card {
            max-width: 300px;
            margin: 15px auto;
            border-radius: 10px;
            box-shadow: black 0px 0px 10px;
        }

        .albums-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
    </style>
@endsection

@section('content')
    @include('frontend.components.breadcrumb', ['pagetitle' => 'Albums'])

    <div class="pt-60 pb-40">
        <div class="container-fluid px-4">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="album py-5 bg-light">
                        <div class="container">
                            <div class="albums-container">
                                @foreach ($albums as $index => $album)
                                    <div class="card album-card">
                                        @php
                                            $allImages = App\Models\Album::find($album->id)->images;
                                        @endphp
                                        <a href="/album/{{ $album->id }}">
                                            <div class="imageContainer">

                                                <img src="{{ URL::to('/') }}/{{ $allImages[0]->path }}"
                                                    class="thumbnailImage" alt="{{ $album->album_name }}">
                                                <div class="middle">
                                                    @if (sizeof($allImages) > 1)
                                                        <p class="text">+{{ sizeof($allImages) - 1 }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-body mt-10">
                                                <h3 class="card-text text-center">{{ $album->year }}</h3>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
