@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>User List</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="active">User List</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <!-- <div class="panel-heading clearfix">
                <h4 class="panel-title">User List</h4>
            </div> -->
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert"> 
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="panel-body">
                
                <div class="table-responsive">
                    <table class="display nowrap" id="role_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th data-orderable="false">#</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>AUM</th>
                                <th>Activate</th>
                                <th data-orderable="false">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $i => $user)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td><img src="{{ $user['photo'] }}" class="img-rounded" alt="{{ $user['first_name'] }}" height="80" /></td>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['first_name'].' '.$user['last_name'] }}</td>
                                <td>{{$user['mobile']}}</td>
                                <td data-sort="{{$user['amount']}}">{{$user['amount_display']}}</td>
                                <td>
                                    @if($user['activate']==0)
                                        <a href="{{url('admin/activate/edit/'.$user['id'])}}" class="btn btn-danger" onclick="return confirm('Are you sure to Activate this?')">No</a>
                                    @else
                                        <a href="{{url('admin/activate/edit/'.$user['id'])}}" class="btn btn-success" onclick="return confirm('Are you sure to Deactivate this?')">Yes</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('admin/activate/add-user/'.$user['name'])}}" class="btn btn-info"> <i class="fa fa-plus"></i> Add </a>
                                    <a href="{{url('admin/activate/edit-user/'.$user['name'])}}" class="btn btn-info"> <i class="fa fa-pencil-square-o"></i> Edit </a>
                                    <a href="{{url('admin/activate/image/'.$user['name'])}}" class="btn btn-info"> <i class="fa fa-pencil-square-o"></i> Image </a>
                                    <a href="{{url('admin/activate/delete-user/'.$user['name'])}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"> <i class="fa fa-times"></i> Delete </a>

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
    $(document).ready(function () {
        $('#role_table').DataTable({
            "order": [[ 0, "desc" ]],
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false,
                    "sortable": false
                },
                {
                    "targets": [ 1,7 ],
                    "visible": true,
                    "searchable": false,
                    "sortable": false
                },
                {
                    "targets": [ 6 ],
                    "visible": true,
                    "searchable": false,
                    "sortable": true
                },
            ]
        });
    });
</script>
@stop