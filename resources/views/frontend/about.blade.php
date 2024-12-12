@extends('layouts.frontend.master')
@section('title', 'About')

@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'About Us'])

    <div class="about-us-area pt-90 pb-20">
        <div class="container">
            <div class="row justify-content-center">
                <!-- PHOTO - Now centered on all screen sizes -->
                <div class="col-md-6 text-center">
                    <div class="about-img">
                        <img src="{{ URL::to('/') }}/assets/images/about/{{ $about['group_photo'] }}" alt="Group Photo"
                            class="img-fluid mx-auto">
                    </div>
                </div>
                <!-- ABOUT TEXT -->
                <div class="col-md-6">
                    <div class="about-text text-start">
                        <h5>Hello, We're <b>SLIMES</b>...</h5>
                        {!! $about->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="basic-process-area pt-90 pb-60">
        <div class="container">
            <div class="area-title text-center">
                <h2>Our Work Process</h2>
                <p>We employ advanced computational modelling and simulation to predict materials properties and discover
                    new
                    materials for next generation technological applications.</p>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-30">
                    <div class="process-item text-center">
                        <div class="process-item-icon">
                            <span class="icon-notebook"></span>
                        </div>
                        <div class="process-item-content">
                            <span class="process-item-number">1</span>
                            <h3 class="process-item-title">Literature</h3>
                            <p>Thinking of a new material with desired capabilities or targeted material properties, and
                                vigorous literature survey.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-30">
                    <div class="process-item text-center highlight">
                        <div class="process-item-icon">
                            <span class="icon-pencil"></span>
                        </div>
                        <div class="process-item-content">
                            <span class="process-item-number">2</span>
                            <h3 class="process-item-title">Modelling</h3>
                            <p>Modelling 3D models of materials structures leveraging high-performance
                                modelling platforms.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-30">
                    <div class="process-item text-center">
                        <div class="process-item-icon">
                            <span class="icon-desktop"></span>
                        </div>
                        <div class="process-item-content">
                            <span class="process-item-number">3</span>
                            <h3 class="process-item-title">Simulations</h3>
                            <p>Running simulations on the computational models or building ML models to predict new
                                materials or materials properties.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-30">
                    <div class="process-item text-center highlight">
                        <div class="process-item-icon">
                            <span class="icon-magnifying-glass"></span>
                        </div>
                        <div class="process-item-content">
                            <span class="process-item-number">4</span>
                            <h3 class="process-item-title">Analysis</h3>
                            <p>Analyzing the simulation or ML outputs using appropriate tools ranging from different
                                visualizing software or ML techniques.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
