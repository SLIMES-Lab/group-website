@extends('layouts.frontend.master')
@section('title', 'Category Wise News')

@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'Category Wise News'])
    <div class="basic-blo-area ptb-90">
        <div class="container">
            <div class="area-title text-center">
                <h2>News with category '<b>{{ $category->name }}</b>'</h2>
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
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="widget">
                        <form class="search-form" action="{{ route('search') }}" method="GET">
                            <input class="form-control" placeholder="Search..." type="text" name="query">
                            <button type="submit"><i class="ion-search"></i></button>
                        </form>
                    </div>
                    <div class="widget">
                        <h6 class="text-uppercase widget-title">Other Categories</h6>
                        <ul class="tags">
                            @foreach ($other_categories as $category)
                                <li><a href="/news/category/{{ $category->id }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
