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
                <form action="{{url('admin/user/update/'.$user->id_user)}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="id_role" class="form-control select2">
                            <option value="{{$user->id_role}}">{{$user->nama_role}}</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}"> {{$role->nama}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="">Photo</label>
                        <br>
                        @if(!empty($user->photo))
                            <img src="{{asset('uploads/'.$user->photo)}}" alt="" height="100px">
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