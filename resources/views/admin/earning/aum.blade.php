<?php 
    use App\Helper\general;
?>
@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>Earnings</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="active">Earning</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Users</h4>
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
                    <a href="{{url('admin/earnings/update-earning')}}" class="btn btn-success"> <i class="fa fa-plus"></i> Update </a>
                </div>
                <div class="table-responsive">
                    <table class="display nowrap" id="role_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Earning</th>
                                <th>Phone</th>
                                <th>Total Paid</th>
                                <th>Last Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $i => $user)
                            <tr>
                                <td>{{$i+1}}</td>                                
                                <td>{{$user['name']}}</td>
                                <td>{{$user['first_name'].' '.$user['last_name']}}</td>
                                <td></td>
                                <td>{{$user['mobile']}}</td>
                                <td>{{ general::totalEarning($user['name']) }}</td>                                
                                <td>{{ general::totalEarning($user['name']) }}</td>                                
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
    //$('#role_table').dataTable();
   // console.log('ok')
    $(document).ready(function() {
        $('#role_table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
               { 
                  extend: 'csv',
                  text: 'Export User List',
                  exportOptions: {
                    //columns: 'th:not(:last-child)'
                    columns: [ 1, 2, 3 ]
                  }
               }
            ],
            columnDefs: [
                {
                    "targets": [ 3 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        } );
    } );
</script>
@stop