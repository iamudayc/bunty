@extends('layouts.body')

@section('content')
<div class="container-xxl py-5">
  <div class="container">
      <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <!-- <div>
            <span class="aux-head-before heading-text">Our</span>
            <span class="mb-3 heading-text">Services</span>
            <h1 class="mb-2">FINANCIAL SERVICES</h1>          
        </div>
        <div class="position-absolute top-80 start-50 translate-middle aux-modern-heading-divider"></div>
        <div>
            <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            
        </div> -->
        <div class="page-heading text-center mx-auto mb-2 wow animated fadeInDown" data-wow-delay="0.1s" style="max-width: 600px;">
            <span class="aux-head-before heading-text">Financial</span>
            <span class="mb-3 heading-text">Services</span>
        </div>
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p>{!! $data['PAGE_DESCRIPTION'] !!}</p>
        </div>
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
          <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
              <a class="cat-item1 d-block bg-light box-gradient text-center p-3" href="">
                  <div class=" p-1">
                      <div class="mb-3">
                          <img class="img-fluid rounded" src="assets/img/service/7.jpg" alt="Icon">
                      </div>
                      <h6 class="white-text">Education</h6>
                  </div>
              </a>
          </div>
          <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
              <a class="cat-item1 d-block bg-light box-gradient text-center p-3" href="">
                  <div class=" p-1">
                      <div class="mb-3">
                          <img class="img-fluid rounded" src="assets/img/service/8.jpg" alt="Icon">
                      </div>
                      <h6 class="white-text">Career</h6>
                  </div>
              </a>
          </div>
          
          
          
         
          
          
      </div>
  </div>
</div>
@endsection
