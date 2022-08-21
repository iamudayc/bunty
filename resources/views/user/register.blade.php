@extends('layouts.body')

@section('content')
<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-centerp">
            <div class="col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                @include(('include.sidebar'))
            </div>

            <div class="col-lg-9 wow fadeIn" data-wow-delay="0.5s">
                <div class="page-heading text-center mx-auto mb-2 wow animated fadeInDown" data-wow-delay="0.1s" style="max-width: 600px;">
                    <span class="aux-head-before heading-text">Add</span>
                    <span class="mb-3 heading-text">User</span>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    @if (Session::has('message'))
                        <div class="alert alert-success" role="alert"> 
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                          {{ Session::get('error') }}
                        </div>
                    @endif
                    <form action="register" method="post"  class="php-email-form" enctype="multipart/form-data">
                        @csrf @method('POST')
                        <input type="hidden" name="parent_code" value="{!! session()->get('username') !!}" />
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Your Name">
                                    <label for="first_name">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Your Email">
                                    <label for="last_name">Last Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="pan" id="pan" placeholder="Your Email">
                                    <label for="pan">PAN No</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Your Email">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Your Email">
                                    <label for="mobile">Mobile Number</label>
                                </div>
                            </div>                            
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3 add-gradiant" type="submit">Register</button>
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