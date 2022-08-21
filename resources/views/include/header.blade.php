<div class="container-fluid header bg-white p-0">
    <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
        <!-- <div class="col-md-6 p-5 mt-lg-5">
            <h1 class="display-5 animated fadeIn mb-4">Find A <span class="text-primary">Perfect Home</span> To Live With Your Family</h1>
            <p class="animated fadeIn mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet
                sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
            <a href="" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Get Started</a>
        </div> -->
        <div class="col-md-12 animated fadeIn">
            <div class="owl-carousel header-carousel">
                <div class="owl-carousel-item">
                    @if(request()->is('about*'))
                        <img class="img-fluid" src="{{ asset('assets/img/41.jpg') }}" alt="">
                    @elseif(request()->is('services*'))
                        <img class="img-fluid" src="{{ asset('assets/img/43.jpg') }}" alt="">
                    @elseif(request()->is('career*'))
                        <img class="img-fluid" src="{{ asset('assets/img/46.jpg') }}" alt="">
                    @elseif(request()->is('contact*'))
                        <img class="img-fluid" src="{{ asset('assets/img/44.jpg') }}" alt="">
                    @elseif(request()->is('testimonials*'))
                        <img class="img-fluid" src="{{ asset('assets/img/42.jpg') }}" alt="">
                    @elseif(request()->is('gallery*'))
                        <img class="img-fluid" src="{{ asset('assets/img/45.jpg') }}" alt="">
                    @else
                        <img class="img-fluid" src="{{ asset('assets/img/40.jpg') }}" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>