<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="/admin/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseNews"
                    aria-expanded="false" aria-controls="collapseNews">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-newspaper"></i></div>
                    Blogs
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseNews" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('admin/add-post') }}">Add Post</a>
                        <a class="nav-link" href="{{ url('admin/posts') }}">All Blogs</a>
                    </nav>
                </div>

                <a class="nav-link collapsed {{ Route::is('group.*') ? 'active' : '' }}" href="#"
                    data-bs-toggle="collapse" data-bs-target="#collapseGroup" aria-expanded="false"
                    aria-controls="collapseGroup">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Group
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Route::is('group.*') ? 'show' : '' }}" id="collapseGroup"
                    aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionGroup">
                        <a class="nav-link collapsed {{ Route::is('group.members.*') ? 'active' : '' }}" href="#"
                            data-bs-toggle="collapse" data-bs-target="#pagesCollapseMembers" aria-expanded="false"
                            aria-controls="pagesCollapseMembers">
                            Members
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ Route::is('group.members*') ? 'show' : '' }}" id="pagesCollapseMembers"
                            aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ url()->current() == url('admin/group/members/current') ? 'active' : '' }}"
                                    href="{{ url('admin/group/members/current') }}">Current</a>
                                <a class="nav-link {{ url()->current() == url('admin/group/members/alumni') ? 'active' : '' }}"
                                    href="{{ url('admin/group/members/alumni') }}">Alumni</a>
                                <a class="nav-link {{ url()->current() == url('admin/group/members/collaborators') ? 'active' : '' }}"
                                    href="{{ url('admin/group/members/collaborators') }}">Collaborators</a>
                            </nav>
                        </div>
                        <a class="nav-link {{ url()->current() == url('admin/group/positions') ? 'active' : '' }}"
                            href="{{ url('admin/group/positions') }}">Positions</a>
                        <a class="nav-link {{ url()->current() == url('admin/group/all-album') ? 'active' : '' }}"
                            href="{{ url('admin/group/all-album') }}">Photos</a>
                    </nav>
                </div>

                <a class="nav-link collapsed {{ Route::is('pages.*') ? 'active' : '' }}" href="#"
                    data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false"
                    aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Route::is('pages.*') ? 'show' : '' }}" id="collapsePages"
                    aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link {{ url()->current() == url('admin/pages/home/1') ? 'active' : '' }}"
                            href="{{ url('admin/pages/home/1') }}">Home</a>
                        <a class="nav-link {{ url()->current() == url('admin/pages/about/1') ? 'active' : '' }}"
                            href="{{ url('admin/pages/about/1') }}">About</a>
                        <a class="nav-link collapsed {{ url()->current() == url('admin/pages/research-areas') || url()->current() == url('admin/pages/research-areas/add-area') ? 'active' : '' }}"
                            href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth"
                            aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Research Areas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse {{ url()->current() == url('admin/pages/research-areas') || url()->current() == url('admin/pages/research-areas/add-area') ? 'show' : '' }}"
                            id="pagesCollapseAuth" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ url()->current() == url('admin/pages/research-areas') ? 'active' : '' }}"
                                    href="{{ url('admin/pages/research-areas') }}">Research Areas</a>
                                <a class="nav-link {{ url()->current() == url('admin/pages/research-areas/add-area') ? 'active' : '' }}"
                                    href="{{ url('admin/pages/research-areas/add-area') }}">Add New Area</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="{{ url('admin/pages/contact/1') }}">Contact</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>
