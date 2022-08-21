@extends('layouts.app')

@section('content')
<!-- Gallery Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="page-heading text-center mx-auto mb-2 wow animated fadeInDown" data-wow-delay="0.1s" style="max-width: 600px;">
            <span class="aux-head-before heading-text">Photo</span>
            <span class="mb-3 heading-text">Gallery</span>
        </div>
        <div class="row g-5 align-items-center">
            
               
            <div class="col-lg-4 mb-4 mb-lg-0 wow fadeIn" data-wow-delay="0.1s">  
                @foreach($data as $details)            
               <img
                  src="{!! $details['name'] !!}"
                  class="w-100 shadow-1-strong rounded mb-4"
                  alt="{!! $details['alt'] !!}"
                />  
                <?php 
                    if($details['cnt'] %2 ==0)
                    {
                        echo '</div>';
                        echo '<div class="col-lg-4 mb-4 mb-lg-0 wow fadeIn" data-wow-delay="{!! $details[\'delay\'] !!}s">'; 
                    }
                ?>   
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Gallery End -->

<style type="text/css">
    
    
</style>
@endsection
