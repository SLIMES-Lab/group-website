@extends('layouts.frontend.master')
@section('title', 'Team')
@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'Team'])
    <div class="basic-team-area gray-bg pt-90 pb-60">
        <div class="container">
            <div class="area-title text-center">
                <h2>Our Collaborators</h2>
                @if ($collaborators->count() == 0)
                    <p>We are a fresh, new group just starting our journey, without any collaborators yet, but full of
                        enthusiasm
                        to create our own legacy.</p>
                @else
                    <p>Despite our youth as an organization, we are fortunate to have a growing network of accomplished
                        collaborators who pave the way for our future success.</p>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="row row-portfolio">
                @foreach ($collaborators as $member)
                    <div class="col-sm-6 col-md-3 col-lg-2">
                        <a href="collaborators/{{ $member->id }}">
                            <div class="team-item">
                                <div class="team-item-image">
                                    @if ($member->photo)
                                        <img src="{{ URL::to('/') }}{{ $member->photo }}" alt="{{ $member->name }} Avatar">
                                    @else
                                        <img src="{{ URL::to('/') }}/assets/images/avatar-default.png" alt="Default Image">
                                    @endif
                                </div>
                                <h4 class="team-item-name">{{ $member->name }}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
