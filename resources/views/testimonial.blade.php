@extends('layouts.app')

@section('content')
<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <div class="page-heading text-center mx-auto mb-2 wow animated fadeInDown" data-wow-delay="0.1s" style="max-width: 600px;">
                <span class="aux-head-before heading-text">Our </span>
                <span class="mb-3 heading-text">Clients Say!</span>
            </div>
            <p>You can feel the pride of being a Kalpataru investor in their words.</p>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            @foreach($data as $review)
              <div class="testimonial-item bg-light rounded box-gradient p-3">
                  <div class="bg-white border rounded p-4">
                      <p>{!! $review['description'] !!}</p>
                      <div class="d-flex align-items-center">
                          <img class="img-fluid flex-shrink-0 rounded" src="{!! $review['image'] !!}" style="width: 100px;" alt="{!! $review['name'] !!}">
                          <div class="ps-3">
                              <h6 class="fw-bold mb-1">{!! $review['name'] !!}</h6>
                              <small>{!! $review['profession'] !!}</small>
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
