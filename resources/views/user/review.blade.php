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
                    @if($data['update']==1)
                      <span class="aux-head-before heading-text">Update</span>
                    @else
                      <span class="aux-head-before heading-text">Add</span>
                    @endif
                    <span class="mb-3 heading-text">Review</span>
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
                    <form action="addreview" method="post"  class="php-email-form" enctype="multipart/form-data">
                        @csrf @method('POST')
                        <input type="hidden" name="parent_code" value="{!! session()->get('username') !!}" />
                        <input type="hidden" name="update" value="{!! $data['update'] !!}" />
                        <div class="row g-3">
                            <div class="col-md-12">
                              <div class="form-floating">
                                <select class="form-select border-1 py-3" name="profession">
                                    <option selected>Select Profession</option>
                                    @foreach($professions as $profession)
                                      <option value="{!! $profession->title !!}" <?php if($data['profession']==$profession->title) echo "selected"; ?>>{!! $profession->title !!}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="description" name="description" style="height: 150px">{{ $data['description'] }}</textarea>
                                    <label for="message">Add Review</label>
                                </div>
                            </div>                                                     
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3 add-gradiant" type="submit">{!! $page['button'] !!}</button>
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