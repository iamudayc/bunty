@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>Role</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="active">Role</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Role</h4>
            </div>
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="panel-body">
                <div style="padding-bottom: 10px;">
                    <a href="{{url('admin/role/create')}}" class="btn btn-success"> <i class="fa fa-plus"></i> Create </a>
                </div>
                <div class="table-responsive">
                    <table class="table" id="role_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Role</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $i => $role)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$role->id}}</td>
                                <td>{{$role->nama}}</td>
                                <td>
                                <a href="{{url('admin/role/edit/'.$role->id)}}" class="btn btn-info">Edit</a>
                                <a href="{{url('admin/role/delete/'.$role->id)}}" class="btn btn-danger">Delete</a>
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