@extends('web.layouts.master')

@section('content')
    <section class="category-section">
        <div class="container" data-aos="fade-up">

            @if ($posts->isEmpty())
                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h2> Belum ada postingan di Tag ini </h2>
                </div>
            @else
                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    @foreach ($posts->first()->tags as $tag)
                        <h2>{{ $tag->title }}</h2>
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
                                        @foreach ($post->categories as $category)
                                            <span class="date">{{ $category->title }}</span>
                                        @endforeach
                                        <span class="mx-1">&bullet;</span>
                                        <span>{{ $post->created_at }}</span>
                                    </div>
                                    <h3><a
                                            href="{{ route('blog.posts.detail', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p>
                                        {!! substr($post->content, 0, 350) !!}
                                    </p>
                                    <div class="d-flex align-items-center author">
                                        <div class="photo"><img src="{{ $post->authorPhoto }}" alt=""
                                                class="img-fluid"></div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">{{ $post->user->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional post entries and rows can be placed here -->

                        </div>

                        <!-- Sidebar content can be placed here -->

                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection
