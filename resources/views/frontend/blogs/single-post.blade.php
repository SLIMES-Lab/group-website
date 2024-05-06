@extends('layouts.frontend.master')
@section('title', 'Blog Post')

@section('content')

    @include('frontend.components.breadcrumb', ['pagetitle' => 'Blog Post'])

    <div class="basic-blog-area pt-90 pb-20">
        <div class="container">
            <div class="row blog-masonry">
                <div class="col-md-9 col-xs-12">
                    <article class="post">
                        <div class="post-thumbnail">
                            <img src="{{ URL::to('/') }}/{{ $post->image }}"alt="{{ $post->title }}">
                        </div>
                        <div class="post-header">
                            <div class="post-meta"> By
                                @if ($post->user != null)
                                    @if ($post->user->is_alumni)
                                        <b><a href="/members/alumni/{{ $post->user->id }}">{{ $post->user->name }}</a></b>
                                    @else
                                        <b><a href="/members/current/{{ $post->user->id }}">{{ $post->user->name }}</a></b>
                                    @endif
                                @else
                                    <b>Anonymous</b>
                                @endif
                                , {{ \Carbon\Carbon::parse($post->publish_date)->format('j F, Y') }}
                            </div>
                            <h1 class="post-title">{{ $post->title }}</h1>
                            @if ($post->subtitle != null)
                                <h6>{{ $post->subtitle }}</h6>
                            @endif
                        </div>
                        <div class="post-content">
                            {!! $post->description !!}
                        </div>
                    </article>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="widget">
                        <h6 class="text-uppercase widget-title">Categories</h6>
                        <ul class="tags">
                            @foreach ($post->categories as $category)
                                <li><a href="/blogs/category/{{ $category->id }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <h6 class="text-uppercase widget-title">Recent Posts</h6>
                        <ul class="recent-posts">
                            @foreach ($recent_posts as $recent_post)
                                <li>
                                    <a href="/blog/{{ $recent_post->id }}">
                                        <div class="widget-posts-image"><img
                                                src="{{ URL::to('/') }}/{{ $recent_post->image }}"
                                                alt="{{ $recent_post->title }}">
                                        </div>
                                        <div class="widget-posts-body">
                                            <h6 class="widget-posts-title">{{ $recent_post->title }}</h6>
                                            <div class="widget-posts-meta">
                                                {{ \Carbon\Carbon::parse($recent_post->publish_date)->format('j F, Y') }}
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
