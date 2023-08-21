@foreach ($postsFootbar as $post)
    <li>
        <a href="{{ route('blog.posts.detail', ['slug' => $post->slug]) }}" class="d-flex align-items-center">
            {{-- <img src="assets/img/post-sq-1.jpg" alt="" class="img-fluid me-3"> --}}
            {{-- thumbnail  --}}
            @if (file_exists(public_path($post->thumbnail)))
                <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}" class="img-fluid me-3">
            @else
                <img src="http://placehold.it/750x300" alt="Title" class="img-fluid me-3">
            @endif
            {{-- end thumbnail --}}
            <div>
                <div class="post-meta d-block">
                    @foreach ($post->categories as $category)
                        <span>{{ $category->title }}</span>
                    @endforeach
                    <span class="mx-1">&bullet;</span>
                    <span>{{ $post->created_at }}</span>
                </div>
                <span>
                    {{ $post->title }}
                </span>
            </div>
        </a>
    </li>
@endforeach
