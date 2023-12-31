<div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="{{ route('blog.home') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('assets/img/logo.png') }}" alt="Kedhaton Ati">
        <!-- <h1>Kedhaton Ati</h1> -->
    </a>

    <nav id="navbar" class="navbar">
        <ul>
            <li><a href="{{ route('blog.home') }}">Beranda</a></li>
            <li><a href="{{ route('blog.blogs') }}">Blog</a></li>
            <li class="dropdown"><a href="#"><span>Categories</span>
                    <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                {{-- @foreach ($categories as $category)
                    <ul>
                        <li><a href="#">{{ $category->title }}</a></li>
                    </ul>
                @endforeach --}}
                <ul>
                    @foreach ($categories as $category)
                        <li><a href="{{ route('blog.posts.category', ['slug' => $category->slug]) }}">
                                {{ $category->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li><a href="{{ route('blog.about') }}">About</a></li>
            <li><a href="{{ route('blog.contact') }}">Contact</a></li>
        </ul>
    </nav>
    <!-- .navbar -->

    <div class="position-relative">
        <a href="https://www.youtube.com/@kedhatonati335" class="mx-2"><span class="bi-youtube"></span></a>
        <a href="https://www.facebook.com/Kedhaton.ati/" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="https://www.instagram.com/kedhaton.ati/" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
            <form action="search-result.html" class="search-form">
                <span class="icon bi-search"></span>
                <input type="text" placeholder="Search" class="form-control">
                <button class="btn js-search-close"><span class="bi-x"></span></button>
            </form>
        </div>
        <!-- End Search Form -->

    </div>

</div>
