@extends('web.layouts.master')

@section('content')
    <section>
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="page-title">About us</h1>
                </div>
            </div>

            <div class="row mb-5">

                <div class="d-md-flex post-entry-2 half">
                    <a href="#" class="me-4 thumbnail">
                        <img src="assets/img/logo.png" alt="" class="img-fluid">
                    </a>
                    <div class="ps-md-5 mt-4 mt-md-0">
                        <div class="post-meta mt-4">About us</div>
                        <h2 class="mb-4 display-4">Company History</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime,
                            adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident
                            inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam
                            temporibus aut!</p>
                        <p>Fugit eaque illum blanditiis, quo exercitationem maiores autem laudantium unde excepturi dolores
                            quasi eos vero harum ipsa quam laborum illo aut facere voluptates aliquam adipisci sapiente
                            beatae ullam. Tempora culpa iusto illum accusantium cum hic quisquam dolor placeat officiis
                            eligendi.</p>
                    </div>
                </div>

                <div class="d-md-flex post-entry-2 half mt-5">
                    <a href="#" class="me-4 thumbnail order-2">
                        <img src="assets/img/logo.png" alt="" class="img-fluid">
                    </a>
                    <div class="pe-md-5 mt-4 mt-md-0">
                        <div class="post-meta mt-4">Mission &amp; Vision</div>
                        <h2 class="mb-4 display-4">Mission &amp; Vision</h2>

                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime,
                            adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident
                            inventore? Voluptatum in tempora earum deleniti, culpa odit veniam, ea reiciendis sunt ullam
                            temporibus aut!</p>
                        <p>Fugit eaque illum blanditiis, quo exercitationem maiores autem laudantium unde excepturi dolores
                            quasi eos vero harum ipsa quam laborum illo aut facere voluptates aliquam adipisci sapiente
                            beatae ullam. Tempora culpa iusto illum accusantium cum hic quisquam dolor placeat officiis
                            eligendi.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container-fluid">

            <div class="row gy-4 justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gallery-item h-100">
                        <img src="assets/img/article/1.png" class="img-fluid" alt="">
                        <div class="gallery-links d-flex align-items-center justify-content-center">
                            <a href="assets/img/article/1.png" title="Gallery 1" class="glightbox preview-link"><i
                                    class="bi bi-arrows-angle-expand"></i></a>
                        </div>
                    </div>
                </div><!-- End Gallery Item -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gallery-item h-100">
                        <img src="assets/img/article/2.png" class="img-fluid" alt="">
                        <div class="gallery-links d-flex align-items-center justify-content-center">
                            <a href="assets/img/article/2.png" title="Gallery 2" class="glightbox preview-link"><i
                                    class="bi bi-arrows-angle-expand"></i></a>
                        </div>
                    </div>
                </div><!-- End Gallery Item -->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="gallery-item h-100">
                        <img src="assets/img/article/3.png" class="img-fluid" alt="">
                        <div class="gallery-links d-flex align-items-center justify-content-center">
                            <a href="assets/img/article/3.png" title="Gallery 3" class="glightbox preview-link"><i
                                    class="bi bi-arrows-angle-expand"></i></a>
                        </div>
                    </div>
                </div><!-- End Gallery Item -->
            </div>

        </div>
    </section><!-- End Gallery Section -->
@stop
