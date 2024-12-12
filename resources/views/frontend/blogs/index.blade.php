@extends('layouts.frontend.master')
@section('title', 'News')

@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'News'])
    <div class="basic-blo-area ptb-90">
        <div class="container">
            <div class="area-title text-center">
                <h2>Our News</h2>
                <p>Stay up-to-date with our latest research and activities by exploring our news section. Here you'll find
                    insightful articles, updates, and more.</p>
            </div>
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    <!-- POST -->
                    @foreach ($posts as $post)
                        <article class="post">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="post-thumbnail">
                                        <img src="{{ URL::to('/') }}/{{ $post->image }}" alt="{{ $post->title }}">
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="post-header">
                                        <div class="post-meta">
                                            By
                                            @if ($post->user != null)
                                                @if ($post->user->is_alumni)
                                                    <b><a
                                                            href="/members/alumni/{{ $post->user->id }}">{{ $post->user->name }}</a></b>
                                                @else
                                                    <b><a
                                                            href="/members/current/{{ $post->user->id }}">{{ $post->user->name }}</a></b>
                                                @endif
                                            @else
                                                <b>Anonymous</b>
                                            @endif,
                                            {{ \Carbon\Carbon::parse($post->publish_date)->format('j F, Y') }}
                                        </div>
                                        <h2 class="post-title"><a href="/news/{{ $post->id }}">{{ $post->title }}</a>
                                        </h2>
                                    </div>
                                    <div class="post-content">
                                        @php
                                            $dom = new DOMDocument();
                                            @$dom->loadHTML($post->description);
                                            $paragraphs = $dom->getElementsByTagName('p');
                                            $pText = '';
                                            foreach ($paragraphs as $p) {
                                                $pText .= $p->nodeValue . ' ';
                                            }
                                            $words = explode(' ', $pText);
                                            $first_20_words = implode(' ', array_slice($words, 0, 20));
                                        @endphp
                                        <p>{!! $first_20_words !!}...</p>
                                    </div>
                                    <a class="post-more" href="/news/{{ $post->id }}">Read more &rarr;</a>
                                </div>
                            </div>
                        </article>
                    @endforeach

                    <!-- /POST -->
                    <nav>
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            @if ($posts->onFirstPage())
                                <li class="disabled"><a href="#" aria-label="Previous"><i
                                            class="ion-ios-arrow-back"></i></a></li>
                            @else
                                <li><a href="{{ $posts->previousPageUrl() }}" aria-label="Previous"><i
                                            class="ion-ios-arrow-back"></i></a></li>
                            @endif

                            <!-- Pagination Elements -->
                            @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                @if ($page == $posts->currentPage())
                                    <li class="active"><a href="#">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            <!-- Next Page Link -->
                            @if ($posts->hasMorePages())
                                <li><a href="{{ $posts->nextPageUrl() }}" aria-label="Next"><i
                                            class="ion-ios-arrow-forward"></i></a></li>
                            @else
                                <li class="disabled"><a href="#" aria-label="Next"><i
                                            class="ion-ios-arrow-forward"></i></a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="widget">
                        <form class="search-form" action="{{ route('search') }}" method="GET">
                            <input class="form-control" placeholder="Search..." type="text" name="query">
                            <button type="submit"><i class="ion-search"></i></button>
                        </form>
                    </div>
                    <div class="widget">
                        <h6 class="text-uppercase widget-title">All Categories</h6>
                        <ul class="tags">
                            @foreach ($categories as $category)
                                <li><a href="/news/category/{{ $category->id }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
