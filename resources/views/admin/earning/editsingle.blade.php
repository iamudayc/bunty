@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>User</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li><a href="{{ url('admin/earnings') }}">Earnings</a></li>
            <li class="active"><a href="{{ url('admin/earnings/details/'.$data->user_id) }}">Earning Details</a></li>
            <li class="active">Update</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Create User</h4>
            </div>
            <div class="panel-body">
                <form action="{{url('admin/earnings/update')}}" method="post" enctype="multipart/form-data">    
                    <input type="hidden" class="form-control" name="id" value="{!! $data->id !!}" >           
                    <input type="hidden" class="form-control" name="user_id" value="{!! $data->user_id !!}" >   
                    {{csrf_field()}}        
                    <div class="form-group">
                        <label for="">Month</label>                                              
                            
                        <input type="text" class="form-control" readonly value="{!! date('F', mktime(0, 0, 0, $data->month, 10)) !!}">
                    </div>
                    <div class="form-group">
                        <label for="">Year</label>
                        <input type="text" class="form-control" readonly value="{!! $data->year !!}">
                    </div>
                    <div class="form-group">
                        <label for="">Earnings</label>
                        <br>                        
                        <input type="text" class="form-control" name="amount" value="{!! $data->amount !!}" >
                    </div>
                    
                   
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