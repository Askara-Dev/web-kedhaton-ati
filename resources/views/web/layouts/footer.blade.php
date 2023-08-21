<div class="footer-content">
    <div class="container">

        <div class="row g-5">
            <div class="col-lg-4">
                <h3 class="footer-heading">About Kedhaton Ati</h3>
                <p>Laboratorium Wayang Virtual</p>
                <p><a href="{{ route('blog.about') }}" class="footer-link-more">Learn More</a></p>
            </div>
            <div class="col-6 col-lg-2">
                <h3 class="footer-heading">Navigation</h3>
                <ul class="footer-links list-unstyled">
                    <li><a href="{{ route('blog.home') }}"><i class="bi bi-chevron-right"></i> Home</a></li>
                    <li><a href="{{ route('blog.blogs') }}"><i class="bi bi-chevron-right"></i> Blog</a></li>
                    {{-- <li><a href="#"><i class="bi bi-chevron-right"></i> Categories</a></li> --}}
                    <li><a href="{{ route('blog.about') }}"><i class="bi bi-chevron-right"></i> About us</a></li>
                    <li><a href="{{ route('blog.contact') }}"><i class="bi bi-chevron-right"></i> Contact</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <h3 class="footer-heading">Categories</h3>
                <ul class="footer-links list-unstyled">
                    <ul>
                        @foreach ($categories as $category)
                            <li><a href="{{ route('blog.posts.category', ['slug' => $category->slug]) }}">
                                    {{ $category->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </ul>
            </div>

            <div class="col-lg-4">
                <h3 class="footer-heading">Recent Posts</h3>

                <ul class="footer-links footer-blog-entry list-unstyled">
                    @include('web.layouts.recent-post', ['categories' => $categories])

                </ul>

            </div>
        </div>
    </div>
</div>

<div class="footer-legal">
    <div class="container">

        <div class="row justify-content-between">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <div class="copyright">
                    © Copyright <strong><span>Kedhatonati</span></strong>. All Rights Reserved
                </div>

                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
                    Developed by <a href="https://github.com/Askara-Dev">Askara Dev</a>
                </div>

            </div>

            <div class="col-md-6">
                <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
                    <a href="https://www.youtube.com/@kedhatonati335" class="youtube"><i class="bi bi-youtube"></i></a>
                    <a href="https://www.facebook.com/Kedhaton.ati/" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/kedhaton.ati/" class="instagram"><i
                            class="bi bi-instagram"></i></a>
                    <!-- <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> -->
                </div>

            </div>

        </div>

    </div>
</div>
