@extends('web.layouts.master')

@section('content')
    @include('web.layouts.hero')

    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="post-entry-1 lg">
                        <a href="{{ route('blog.home') }}"><img src="assets/img/article/1.png" alt=""
                                class="img-fluid"></a>
                        <div class="post-meta">
                            <span class="date">Sambutan</span>
                            <span class="mx-1">&bullet;</span>
                            <span>17 Agustus 2023</span>
                        </div>
                        <h2><a href="">Sambutan Ketua</a>
                        </h2>
                        <p class="mb-4 d-block">Pendidikan dalang anak menjadi menarik untuk diperbincangkan, mengingat
                            pedalangan dalam konteks hari ini semakin banyak diminati oleh anak-anak milenial.Betapa bagi
                            anak-anak, wayang adalah meja belajar sekaligus tempat untuk bermain, mereka dapat
                            mengkesplorasi dunianya, sekaligus mendalami filosofi dan nilai sebagai tongkat penyangga
                            kehidupannya kelak.pada kesempatan ini, Kedhaton Ati berkesempatan untuk berbincang dengan Ki
                            Hario Widyoseno, seorang dalang sekaligus pegiat pedalangan anak di Surabaya (Sanggar Baladewa).
                            Mas Rio, akan berkisah mengenai metode dan pengalamanya dalam mendidik anak-anak
                            wayangnya.salam,Kedhaton Ati
                        <p>

                        <div class="d-flex align-items-center author">
                            <div class="photo"><img src="assets/img/person-1.jpg" alt="" class="img-fluid"></div>
                            <div class="name">
                                <h3 class="m-0 p-0">Aqshal bayu</h3>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-8">
                    <div class="row g-5">
                        {{-- @dd($posts) --}}
                        <div class="col-lg-8 border-start custom-border">
                            @forelse ($posts as $post)
                                <div class="post-entry-1">
                                    <a href="{{ route('blog.posts.detail', ['slug' => $post->slug]) }}">
                                        {{-- thumbnail  --}}
                                        @if (file_exists(public_path($post->thumbnail)))
                                            <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}"
                                                class="img-fluid">
                                        @else
                                            <img src="http://placehold.it/750x300" alt="Title" class="img-fluid">
                                        @endif
                                        {{-- end thumbnail --}}
                                    </a>
                                    <div class="post-meta">
                                        {{-- <span class="date"> Budaya </span> --}}
                                        @foreach ($post->categories as $category)
                                            <span>{{ $category->title }}</span>
                                        @endforeach
                                        <span class="mx-1">&bullet;</span>
                                        <span>{{ $post->created_at }}</span>
                                    </div>
                                    <h2><a href="single-post.html">{{ $post->title }}</a></h2>
                                    <p class="mb-4 d-block">
                                        {{ $post->description }}
                                    <p>
                                </div>
                            @empty
                                {{-- <div class="post-entry-1">
                                    <a href="/blogs"><img src="assets/img/article/4.png" alt=""
                                            class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Budaya</span> <span
                                            class="mx-1">&bullet;</span> <span>15 Mei 2020</span></div>
                                    <h2><a href="single-post.html">Sekapur Sirih Wayang Gedhog - Raja Klana</a></h2>
                                </div>
                                <div class="post-entry-1">
                                    <a href="/blogs"><img src="assets/img/article/5.png" alt=""
                                            class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Budaya</span> <span
                                            class="mx-1">&bullet;</span> <span>15 Mei 2020</span></div>
                                    <h2><a href="single-post.html">Persembahan - Wayang Gedhog Gaya surakarta</a></h2>
                                </div>
                                <div class="post-entry-1">
                                    <a href="/blogs"><img src="assets/img/article/6.png" alt=""
                                            class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Budaya</span> <span
                                            class="mx-1">&bullet;</span> <span>15 Mei 2020</span></div>
                                    <h2><a href="single-post.html">Sarasehan - Wayang Gedhog</a></h2>
                                </div> --}}
                                <strong>
                                    Tidak ada posts
                                </strong>
                            @endforelse
                        </div>

                        <!-- Trending Section -->
                        <div class="col-lg-4">

                            <div class="trending">
                                <h3>Terbaru</h3>
                                <ul class="trending-post">
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @forelse ($postsWidget as $post)
                                        <li>
                                            <a href="{{ route('blog.posts.detail', ['slug' => $post->slug]) }}">
                                                <span class="number">{{ $counter }}</span>
                                                <h3>
                                                    {{ $post->title }}
                                                </h3>
                                                <span class="author">{{ $post->user->name }}</span>
                                            </a>
                                        </li>
                                        @php
                                            $counter++;
                                        @endphp

                                    @empty
                                        <strong>
                                            Tidak ada posts
                                        </strong>
                                    @endforelse
                                    {{-- <li>
                                        <a href="/blogs">
                                            <span class="number">1</span>
                                            <h3>The Best Homemade Masks for Face (keep the Pimples Away)</h3>
                                            <span class="author">Jane Cooper</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/blogs">
                                            <span class="number">2</span>
                                            <h3>17 Pictures of Medium Length Hair in Layers That Will Inspire Your New
                                                Haircut</h3>
                                            <span class="author">Wade Warren</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/blogs">
                                            <span class="number">3</span>
                                            <h3>13 Amazing Poems from Shel Silverstein with Valuable Life Lessons</h3>
                                            <span class="author">Esther Howard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/blogs">
                                            <span class="number">4</span>
                                            <h3>9 Half-up/half-down Hairstyles for Long and Medium Hair</h3>
                                            <span class="author">Cameron Williamson</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/blogs">
                                            <span class="number">5</span>
                                            <h3>Life Insurance And Pregnancy: A Working Mom’s Guide</h3>
                                            <span class="author">Jenny Wilson</span>
                                        </a>
                                    </li> --}}
                                </ul>
                            </div>

                        </div> <!-- End Trending Section -->
                    </div>
                </div>

            </div> <!-- End .row -->
        </div>
    </section> <!-- End Post Grid Section -->
@endsection
