@extends('layouts.app')

@section('content')
<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-gradient 3about-img position-relative overflow-hidden p-5 pe-0">
                    <img class="img-fluid w-100" src="assets/img/about.jpg">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="page-heading text-center mx-auto mb-2 wow animated fadeInDown" data-wow-delay="0.1s" style="max-width: 600px;">
                    <span class="aux-head-before heading-text">About</span>
                    <span class="mb-3 heading-text">Us</span>
                </div>
                <h3 class="mb-4 heading-sub-text">We Accelerate Your Financial Growth</h3>
                <p class="mb-4">We work with you towards your future goals. Kalpataru is known for its unparalleled financial services provided to its clients through a wide range of investment products on offer. Our team deftly manage:</p>
                <p><i class="fa fa-check text-primary me-3"></i>Stocks and capital markets</p>
                <p><i class="fa fa-check text-primary me-3"></i>Mergers and acquisitions</p>
                <p><i class="fa fa-check text-primary me-3"></i>Initial public offerings</p>
                <p><i class="fa fa-check text-primary me-3"></i>Private equity investments and advisory</p>
                <p><i class="fa fa-check text-primary me-3"></i>Financial advisory</p>
                <!-- <a class="btn btn-primary add-gradiant py-3 px-5 mt-3" href="">Read More</a> -->
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Service Start -->
<div class="container-xxl py-5" style="padding-bottom: 2rem !important;">
    <div class="container">
        <div class="page-heading text-center mx-auto mb-2 wow animated fadeInDown" data-wow-delay="0.1s" style="max-width: 600px;">
            <span class="aux-head-before heading-text">Our</span>
            <span class="mb-3 heading-text">Services</span>
        </div>
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p>{!! $data['PAGE_DESCRIPTION'] !!}</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item1 d-block bg-light box-gradient text-center p-3" href="">
                    <div class=" p-1">
                        <div class="mb-3">
                            <img class="img-fluid rounded" src="assets/img/service/1.jpg" alt="Icon">
                        </div>
                        <h6 class="white-text">Stock Broking</h6>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item1 d-block bg-light box-gradient text-center p-3" href="">
                    <div class=" p-1">
                        <div class="mb-3">
                            <img class="img-fluid rounded" src="assets/img/service/2.jpg" alt="Icon">
                        </div>
                        <h6 class="white-text">Mutual Fund</h6>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item1 d-block bg-light box-gradient text-center p-3" href="">
                    <div class=" p-1">
                        <div class="mb-3">
                            <img class="img-fluid rounded" src="assets/img/service/3.jpg" alt="Icon">
                        </div>
                        <h6 class="white-text">Investment Planning</h6>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item1 d-block bg-light box-gradient text-center p-3" href="">
                    <div class=" p-1">
                        <div class="mb-3">
                            <img class="img-fluid rounded" src="assets/img/service/4.jpg" alt="Icon">
                        </div>
                        <h6 class="white-text">Insurance</h6>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item1 d-block bg-light box-gradient text-center p-3" href="">
                    <div class=" p-1">
                        <div class="mb-3">
                            <img class="img-fluid rounded" src="assets/img/service/5.jpg" alt="Icon">
                        </div>
                        <h6 class="white-text">PMS Investment</h6>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item1 d-block bg-light box-gradient text-center p-3" href="">
                    <div class=" p-1">
                        <div class="mb-3">
                            <img class="img-fluid rounded" src="assets/img/service/6.jpg" alt="Icon">
                        </div>
                        <h6 class="white-text">Loan</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
    <a class="btn btn-primary py-3 px-5 add-gradiant" href="">Browse More Services</a>
</div>
<!-- Service End -->

<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <div class="page-heading text-center mx-auto mb-2 wow animated fadeInDown" data-wow-delay="0.1s" style="max-width: 600px;">
                <span class="aux-head-before heading-text">Creating</span>
                <span class="mb-3 heading-text">Proud Investors!</span>
            </div>
            <p>You can feel the pride of being a Kalpataru investor in their words.</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            @foreach($review as $reviewdetails)
            <div class="testimonial-item bg-light rounded box-gradient p-3">
                <div class="bg-white border rounded p-4">
                    <p>{!! $reviewdetails['description'] !!}</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{!! $reviewdetails['image'] !!}" style="width: 80px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">{!! $reviewdetails['name'] !!}</h6>
                            <small>{!! $reviewdetails['profession'] !!}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
            
        </div>
    </div>
</div>
<!-- Testimonial End -->
<style type="text/css">
    
    
</style>
@endsection
