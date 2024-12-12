@extends('layouts.frontend.master')
@section('title', 'Group Member')

@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'Group Member'])

    <div class="basic-blog-area pt-90 pb-20">
        <div class="container">
            <div class="row blog-masonry single-member-div">
                <div class="col-12">
                    @php
                        $hasBiography = !empty($member->biography);
                        $hasAdditionalLinks =
                            !empty($member->website) ||
                            !empty($member->google_scholar) ||
                            !empty($member->linkedin) ||
                            !empty($member->github) ||
                            !empty($member->researchgate) ||
                            !empty($member->twitter);
                    @endphp

                    <div class="{{ $hasBiography ? 'd-flex' : 'text-center' }}">
                        <div class="{{ $hasBiography ? 'col-md-4 text-center' : 'mb-3' }}">
                            <div class="single-member-image mb-3">
                                @if ($member->photo)
                                    <img src="{{ URL::to('/') }}{{ $member->photo }}" alt="{{ $member->name }}"
                                        class="img-fluid {{ $hasBiography ? '' : 'mx-auto' }}"
                                        style="{{ $hasBiography ? '' : 'max-width: 300px;' }}">
                                @elseif ($member->image)
                                    <img src="{{ URL::to('/') }}/{{ $member->image }}" alt="{{ $member->name }}"
                                        class="img-fluid {{ $hasBiography ? '' : 'mx-auto' }}"
                                        style="{{ $hasBiography ? '' : 'max-width: 300px;' }}">
                                @else
                                    <img src="{{ URL::to('/') }}/assets/images/avatar-default.png" alt="Default Image"
                                        class="img-fluid {{ $hasBiography ? '' : 'mx-auto' }}"
                                        style="{{ $hasBiography ? '' : 'max-width: 300px;' }}">
                                @endif
                            </div>
                            <h2 class="single-post-title">{{ $member->name }}</h2>

                            @if ($hasAdditionalLinks && !$hasBiography)
                                <div class="additional-links mt-3 d-flex justify-content-center">
                                    @if (!empty($member->website))
                                        <a href="{{ $member->website }}" class="mx-5 mp-5" target="_blank">
                                            <i class="fas fa-globe fa-lg"></i>
                                        </a>
                                    @endif
                                    @if (!empty($member->google_scholar))
                                        <a href="{{ $member->google_scholar }}" class="mx-5 mp-5" target="_blank">
                                            <i class="ai ai-google-scholar ai-lg"></i>
                                        </a>
                                    @endif
                                    @if (!empty($member->linkedin))
                                        <a href="{{ $member->linkedin }}" class="mx-5 mp-5" target="_blank">
                                            <i class="fab fa-linkedin fa-lg"></i>
                                        </a>
                                    @endif
                                    @if (!empty($member->researchgate))
                                        <a href="{{ $member->researchgate }}" class="mx-5 mp-5" target="_blank">
                                            <i class="fab fa-researchgate fa-lg"></i>
                                        </a>
                                    @endif
                                    @if (!empty($member->github))
                                        <a href="{{ $member->github }}" class="mx-5 mp-5" target="_blank">
                                            <i class="fab fa-github fa-lg"></i>
                                        </a>
                                    @endif
                                    @if (!empty($member->twitter))
                                        <a href="{{ $member->twitter }}" class="mx-5 mp-5" target="_blank">
                                            <i class="fab fa-twitter fa-lg"></i>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>

                        @if ($hasBiography)
                            <div class="col-md-8">
                                <div class="post-content">
                                    <p>{!! $member->biography !!}</p>

                                    @if ($hasAdditionalLinks)
                                        <div class="additional-links mt-3 d-flex">
                                            @if (!empty($member->website))
                                                <a href="{{ $member->website }}" class="mx-5 mp-5" target="_blank">
                                                    <i class="fas fa-globe fa-lg"></i>
                                                </a>
                                            @endif
                                            @if (!empty($member->linkedin))
                                                <a href="{{ $member->linkedin }}" class="mx-5 mp-5" target="_blank">
                                                    <i class="fab fa-linkedin fa-lg"></i>
                                                </a>
                                            @endif
                                            @if (!empty($member->google_scholar))
                                                <a href="{{ $member->google_scholar }}" class="mx-5 mp-5" target="_blank">
                                                    <i class="ai ai-google-scholar ai-lg"></i>
                                                </a>
                                            @endif
                                            @if (!empty($member->researchgate))
                                                <a href="{{ $member->researchgate }}" class="mx-5 mp-5" target="_blank">
                                                    <i class="fab fa-researchgate fa-lg"></i>
                                                </a>
                                            @endif
                                            @if (!empty($member->github))
                                                <a href="{{ $member->github }}" class="mx-5 mp-5" target="_blank">
                                                    <i class="fab fa-github fa-lg"></i>
                                                </a>
                                            @endif
                                            @if (!empty($member->twitter))
                                                <a href="{{ $member->twitter }}" class="mx-5 mp-5" target="_blank">
                                                    <i class="fab fa-twitter fa-lg"></i>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-50">
            <div class="row">
                <div class="col-12 text-center">
                    <a href="{{ URL::previous() }}" class="btn btn-primary" style="color: white;"
                        onmouseover="this.style.color='black'" onmouseout="this.style.color='white'">Back</a>
                </div>
            </div>
        </div>

    @endsection
