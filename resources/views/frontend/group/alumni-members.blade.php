@extends('layouts.frontend.master')
@section('title', 'Team')
@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'Team'])
    <div class="basic-team-area gray-bg pt-90 pb-60">
        <div class="container">
            <div class="area-title text-center">
                <h2>Our Alumni</h2>
                @if ($alumniMembers->count() == 0)
                    <p>We are a fresh, new group just starting our journey, without any alumni yet, but full of enthusiasm
                        to create our own legacy.</p>
                @else
                    <p>Despite our youth as an organization, we are fortunate to have a growing network of accomplished
                        alumni who pave the way for our future success.</p>
                @endif
            </div>
            @php
                $memberTypes = [
                    'principalInvestigators' => 'guide',
                    'postDocs' => 'postdoc',
                    'phdStudents' => 'phd',
                    'mastersStudents' => 'masters',
                    'bachelorsStudents' => 'bachelors',
                ];
                foreach ($memberTypes as $variable => $type) {
                    $$variable = $alumniMembers->filter(function ($member) use ($type) {
                        return $member->type == $type;
                    });
                }
                $memberGroups = [
                    'Post Docs' => $postDocs,
                    'PhD Students' => $phdStudents,
                    'Masters Students' => $mastersStudents,
                    'Bachelors Students' => $bachelorsStudents,
                ];
            @endphp
        </div>
        @foreach ($memberGroups as $title => $members)
            @if ($members->count())
                <div class="mb-20 pt-20 text-center">
                    <h4><b>{{ $title }}</b></h4>
                </div>
                <div class="container">
                    <div class="row row-portfolio">
                        @foreach ($members as $member)
                            <div class="col-sm-6 col-md-3 col-lg-2">
                                <a href="alumni/{{ $member->id }}">
                                    <div class="team-item">
                                        @php
                                            $imagePath = $member->image;
                                            if (substr($imagePath, 0, 1) === '/') {
                                                $imagePath = substr($imagePath, 1);
                                            }
                                        @endphp
                                        <div class="team-item-image">
                                            @if ($imagePath)
                                                <img src="{{ URL::to('/') }}/{{ $imagePath }}"
                                                    alt="{{ $member->name }} Avatar">
                                            @else
                                                <img src="{{ URL::to('/') }}/assets/images/avatar-default.png"
                                                    alt="Default Image">
                                            @endif
                                        </div>
                                        <h4 class="team-item-name">{{ $member->name }}</h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    </div>
@endsection
