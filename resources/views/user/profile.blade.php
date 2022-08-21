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
                <div class="wow fadeInUp " data-wow-delay="0.5s">
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
                        
                        @csrf
                        <input type="hidden" name="parent_code" id="parent_code" value="{!! session()->get('username') !!}" />
                        <input type="hidden" name="upload_image" id="upload_image" value="" />
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
                            <div class="col-md-12">
                                <div class="row form-floating">
                                <div class="col-md-4 text-center">
                                <div id="upload-demo"></div>
                                </div>
                                <div class="col-md-3" style="padding:5%;">
                                <strong>Select image to crop:</strong>
                                <input type="file" id="image">

                                 <button class="btn btn-success upload-image-view add-gradiant" style="margin-top:2%">Crop Image</button>
                                </div>

                                <div class="col-md-3">
                                <div id="preview-crop-image" style="background:#9d9d9d;width:300px;padding:25px 25px;height:300px;"></div>
                                </div>
                                </div>
                            </div> 
                            
                            
                                                                                
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3 add-gradiant" type="submit">Update</button>
                            </div>
                        </div>
                            
                </div>
            </div>  
        </div>
    </div>
</div>
<!-- About End -->

<style type="text/css">
    
    
</style>
@endsection
@section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
@endsection
@section('scripts')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
<script type="text/javascript">
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
var resize = $('#upload-demo').croppie({
    enableExif: true,
    enableOrientation: true,    
    viewport: { // Default { width: 100, height: 100, type: 'square' } 
        width: 250,
        height: 250,
        type: 'square' //circle
    },
    boundary: {
        width: 300,
        height: 300
    }
});
$('#image').on('change', function () { 
  var reader = new FileReader();
    reader.onload = function (e) {
      resize.croppie('bind',{
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});
/*$('.upload-image').on('click', function (ev) {
  var parent_code=$("#parent_code").val();
  var first_name=$("#first_name").val();
  var last_name=$("#last_name").val();
  var mobile=$("#mobile").val();
  resize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
    $.ajax({
      url: "update-profile",
      type: "POST",
      data: {
            "parent_code":parent_code,
            "first_name":first_name,
            "last_name":last_name,
            "mobile":mobile,
            "image":img
      },
      success: function (data) {
        alert("O");
        html = '<img src="' + img + '" />';
        $("#preview-crop-image").html(html);
        $(".succ").show();
       // $(".succ").val('Data updated successfully.');
      }
    });
  }).catch(function(err){
    alert("P");
    $(".err").show();
    //something was wrong with one of the calls
  });
});*/

$('.upload-image-view').on('click', function (ev) {
  ev.preventDefault();
  resize.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (img) {
    html = '<img src="' + img + '" />';
    $("#preview-crop-image").html(html);
    $("#upload_image").val(img);
    //return false;
  });
});
</script>
@endsection