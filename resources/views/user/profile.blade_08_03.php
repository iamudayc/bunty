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
                    <span class="aux-head-before heading-text">Update</span>
                    <span class="mb-3 heading-text">Profile</span>
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
                    <form action="update-profile" method="post"  class="php-email-form" enctype="multipart/form-data">
                        @csrf @method('POST')
                        <input type="hidden" name="parent_code" value="{!! session()->get('username') !!}" />
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="UserID" value="{!! $data->name !!}" readonly="" />
                                    <label for="name">Your UserID</label>
                                </div>
                            </div> 
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="pan" id="pan" placeholder="PAN No." value="{!! $data->pan !!}" readonly="" />
                                    <label for="pan">PAN No.</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="{!! $data->first_name !!}" />
                                    <label for="first_name">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="{!! $data->last_name !!}" />
                                    <label for="last_name">Last Name</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" value="{!! $data->mobile !!}"  />
                                    <label for="pan">Mobile Number</label>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control" name="image" id="image" placeholder="Profile Picture" value="{!! $data->mobile !!}"  />
                                    <label for="image">Profile Picture</label>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-floating">                                    
                                    @if( $data->photo!='')
                                    <img src="../public/uploads/users/{!! $data->photo !!}" class="img-thumbnail" />
                                    @else
                                    <img src="../public/user.jpg" class="img-thumbnail" />
                                    @endif
                                </div>
                            </div> 
                            
                                                                                
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3 add-gradiant" type="submit">Update</button>
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