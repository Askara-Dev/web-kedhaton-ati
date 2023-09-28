@extends('web.layouts.master')

@section('content')
    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content" data-aos="fade-up">

                    <!-- ======= Single Post Content ======= -->
                    <div class="single-post">
                        @foreach ($post->categories as $category)
                            <div class="post-meta"><span class="date"></span>{{ $category->title }}<span
                                    class="mx-1">&bullet;</span>
                        @endforeach
                        <span>{{ $post->date }}</span>
                    </div>
                    <h6 class="mb-1">By: {{ $post->user->name }} </h6>
                    <h1 class="mb-5">{{ $post->title }}</h1>
                    <figure">
                        <img src="{{ asset($post->thumbnail) }}" alt="" class="img-fluid">
                        <figcaption>{{ $post->description }}</figcaption>
                        </figure>
                        <p>
                            {!! $post->content !!}
                        </p>
                </div><!-- End Single Post Content -->

            </div>
            <div class="col-md-3">
                <!-- ======= Sidebar ======= -->

                <div class="aside-block">
                    <h3 class="aside-title">Kategori</h3>
                    <ul class="aside-links list-unstyled">
                        @foreach ($categories as $category)
                            <li><a href="{{ route('blog.posts.category', ['slug' => $category->slug]) }}">
                                    {{ $category->title }}
                                </a>
                            </li>
                        @endforeach
                        {{-- <li><a href="category.html"><i class="bi bi-chevron-right"></i> Business</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Culture</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Sport</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Food</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Politics</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Celebrity</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Startups</a></li>
                            <li><a href="category.html"><i class="bi bi-chevron-right"></i> Travel</a></li> --}}
                    </ul>
                </div><!-- End Categories -->

                <div class="aside-block">
                    <h3 class="aside-title">Tags</h3>
                    <ul class="aside-tags list-unstyled">
                        @foreach ($post->tags as $tag)
                            <li>
                                <a href="{{ route('blog.posts.tag', ['slug' => $tag->slug]) }}">
                                    {{ $tag->title }}
                                </a>
                            </li>
                        @endforeach
                        {{-- <li><a href="category.html">Culture</a></li>
                            <li><a href="category.html">Sport</a></li>
                            <li><a href="category.html">Food</a></li>
                            <li><a href="category.html">Politics</a></li>
                            <li><a href="category.html">Celebrity</a></li>
                            <li><a href="category.html">Startups</a></li>
                            <li><a href="category.html">Travel</a></li> --}}
                    </ul>
                </div><!-- End Tags -->

            </div>
        </div>
        </div>
    </section>
@endsection
