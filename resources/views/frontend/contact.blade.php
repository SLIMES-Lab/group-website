@extends('layouts.frontend.master')
@section('title', 'Contact')

@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'Contact'])

    <div class="about-us-area pt-90 pb-40">
        <div class="container">
            <div class="row col-md-12">
                <!-- CONTACT DETAILS -->
                <div class="col-md-6">
                    <div class="about-text">
                        <h5><b>Dr. John Buckeridge</b></h5>
                        <div>
                            <p>
                                <a href="mailto:j.buckeridge@lsbu.ac.uk">
                                    <i class="fa fa-envelope mr-5"></i> j.buckeridge@lsbu.ac.uk
                                </a></br>
                                <a href="tel:+4420 7815 7420">
                                    <i class="fa fa-phone mr-5"></i> +4420 7815 7420
                                </a></br>
                                <a href="https://jbuckeridge.github.io/">
                                    <i class="fa fa-globe mr-5"></i> jbuckeridge.github.io
                                </a>
                            </p>
                        </div>
                        <p>
                            <i class="fa fa-map-marker mr-5"></i> T703 Tower Block, Division of Mechanical Engineering,
                            <span style="display: block; padding-left: 15px;">London South Bank University,</span>
                            <span style="display: block; padding-left: 15px;">London, SE1 0AA, UK</span>
                        </p>
                    </div>
                </div>
                <!-- /CONTACT DETAILS -->
                <!-- CONTACT PHOTO -->
                <div class="col-md-6">
                    <div class="about-img">
                        <img src="/assets/images/contact/contact-us-image.png" alt="Group Photo">
                    </div>
                </div>
                <!-- /PHOTO -->
            </div>
        </div>
    </div>

@endsection
