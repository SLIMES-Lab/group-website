@extends('layouts.frontend.master')
@section('title', 'Team')
@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'Team'])
    <div class="basic-team-area gray-bg pt-90 pb-60">
        <div class="container">
            <div class="area-title text-center">
                <h2>Our Team</h2>
                <p>A close-knit team of dedicated scholars united in the pursuit of groundbreaking research and novel
                    insights.</p>
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
                    $$variable = $currentMembers->filter(function ($member) use ($type) {
                        return $member->type == $type;
                    });
                }
                $lastPrincipalInvestigator = $principalInvestigators->last();
                $memberGroups = [
                    'Post Docs' => $postDocs,
                    'PhD Students' => $phdStudents,
                    'Masters Students' => $mastersStudents,
                    'Bachelors Students' => $bachelorsStudents,
                ];
            @endphp
            <div class="mb-20 text-center">
                <h4><b>Princpal Investigator</b></h4>
            </div>
            <div class="row row-portfolio">
                @if (!$lastPrincipalInvestigator)
                    <p>Principal Investigator Will Be Updated Soon!!!</p>
                @else
                    @foreach ($principalInvestigators as $member)
                        <div class="col-xs-10 col-sm-5 col-md-4">
                            <a href="https://jbuckeridge.github.io/" target="_blank">
                                <div class="team-item">
                                    <div class="team-item-image">
                                        @if ($lastPrincipalInvestigator->photo)
                                            <img src="{{ URL::to('/') }}{{ $lastPrincipalInvestigator->photo }}"
                                                alt="{{ $lastPrincipalInvestigator->name }} Avatar">
                                        @else
                                            <img src="{{ URL::to('/') }}/assets/images/avatar-default.png"
                                                alt="Default Image">
                                        @endif
                                    </div>
                                    <h4 class="team-item-name">{{ $lastPrincipalInvestigator->name }}</h4>
                                </div>
                            </a>
                        </div>
                    @break
                @endforeach
            @endif
        </div>
        @foreach ($memberGroups as $title => $members)
            @if ($members->count())
                <div class="mb-20 pt-20 text-center">
                    <h4><b>{{ $title }}</b></h4>
                </div>
                <div class="row row-portfolio">
                    @foreach ($members as $member)
                        <div class="col-sm-5 col-md-3 col-lg-2">
                            <a href="/members/current/{{ $member->id }}">
                                <div class="team-item">
                                    <div class="team-item-image">
                                        @if ($member->photo)
                                            <img src="{{ URL::to('/') }}{{ $member->photo }}"
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
            @endif
        @endforeach
    </div>
</div>
@endsection
