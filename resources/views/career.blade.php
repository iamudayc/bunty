@extends('layouts.app')

@section('content')
<!-- Career Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="page-heading text-center mx-auto mb-2 wow animated fadeInDown" data-wow-delay="0.1s" style="max-width: 600px;">
            <span class="aux-head-before heading-text">Grow</span>
            <span class="mb-3 heading-text">With Us</span>
        </div>
        @foreach($data as $details)
        <div class="bg-light rounded p-3">
            <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <img class="img-fluid rounded w-100" src="assets/img/login.jpg" alt="">
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <div class="mb-4">
                            <h5 class="fw-bold mb-0 heading-sub-text">{!! $details->heading !!}</h5>
                            <small>{!! $details->description !!}</small>
                        </div>
                        <div class="mb-4">
                            <span class="mb-5 fw-bold" style="color:#0E2E50">
                                Experience:
                                <span class="mb-5 fw-normal">{!! $details->experience !!}</span>
                            </span>
                            <br />
                            <span class="mb-5 fw-bold" style="color:#0E2E50">
                                Salary(INR):
                                <span class="mb-5 fw-normal">{!! $details->salary !!}</span>
                            </span>
                            <br />
                            <span class="mb-5 fw-bold" style="color:#0E2E50">
                                Posted on:
                                <span class="mb-5 fw-normal"><?php echo date('jS F Y', strtotime($details->created_at));?></span>
                            </span>
                        </div>                        
                        <!-- <a href="" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get Appoinment</a> -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
<!-- Career End -->




<style type="text/css">
    
    
</style>
@endsection
