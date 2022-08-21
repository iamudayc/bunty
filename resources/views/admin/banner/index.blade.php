@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>Banner</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="active">Banner</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Banner</h4>
            </div>
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="panel-body">
                <!-- <div style="padding-bottom: 10px;">
                    <a href="{{url('admin/banner/create')}}" class="btn btn-success"> <i class="fa fa-plus"></i> Create </a>
                </div> -->
                <div class="table-responsive">
                    <table class="table" id="role_table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Heading</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $i => $details)
                            <tr>
                                <td><img src="../../public/uploads/banner/{{$details->image}}" class="img-thumbnail" width="300" /></td>
                                <td>{{$details->heading}}</td>
                                <td>{{$details->description}}</td>
                                <td>
                                <a href="{{url('admin/banner/edit/'.$details->id)}}" class="btn btn-info">Edit</a>
                                <!-- <a href="{{url('admin/user/delete/'.$details->id)}}" class="btn btn-danger">Delete</a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $('#role_table').dataTable();
    console.log('ok')
</script>
@stop