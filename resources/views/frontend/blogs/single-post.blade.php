@extends('layouts.frontend.master')
@section('title', 'Blog Post')

@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'Blog Post'])

    <div class="basic-blog-area pt-90 pb-20">
        <div class="container">
            <div class="row blog-masonry">
                <div class="col-md-9 col-xs-12">
                    <!-- POST -->
                    <article class="post">
                        <div class="post-thumbnail">
                            <img src="{{ URL::to('/') }}/{{ $post->image }}" alt="{{ $post->title }}">
                        </div>
                        <div class="widget">
                            <ul class="tags">
                                @foreach ($matching_categories as $category)
                                    <li><a href="/blogs/category/{{ $category->id }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="post-header">
                            <div class="post-meta">
                                By @if ($post->user != null)
                                    @if ($post->user->is_alumni)
                                        <b><a href="/members/alumni/{{ $post->user->id }}">{{ $post->user->name }}</a></b>
                                    @else
                                        <b><a href="/members/current/{{ $post->user->id }}">{{ $post->user->name }}</a></b>
                                    @endif
                                @else
                                    <b>Anonymous</b>
                                @endif,
                                {{ \Carbon\Carbon::parse($post->publish_date)->format('j F, Y') }}
                            </div>
                            <h2 class="single-post-title">{{ $post->title }}</h2>
                        </div>
                        <div class="post-content">
                            @php
                                $config = HTMLPurifier_Config::createDefault();
                                $config->set('HTML.DefinitionID', 'enduser-customize.html tutorial');
                                $purifier = new HTMLPurifier($config);
                            @endphp
                            {!! $purifier->purify(str_replace('<blockquote>', '<blockquote class="single-blockquote">', $post->description)) !!}
                        </div>
                    </article>
                    <!-- /POST -->
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="widget">
                        <form class="search-form" action="{{ route('search') }}" method="GET">
                            <input class="form-control" placeholder="Search..." type="text" name="query">
                            <button type="submit"><i class="ion-search"></i></button>
                        </form>
                    </div>
                    <div class="widget">
                        <h6 class="text-uppercase widget-title">Recent Posts</h6>
                        <ul class="recent-posts">
                            @foreach ($recent_posts as $post)
                                <a href="/blog/{{ $post->id }}">
                                    <li>
                                        <div class="widget-posts-image">
                                            <img src="{{ URL::to('/') }}/{{ $post->image }}" alt="{{ $post->title }}">
                                        </div>
                                        <div class="widget-posts-body">
                                            <h6 class="widget-posts-title">{{ $post->title }}</h6>
                                            <div class="widget-posts-meta">
                                                {{ \Carbon\Carbon::parse($post->publish_date)->format('j F, Y') }}</div>
                                        </div>
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <h6 class="text-uppercase widget-title">All Categories</h6>
                        <ul class="tags">
                            @foreach ($categories as $category)
                                <li><a href="/blogs/category/{{ $category->id }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
