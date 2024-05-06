@extends('layouts.frontend.master')
@section('title', 'Publications')

@section('styles')
    <style>
        .bibbase-div {
            margin: 20px 200px;
            padding: 20px;
        }

        .bibbase_group span {
            color: #000;
            text-shadow: 3px 3px 2px rgba(125, 118, 128, 1);
        }

        .bibbase_paper_title {
            font-size: 1.2em;
            font-weight: bold;
        }

        @media only screen and (max-width: 1100px) {
            .bibbase-div {
                margin: 20px 120px;
                padding: 20px;
            }
        }

        @media only screen and (max-width: 900px) {
            .bibbase-div {
                margin: 20px 60px;
                padding: 20px;
            }
        }

        @media only screen and (max-width: 750px) {
            .bibbase-div {
                margin: 20px 20px;
                padding: 20px;
            }
        }

        @media only screen and (max-width: 450px) {
            .bibbase-div {
                margin: 10px 10px;
                padding: 10px;
            }

            .bibbase_paper_title {
                font-size: 0.9em;
                font-weight: bold;
            }

            .bibbase_group span {
                font-size: 0.8em;
            }
        }
    </style>
@endsection

@section('content')
    @include('frontend.components.breadcrumb', ['pagetitle' => 'Publications'])
    <div class="bibbase-div">
        <script
            src="https://bibbase.org/show?bib=https://bibbase.org/network/files/L6oHYoy8a5nTT8bpW&jsonp=1&hidemenu=true&filter=year:(201[6-9]|202.)&theme=mila">
        </script>
        <div class="features-btn text-left">
            <a href="https://scholar.google.nl/citations?user=hfyoL4AAAAAJ&hl=en" class="btn">Explore More</a>
        </div>
    </div>
@endsection
