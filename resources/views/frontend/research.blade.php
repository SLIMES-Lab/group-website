@extends('layouts.frontend.master')
@section('title', 'Research')

@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'Research Topic'])

    <div class="basic-portfolio-area ptb-90">
        <div class="container">
            <div class="filter-menu text-center mb-40">
                <button class="active" data-filter="*">ALL</button>
                <button data-filter=".topics">Research Topics </button>
                <button data-filter=".softwares">Softwares/Codes</button>
            </div>
            <div id="portfolio-grid" class="row-portfolio">
                @foreach ($research_areas as $item)
                    <div
                        class="portfolio-item {{ $item->item_type == 'Research Topic' ? 'topics' : 'softwares' }} research-item">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-thumb">
                                <img src="{{ asset($item->cover_photo) }}" alt="{{ $item->title }}"
                                    class="research-covers">
                                <div class="view-icon">
                                    <a class="popup-link" href="/research/{{ $item->id }}"><span
                                            class="icon-focus"></span></a>
                                </div>
                            </div>
                            <div class="portfolio-caption caption-border text-center">
                                <h4>{{ $item->title }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        // grab an element
        var myElement = document.querySelector(".headroom");
        // construct an instance of Headroom, passing the element
        var headroom = new Headroom(myElement);
        // initialise
        headroom.init();
    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
