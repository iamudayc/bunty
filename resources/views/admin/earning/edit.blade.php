@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>User</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Home</a></li>
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
                <h4 class="panel-title">Create User</h4>
            </div>
            <div class="panel-body">
                <form action="{{url('admin/earnings/store')}}" method="post" enctype="multipart/form-data">                   
                    <div class="form-group">
                        <label for="">Month</label>
                        <select name="month" class="form-control select2">                            
                            @foreach($months as $key=>$month)
                                <option value="{{ $key }}" <?php if(date("m")==$key) echo "selected"; ?>>{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Year</label>
                        <select name="year" class="form-control select2">   
                            @for($i=date("Y")-1; $i<date("Y")+1; $i++) 
                                <option value="{{ $i }}" <?php if($i==date("Y")) echo "selected"; ?> >{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">CSV</label>
                        <br>                        
                        <input type="file" class="form-control" name="earning">
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