@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>Add User</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">Home</a></li>
            <li class="active">Add User</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">  
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Create User</h4>
            </div>          
            <div class="panel-body">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach 
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert"> 
                        {{ Session::get('error') }}
                    </div>
                @endif
                <form action="{{url('admin/activate/update-image')}}" method="post"  class="php-email-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_code" id="user_code" value="{!! $parent_code_only !!}" />
                    <input type="hidden" name="upload_image" id="upload_image" value="" />
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
                </form>         
            </div>
        </div>    
    </div>
</div>
@stop
@section('styles')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
@stop
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
@stop