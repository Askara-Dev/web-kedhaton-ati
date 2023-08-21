@extends('web.layouts.master')

@section('content')
    <div class="container" data-aos="fade-up">
        @php
            $categoryGroups = $allPosts->groupBy(function ($post) {
                return $post->categories->pluck('title')->implode('_');
            });
        @endphp

        @foreach ($categoryGroups as $categoryKey => $posts)
            <section class="category-section">
                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    @foreach ($posts->first()->categories as $category)
                        <h2>{{ $category->title }}</h2>
                        <div>
                            <a href="{{ route('blog.posts.category', ['slug' => $category->slug]) }}" class="more">
                                See All {{ $category->title }}
                            </a>
                        </div>
                    @endforeach
                </div>
                @foreach ($posts as $post)
                    <div class="row">
                        <div class="col-md-9">
                            <div class="d-lg-flex post-entry-2">
                                <a href="{{ route('blog.posts.detail', ['slug' => $post->slug]) }}"
                                    class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                                    <img src="{{ $post->thumbnail }}" alt="" class="img-fluid">
                                </a>
                                <div>
                                    <div class="post-meta">
                                        @foreach ($post->tags as $tag)
                                            <span class="date">{{ $tag->title }}</span>
                                        @endforeach
                                        <span class="mx-1">&bullet;</span>
                                        <span>{{ $post->created_at }}</span>
                                    </div>
                                    <h3><a href="{{ route('blog.posts.detail', ['slug' => $post->slug]) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p>
                                        {!! substr($post->content, 0, 350) !!}
                                    </p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo"><img src="{{ $post->authorPhoto }}" alt=""
                                                class="img-fluid"></div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">By {{ $post->user->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        @endforeach
    </div>
@endsection
