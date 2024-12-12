    <header>
        <div class="header-area headroom">
            <div class="container sm-100">
                <div class="row">
                    <div class="col-md-3 col-sm-2">
                        <div class="logo text-upper">
                            <h4>
                                <a href="/">
                                    {{-- <img src="/assets/images/SLIMES-logo.svg" alt="" class="hidden-xs">
                                    <img src="/assets/images/SLIMES-logo-short.svg" alt=""
                                        class="visible-xs navbar-logo-short"> --}}
                                    @if ($isHome)
                                        <img src="/assets/images/SLIMES-logo.svg" alt="SLIMES Logo" class="hidden-xs"
                                            id="large-logo-default">
                                        <img src="/assets/images/SLIMES-logo-small.svg" alt="SLIMES Logo"
                                            class="visible-xs navbar-logo-short" id="small-logo-default">
                                    @else
                                        @php
                                            $width = '<script>
                                                document.write(screen.width);
                                                console.log(screen.width);
                                            </script>';
                                        @endphp
                                        <img src="/assets/images/SLIMES-logo-white.svg" alt="SLIMES Logo"
                                            class="hidden-xs" id="large-logo-white">
                                        <img src="/assets/images/SLIMES-logo.svg" alt="SLIMES Logo" class="hidden-xs"
                                            id="large-logo-default" style="display: none">
                                        <img src="/assets/images/SLIMES-logo-small-white.svg" alt="SLIMES Logo"
                                            class="visible-xs navbar-logo-short" id="small-logo-white">
                                        <img src="/assets/images/SLIMES-logo-small.svg" alt="SLIMES Logo"
                                            class="navbar-logo-short" id="small-logo-default" style="display: none">
                                    @endif



                                    <!-- Small Device Logos -->


                                </a>
                            </h4>
                        </div>
                    </div>

                    <div class="col-md-9 col-sm-10">
                        <div class="menu-area hidden-xs">
                            <nav class="{{ $isHome ? 'home' : 'other' }}">
                                <ul class="basic-menu clearfix">
                                    <li><a href="/about">About</a></li>
                                    <li><a href="/research">Research</a></li>
                                    <li><a href="/publications">Publications</a></li>
                                    <li>
                                        <a href="#">Group</a>
                                        <ul>
                                            <li><a href="https://jbuckeridge.github.io/" target="_blank">John
                                                    Buckeridge</a></li>
                                            <li>
                                                <a href="#">Members <i class="fa fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="/members/current">Current</a></li>
                                                    <li><a href="/members/alumni">Alumni</a></li>
                                                    <li><a href="/members/collaborators">Collaborators</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="/open-positions">Open Positions</a></li>
                                            <li><a href="/gallery">Gallery</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/news">News</a></li>
                                    <li><a href="/contact">Contact</a></li>
                                </ul>
                                </li>

                                </ul>
                            </nav>
                        </div>
                        <!-- basic-mobile-menu -->
                        <div class="basic-mobile-menu visible-xs {{ $isHome ? 'home' : 'other' }}">
                            <nav id="mobile-nav">
                                <ul>
                                    <li><a href="/about">About</a></li>
                                    <li><a href="/research">Research</a></li>
                                    <li><a href="/publications">Publications</a></li>
                                    <li>
                                        <a href="#">Group</a>
                                        <ul>
                                            <li>
                                                <a href="#">Members <i class="fa fa-angle-right"></i></a>
                                                <ul>
                                                    <li><a href="/members/current">Current</a></li>
                                                    <li><a href="/members/alumni">Alumni</a></li>
                                                    <li><a href="/members/collaborators">Collaborators</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="/open-positions">Open Positions</a></li>
                                            <li><a href="/gallery">Gallery</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/news">News</a></li>
                                    <li><a href="/contact">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
