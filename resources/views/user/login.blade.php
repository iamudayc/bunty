@extends('layouts.body')

@section('content')
<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-gradient 3about-img position-relative overflow-hidden p-5 pe-0">
                    <img class="img-fluid w-100" src="{{ asset('assets/img/login.jpg') }}">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <div class="page-heading text-center mx-auto mb-2 wow animated fadeInDown" data-wow-delay="0.1s" style="max-width: 600px;">
                        <span class="aux-head-before heading-text">Join</span>
                        <span class="mb-3 heading-text">With Us</span>
                    </div>
                    <p class="mb-4">Sign In with your login credentials.</p>
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                          {{ Session::get('error') }}
                        </div>
                    @endif
                    <form action="login" method="post" role="form" class="php-email-form">
                        @csrf @method('POST')
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Your Name">
                                    <label for="name">Your UserID</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Your Email">
                                    <label for="email">Your Password</label>
                                </div>
                            </div>                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <p class="mb-4"><strong>Disclaimer :</strong> Kindly do not share your login credentials to any private app or utilities. This may lead to permanent disablement of your portal profile. Please change your login password at regular interval.</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 add-gradiant py-3" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<style type="text/css">
    
    
</style>
@endsection
