@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>User</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">User</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Udate Site Settings</h4>
            </div>

            <div class="panel-body">
                <form action="{{url('admin/content/site/update/')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="id" value="{{ $data['services']->id }}">
                    <div class="form-group">
                        <label for="">Section</label>
                        <input type="text" class="form-control" readonly name="key" value="{{ $data['services']->key }}">
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea class="form-control" name="value">{{ $data['services']->value }}</textarea>
                        
                    </div>
                    
                   
                    
                    {{csrf_field()}}
                    <a href="javascript:history.back()" class="btn btn-default">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
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