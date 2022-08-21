@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>Banner</h3>
    <!-- <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="active">Banner</li>
        </ol>
    </div> -->
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Update Banner</h4>
            </div>
            <div class="panel-body">
                <form action="{{url('admin/banner/update/'.$user->id)}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Heading</label>
                        <input type="text" class="form-control" name="heading" value="{{$user->heading}}">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" name="description">{{$user->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Photo</label>
                        <br>
                        @if(!empty($user->image))
                            <img src="{{asset('uploads/'.$user->image)}}" alt="" height="100px">
                        @endif
                        <input type="file" class="form-control" name="photo">
                    </div>
                    
                    
                    
                    
                    {{csrf_field()}}
                    <a href="javascript:history.back()" class="btn btn-default">Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $('#role_table').dataTable();
    console.log('ok')

    $('.select2').select2();
    $('.select2').change(function(){
        console.log('its change')
    })
</script>
@stop