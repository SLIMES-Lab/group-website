@extends('layouts.frontend.master')

@section('title', 'Album: ' . $album->year)

@section('styles')
    <style>
        .thumbnailImage {
            object-fit: cover;
            object-position: center center;
            width: 300px;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
            transition: transform 0.2s ease-in-out;
        }

        .thumbnailImage:hover {
            transform: scale(1.05);
        }

        .images-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        .image-card {
            max-width: 300px;
        }

        .album-header {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('content')
    @include('frontend.components.breadcrumb', ['pagetitle' => 'Album: ' . $album->year])

    <div class="pt-60 pb-40">
        <div class="container">
            <div class="album-header pt-20 pb-20">
                <h2>{{ $album->year }}</h2>
                <p>{{ $album->description }}</p>
            </div>
            <div class="images-container">
                @php
                    $albumImages = App\Models\Album::find($album->id)->images;
                @endphp

                @foreach ($albumImages as $image)
                    <div class="image-card">
                        <img src="{{ URL::to('/') }}/{{ $image->path }}" class="thumbnailImage" alt="Album Image">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
