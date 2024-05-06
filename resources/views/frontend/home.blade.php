@extends('layouts.frontend.master')
@section('title', 'Home')

@section('content')
    <div class="basic-space"></div>

    <!-- basic-slider start -->
    <div class="basic-slider slide-1"
        style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ URL::to('/') }}/assets/images/home/{{ $homedata['homepage_image'] }}') no-repeat center center / cover;">
        <div class="container">
            <div class="slider-content">
                <h2 class="cd-headline clip is-full-width">Hello, <br> {{ $homedata['heading'] }}
                    <span class="cd-words-wrapper">
                        <b class="is-visible">{{ $homedata['topics'][0] }}</b>
                        @foreach ($homedata['topics'] as $topic)
                            @if ($loop->index == 0)
                                @continue
                            @endif
                            <b>{{ $topic }}</b>
                        @endforeach
                    </span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </h2>

                <p>{{ $homedata['subheading'] }}</p>
                <a class="btn btn-large" id="aboutButton" href="#">About Us</a>
            </div>
        </div>
    </div>
    <!-- basic-slider end -->
    <!-- basic-portfolio-area start -->
    <div id="keydata">
        <div class="row">
            <div class="col-lg-12">
                <div class="ras-calltoaction">
                    <div class="row">
                        <div class="col-sm-4 col-12">
                            <div class="ras-counter-1">
                                <div class="ras-counter-icon">
                                    <span class="ion-document-text"></span>
                                </div>
                                <div class="ras-counter-info">
                                    <h3><span id="papers" class="ras-counter-number">{{ $homedata['papers'] }}</span>
                                        <span class="ras-counter-postfix">+</span>
                                    </h3>
                                    <p class="ras-counter-label">Research Papers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="ras-counter-1">
                                <div class="ras-counter-icon">
                                    <span class="ion-stats-bars"></span>
                                </div>
                                <div class="ras-counter-info">
                                    <h3><span id="citations" class="ras-counter-number">{{ $homedata['citations'] }}</span>
                                        <span class="ras-counter-postfix">+</span>
                                    </h3>
                                    <p class="ras-counter-label">Citations</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="ras-counter-1">
                                <div class="ras-counter-icon">
                                    <span class="ion-android-people"></span>
                                </div>
                                <div class="ras-counter-info">
                                    <h3><span id="group_members"
                                            class="ras-counter-number">{{ $homedata['group_members'] }}</span> <span
                                            class="ras-counter-postfix">+</span></h3>
                                    <p class="ras-counter-label">Group Members</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="basic-service-area pt-90 pb-50">
            <div class="container">
                <div class="area-title text-center">
                    <h2>Our Objectives</h2>
                    <p>Our group aims to advance materials modeling and simulation using emerging AI approaches in order to
                        enable optimized, sustainable technologies for future demands.</p>
                </div>
                <div class="row text-center">
                    <div class="col-md-4 col-sm-6 mb-40">
                        <div class="service-box">
                            <div class="service-icon">
                                <span><i class="fa fa-leaf" aria-hidden="true"></i></span>
                            </div>
                            <div class="service-content">
                                <h3>Sustainability</h3>
                                <p>Spearheading materials breakthroughs to enable sustainable technologies preserving our
                                    planet.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-40">
                        <div class="service-box">
                            <div class="service-icon">
                                <span><i class="fa fa-cogs" aria-hidden="true"></i></span>
                            </div>
                            <div class="service-content">
                                <h3>Advanced Engineering</h3>
                                <p>Charting new frontiers in multi-scale modeling to accelerate precision advances in
                                    electronic devices.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-40">
                        <div class="service-box">
                            <div class="service-icon">
                                <span><i class="fa fa-industry" aria-hidden="true"></i></span>
                            </div>
                            <div class="service-content">
                                <h3>Industry Focused</h3>
                                <p>
                                    Advancing tech viability through strategic industry partnerships, fostering
                                    collaboration and scale.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- basic-portfolio-area end -->


    <!-- basic-service-area start -->
    <div class="row" id="john-container">
        <div class="col-md-6">
            <div class="ras-features-image bordered-image ">
                <img src="https://peoplefinder.lsbu.ac.uk/download/599ca2240dc729643f8f94c491eed5702bf1dfdaa9d4dc0caaf7257ab2dd390d/2294829/webdisplay/w600/h592/John%20Buckeridge.jpg"
                    alt="our-features">
            </div>
        </div>
        <div class="col-md-6">
            <div class="ras-features-details" id="john-data">
                <h3 class="capitalize">Dr. John Buckeridge</h3>
                <div>
                    {!! $homedata['john_details'] !!}
                </div>
                <div class="features-btn text-left">
                    <a href="#" class="btn">Know More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- basic-service-area end -->
    <div class="basic-blog-area ptb-90">
        <div class="container">
            <div class="area-title text-center">
                <h2>Recent Blogs</h2>
                <p>Check out our latest thoughts and perspectives on topics related to our research, captured in these brief
                    but insightful blog posts.</p>
            </div>
            <div class="row blog-masonry" style="position: relative; height: 869.656px;">
                @foreach ($posts as $post)
                    <div class="col-sm-6 col-md-4 blog-item" style="position: absolute; left: 0%; top: 0px;">
                        <!-- POST -->
                        <article class="post">
                            <div class="post-thumbnail">
                                <img src="{{ URL::to('/') }}/{{ $post->image }}"alt="{{ $post->title }}">
                            </div>
                            <div class="post-header">
                                <div class="post-meta">
                                    By
                                    @if ($post->user != null)
                                        @if ($post->user->is_alumni)
                                            <b>{{ $post->user->name }}</b>
                                        @else
                                            <b><a href="#">{{ $post->user->name }}</a></b>
                                        @endif
                                    @else
                                        <b>Anonymous</b>
                                    @endif
                                    ,
                                    {{ \Carbon\Carbon::parse($post->publish_date)->format('j F, Y') }}
                                </div>
                                <h2 class="post-title"><a href="/{{ $post->id }}">{{ $post->title }}</a></h2>
                            </div>
                            <div class="post-content">
                                <p>{{ $post->subtitle }}</p>
                                <a class="post-more" href="/post/{{ $post->id }}">Read more →</a>
                            </div>
                        </article>
                        <!-- /POST -->
                    </div>
                @endforeach
            </div>

        </div>
        <div class="features-btn text-left">
            <a href="/blogs" class="btn">Explore More</a>
        </div>
    </div>
@endsection
@php
    $targets = ['papers', 'citations', 'group_members'];
    $endValues = [$homedata['papers'], $homedata['citations'], $homedata['group_members']];
@endphp
@section('scripts')
    <script>
        const targets = @json($targets);
        const endValues = @json($endValues);

        function animateValue(obj, end, duration) {
            let startTimestamp = null;
            const start = 0;

            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;

                const progress = Math.min((timestamp - startTimestamp) / duration, 1);

                obj.innerHTML = Math.floor(progress * (end - start) + start);

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };

            window.requestAnimationFrame(step);
        }
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const index = targets.indexOf(entry.target.id);
                    animateValue(entry.target, endValues[index], 5000);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        targets.forEach(target => {
            const obj = document.getElementById(target);
            observer.observe(obj);
        });
    </script>
@endsection
