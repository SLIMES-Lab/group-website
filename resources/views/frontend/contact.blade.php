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
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="/assets/images/contact/associations/dwave.png" alt="D-WAVE Logo"
                                    class="association-logos" style="width: 100px; margin: 15px;">
                                <img src="/assets/images/contact/associations/mcc.webp" alt="MCC Logo"
                                    class="association-logos" style="width: 100px; margin: 15px;">
                                <img src="/assets/images/contact/associations/mmm.png" alt="MMM Logo"
                                    class="association-logos" style="width: 100px; margin: 15px;">
                                <img src="/assets/images/contact/associations/rsc.png" alt="The Royal Society Logo"
                                    class="association-logos" style="width: 100px; margin: 15px;">
                                <img src="/assets/images/contact/associations/QEVEC.webp" alt="QEVEC Logo"
                                    class="association-logos" style="width: 100px; margin: 15px;">
                                <img src="/assets/images/contact/associations/tyc.png" alt="TYC Logo"
                                    class="association-logos" style="width: 100px; margin: 15px;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /CONTACT DETAILS -->
                <!-- CONTACT PHOTO -->
                <div class="col-md-6 d-flex justify-content-center">
                    {{-- <div class="about-img">
                        <img src="/assets/images/contact/contact-us-image.png" alt="Group Photo">
                    </div> --}}
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4967.589271059884!2d-0.100881!3d51.498636!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604a03afbd695%3A0xffaf0ef7e5c357e4!2sLondon%20South%20Bank%20University!5e0!3m2!1sen!2suk!4v1734005457495!5m2!1sen!2suk"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" id="lsbu-map"></iframe>
                </div>
                <!-- /PHOTO -->
            </div>
        </div>
    </div>

@endsection
